<?php

namespace Kavi\SiteEditor\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SiteEditorController extends Controller
{
    public function editor($business, Request $request)
    {
        $bname = base64_decode($business);
        $buss = DB::table("business")->where('userid', $request->session()->get('busid'))->where('bname', $bname)->first();
        if (!$buss) {
            return redirect('login');
        }
        return view('editor::editor', compact('business', 'bname'));
    }

    public function upload(Request $request, $business)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,jpeg,png,svg|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $file = time() . '.' . $request->file->extension();
        $request->file->move(public_path('vendor/site-editor/') . $business, $file);

        return $file;
    }

    public function scan(Request $request, $business)
    {
        $mediaPath = $request->input('mediaPath', public_path('vendor/site-editor/' . $business));

        $response = $this->scanDirectory($mediaPath);

        return response()->json([
            'name'  => '',
            'type'  => 'folder',
            'path'  => '',
            'items' => $response,
        ]);
    }

    private function scanDirectory($dir)
    {
        $files = [];

        $directories = File::directories($dir);
        $filesInDir = File::files($dir);

        foreach ($directories as $directory) {
            $files[] = [
                'name'  => basename($directory),
                'type'  => 'folder',
                'path'  => str_replace(public_path(), '/public', $directory),
                'items' => $this->scanDirectory($directory),
            ];
        }

        foreach ($filesInDir as $file) {
            $files[] = [
                'name' => $file->getFilename(),
                'type' => 'file',
                'path' => str_replace(public_path(), '/public', $file->getPathname()),
                'size' => $file->getSize(),
            ];
        }

        return $files;
    }

    public function save(Request $request, $business)
    {
        $buss = DB::table("business")->where("bname", $business)->first();

        $file = $this->sanitizeFileName($request->input('html'));

        $data = array(
            'manual_editor_content' => $file
        );
        DB::table("business_content")->where('bid', $buss->id)->update($data);
        return "File saved <a href='/$business' target='_blank'>$business</a> ;)";
    }

    private function sanitizeFileName($file)
    {
        //sanitize, remove double dot .. and remove get parameters if any
        $file = preg_replace('@\?.*$@', '', preg_replace('@\.{2,}@', '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $file)));
        return $file;
    }
}

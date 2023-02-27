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
    public function editor($business, Request $request){
        $bname = base64_decode($business);
		$buss = DB::table("business")->where('userid', $request->session()->get('busid'))->where('bname', $bname)->first();
        if(!$buss){
            return redirect('login');
        }
        return view('editor::siteEditor.editor', compact('business', 'bname'));
    }

    public function upload(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,jpeg,png,svg|max:5120',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $file = time() . '.' . $request->file->extension();
        $request->file->move(public_path($request->input('mediaPath').'/'), $file);
        return $file;
    }

    public function scan(Request $request)
    {
        $mediaPath = $request->input('mediaPath', 'assets/media');

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
                'path'  => str_replace(public_path(), '', $directory),
                'items' => $this->scanDirectory($directory),
            ];
        }

        foreach ($filesInDir as $file) {
            $files[] = [
                'name' => $file->getFilename(),
                'type' => 'file',
                'path' => str_replace(public_path(), '', $file->getPathname()),
                'size' => $file->getSize(),
            ];
        }

        return $files;
    }

    public function save(Request $request, $business){
        $buss = DB::table("business")->where("bname", $business)->first();
        function sanitizeFileName($file)
        {
            //sanitize, remove double dot .. and remove get parameters if any
            $file = preg_replace('@\?.*$@' , '', preg_replace('@\.{2,}@' , '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $file)));
            return $file;
        }

        $file = sanitizeFileName($request->input('html'));

        $data = array(
            'manual_editor_content' => $file
        );
        DB::table("business_content")->where('bid', $buss->id)->update($data);
        return "File saved <b>$business</b> ;)";
    }

    public function business($business)
	{
        $username = base64_decode($business);
        $products = DB::table('products')->select('*')->get();
        $timeNow = date('Y-m-d');

        $dataProduct = DB::table('products')->select('*')->where('old_price','>',0)->where('to_date','<',$timeNow)->where('old_price','!=',DB::raw('price'))->where('old_price','!=','')->get();
        foreach($dataProduct as $product){
            $old_price = $product->old_price;
            $price_d_t = $product->price_d_t;
            $price = $product->price;
            $tp = $product->tp;
            $dp = $product->dp;

            if($old_price>0 && $old_price!=0.00 && $old_price!='' && $old_price!=null && is_numeric($old_price)){
                $DUC = round($old_price*floatval($dp)/100, 2);
                $TPDC = $old_price-$DUC;
                $TA = round($TPDC*floatval($tp)/100, 2);
                $price = $TPDC+$TA;
                $price_a = round($price, 2);
                $data = array(
                        'old_price' => '',
                        'from_date' => '',
                        'to_date' => '',
                        'date_range' => '',
                        'price_d_t' => $old_price,
                        'dc' => $DUC,
                        'tax' => $TA,
                        'price' => $price_a
                    );
                DB::table("products")->where('id', $product->id)->update($data);
            }
        }

		$buss = DB::table("business")->whereRaw("(bname = '$username')")->first();
        if(!empty($buss)) {
            $user = DB::table("registered_users")->whereRaw("(id = $buss->userid)")->first();
            $buscon = DB::table("business_content")->whereRaw("(bid = $buss->id)")->first();

            $bid = session()->get('busid');
            $connect = DB::table("registered_users")->select('registered_users.connection','registered_users.connected_bus')->where('registered_users.id', '=', $bid)->get();

            $business_data = DB::table('business')->select('*')->whereRaw("(bname = '$username')")->get();

            foreach($business_data as $busdata){
                if($busdata->template == 1){
                    return view('editor::templaes.template-one', ['bus' => $buss,'user' => $user,'buscon' => $buscon, 'connect'=>$connect, 'bname'=>$username]);
                }
                elseif($busdata->template == 2){
                    return view('editor::templaes.template-two', ['bus' => $buss,'user' => $user,'buscon' => $buscon, 'connect'=>$connect, 'bname'=>$username]);
                }
                elseif($busdata->template == 3){
                    return view('editor::templaes.template-three', ['bus' => $buss,'user' => $user,'buscon' => $buscon, 'connect'=>$connect, 'bname'=>$username]);
                }
                else{
                    return view('editor::templaes.template-one', ['bus' => $buss,'user' => $user,'buscon' => $buscon, 'connect'=>$connect, 'bname'=>$username]);
                }
            }
        }else{
            return abort(404);
        }
	}
}

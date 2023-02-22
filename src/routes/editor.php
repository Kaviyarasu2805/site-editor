<?php

use Illuminate\Support\Facades\Route;
use Kavi\SiteEditor\Http\Controllers\SiteEditorController;



Route::middleware(['web', 'csrf'])->group(function () {
    Route::get('{business}', [SiteEditorController::class, 'editor']);
    Route::get('/', function(){
        return 'package loaded';
    });
});

Route::controller(SiteEditorController::class)->group(function () {
    // Route::get('{business}', 'editor');
    Route::get('business/{business}', 'business');
    Route::post('upload', 'upload');
    Route::post('save/{business}', 'save');
    Route::get('public/scan', 'scan');
});

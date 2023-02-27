<?php

use Illuminate\Support\Facades\Route;
use Kavi\SiteEditor\Http\Controllers\SiteEditorController;



Route::middleware(['web', 'csrf'])->controller(SiteEditorController::class)->group(function () {
    Route::get('{business}', [SiteEditorController::class, 'editor']);
    Route::get('business/{business}', 'business');
    Route::post('upload/{business}', 'upload');
    Route::post('save/{business}', 'save');
    Route::get('public/scan/{business}', 'scan');
});

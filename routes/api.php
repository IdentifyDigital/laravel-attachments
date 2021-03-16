<?php

use Illuminate\Support\Facades\Route;

Route::post('file-upload', [\IdentifyDigital\LaravelAttachments\Http\Controllers\FileController::class, 'upload'])->name('file-upload');
Route::get('file-download/{attachment}', [\IdentifyDigital\LaravelAttachments\Http\Controllers\FileController::class, 'download'])->name('file-download');
Route::post('file-delete', [\IdentifyDigital\LaravelAttachments\Http\Controllers\FileController::class, 'delete'])->name('file-delete');

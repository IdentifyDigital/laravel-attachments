<?php

use Illuminate\Support\Facades\Route;

Route::post('file-upload', [\IdentifyDigital\LaravelAttachments\Http\Controllers\FileUploadController::class, 'fileUpload'])->name('file-upload');

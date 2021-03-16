<?php

use Illuminate\Support\Facades\Route;

Route::get('file-upload', [\IdentifyDigital\LaravelAttachments\Http\Controllers\FileUploadController::class, 'fileUpload'])->name('file-upload');

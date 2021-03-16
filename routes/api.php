<?php

use Illuminate\Support\Facades\Route;

Route::get('file-upload', [\IdentifyDigital\Attachments\Http\Controllers\FileUploadController::class, 'fileUpload'])->name('file-upload');

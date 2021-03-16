<?php

use Illuminate\Support\Facades\Route;

Route::get('file-upload', [\IdentifyDigital\Attachments\Controllers\FileUploadController::class, 'fileUpload'])->name('file-upload');

<?php
namespace IdentifyDigital\Attachments\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use IdentifyDigital\Attachments\Facades\AttachmentManager;

class FileUploadController extends Controller
{
    public function fileUpload(Request $request)
    {
        $uuid = Str::uuid();
        $file = $request->file('file');

        $path = $file->storeAs("{$request->get('folder')}/$uuid", $file->getClientOriginalName());

        $attachment = AttachmentManager::new($uuid, $path, $file, $request->user());

        if ($request->exists('relation_id') && $request->input('relation_id') !== '' && $request->input('relation_id') !== null) {
            $model = $request->input('relation');
            $model = (new $model())->find($request->input('relation_id'));
            AttachmentManager::attach($uuid, $model);
        }

        return response([
            'success' => true,
            'file' => $attachment->getKey()
        ]);
    }
}

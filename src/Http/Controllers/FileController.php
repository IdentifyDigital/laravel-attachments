<?php
namespace IdentifyDigital\LaravelAttachments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use IdentifyDigital\LaravelAttachments\Facades\AttachmentManager;
use IdentifyDigital\LaravelAttachments\Models\Attachment;

class FileController extends Controller
{
    /**
     * File Uploads
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function upload(Request $request)
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

    /**
     * File Downloads
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function download(Request $request, Attachment $attachment)
    {
        return Storage::disk($attachment->driver)
            ->download($attachment->path, $attachment->name, [
                'X-Vapor-Base64-Encode' => 'True',
                'X-Content-Transfer-Id' => 123321
            ]);
    }
}

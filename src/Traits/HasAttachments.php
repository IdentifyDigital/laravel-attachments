<?php


namespace IdentifyDigital\Attachments\Traits;

use IdentifyDigital\Attachments\Models\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HasAttachments
{
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'relation');
    }

    public function createAttachment(String $name, UploadedFile $file, string $driver = null){
        $uuid = Str::uuid();
        $driver = ($driver === null ? config('filesystems.default') : $driver);

        $path = $file->store(
            'attachments/'.$uuid, $driver
        );

        $newAttachmentRow = array(
            'id'=> $uuid,
            'name'=> $name,
            'driver'=> $driver,
            'path'=>$path,
            'size'=>$file->getSize()
        );

        return $this->attachments()->create($newAttachmentRow);
    }

}

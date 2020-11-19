<?php


namespace IdentifyDigital\Attachments\Traits;

use IdentifyDigital\Attachments\Models\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Trait HasAttachments
 * @package IdentifyDigital\Attachments\Traits
 */
trait HasAttachments
{
    /**
     * @return mixed
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'relation');
    }

    /**
     * @return mixed
     */
    public function getAllAttachments(){
        return $this->attachments()->get();
    }

    /**
     * @return mixed
     */
    public function getLatestAttachments(){
        return $this->attachments()->latest('created_at')->get();
    }

    /**
     * @return mixed
     */
    public function getOldestAttachments(){
        return $this->attachments()->oldest('created_at')->get();
    }

    /**
     * @param UploadedFile $file
     * @param string|null $driver
     * @return mixed
     */
    public function uploadAttachment(UploadedFile $file, string $driver = null){
        $uuid = Str::uuid();
        $driver = ($driver === null ? config('filesystems.default') : $driver);

        $path = $file->store(
            'attachments/'.$uuid, $driver
        );

        $newAttachmentRow = array(
            'id'=> $uuid,
            'name'=> $file->getFilename(),
            'driver'=> $driver,
            'path'=>$path,
            'size'=>$file->getSize()
        );

        return $this->attachments()->create($newAttachmentRow);
    }

}

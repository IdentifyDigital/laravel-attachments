<?php
namespace IdentifyDigital\Attachments\Services;

use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\UuidInterface;

class AttachmentManager
{

    /**
     * Returns the attachment which has been created. The user who has uploaded the file is set as the auth.
     *
     * @param UuidInterface $uuid
     * @param string $path
     * @param UploadedFile $file
     * @param $user
     * @param string|null $driver
     * @return Attachment
     */
    public function new(UuidInterface $uuid, string $path, UploadedFile $file, $user, string $driver = null)
    {

        $attachment = new Attachment([
            'id' => $uuid,
            'path' => $path,
            'size' => $file->getSize(),
            'name' => $file->getClientOriginalName(),
            'driver' => $driver === null ? config('filesystems.default') : $driver
        ]);

        $attachment->authenticatable()->associate($user);

        $attachment->save();

        return $attachment;
    }

    /**
     * Attaches a relation to a attachment. This is normally done once a file has been upload
     * and then the owner model is saved/updated.
     *
     * @param $uuid
     * @param $model
     * @return array|bool
     */
    public function attach($uuid, $model)
    {

        if(is_array($uuid)) {

            /** remove all in array */
            $model->attachments()->whereNotIn('id', $uuid)->delete();

            $attachments = [];

            foreach ($uuid as $attachmentID) {

                $attachment = Attachment::query()->find($attachmentID);
                if($attachment instanceof Attachment) {
                    $attachment->relation()->associate($model);
                    $attachment->save();

                    $attachments[] = $attachment;
                }
            }

            return $attachments;

        } else {

            /** remove all that aren't this uuid */
            $model->attachments()->where('id', '!=', $uuid)->delete();

            $attachment = Attachment::query()->find($uuid);
            if($attachment instanceof Attachment) {
                $attachment->relation()->associate($model);
                return $attachment->save();
            }
        }

        return false;
    }
}

<?php

namespace IdentifyDigital\LaravelAttachments\Facades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;
use Ramsey\Uuid\UuidInterface;
use IdentifyDigital\LaravelAttachments\Models\Attachment;

/**
 * @method static Attachment new(UuidInterface $uuid, string $path, UploadedFile $file, $user, string $driver = null)
 * @method static bool attach(string $uuid, Model $model)
 *
 * @see AttachmentManager
 */
class AttachmentManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'attachment';
    }
}

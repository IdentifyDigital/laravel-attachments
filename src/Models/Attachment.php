<?php

namespace IdentifyDigital\LaravelAttachments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

/**
 * Class Attachment
 * @package IdentifyDigital\Attachments\Models
 */
class Attachment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'relation_type',
        'relation_id',
        'path',
        'driver',
        'size',
        'name',
    ];

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Returns a URL for the current Attachment.
     *
     * @return mixed
     */
    public function getUrlAttribute()
    {
        return Storage::disk($this->attributes['driver'])->url($this->attributes['path']);
    }

    /**
     * Returns the size in a readable format for the appropriate metric.
     *
     * @return string
     */
    public function getSizeReadableAttribute()
    {
        if ($this->attributes['size'] < 1024) {
            return $this->attributes['size'] . ' B';
        }

        $factor = floor(log($this->attributes['size'], 1024));
        return sprintf("%.2f ", $this->attributes['size'] / pow(1024, $factor)) . ['B', 'KB', 'MB', 'GB', 'TB', 'PB'][$factor];
    }

    /**
     * @return string
     */
    public function getIconAttribute()
    {
        $parsed = pathinfo($this->attributes['path']);

        switch ($parsed['extension']) {
            case 'pdf':
                return "file-" . $parsed['extension'];
            case 'jpg':
            case 'jpeg':
            case 'png':
                return "file-image";
            default:
                return 'file';
        }
    }

    /**
     * @return bool
     */
    public function isImage()
    {
        $parsed = pathinfo($this->attributes['path']);

        return in_array(strtolower($parsed['extension']), ['jpg', 'jpeg', 'png']);
    }

    public function getExtension()
    {
        $parsed = pathinfo($this->attributes['path']);

        return $parsed['extension'];
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

// Загруженные файлы
class File extends Model
{
    protected $table = 'files';
    protected $guarded = false;

    protected $appends = ['url', 'type_short'];

    /**
     * Удаляем превью с диска при удалении из бд
     */
    protected static function booted(): void
    {
        static::deleted(function (self $file) {
            if (!empty($file->src)) Storage::delete($file->src);
        });
    }

    /**
     * Абсолютная ссылка на файл
     */
    protected function url(): Attribute
    {
        return new Attribute(
            get: fn () => Storage::url($this->src),
        );
    }

    /**
     * Краткий тип файла
     */
    protected function typeShort(): Attribute
    {
        return new Attribute(
            get: fn () => explode('/', $this->type)[0],
        );
    }
}

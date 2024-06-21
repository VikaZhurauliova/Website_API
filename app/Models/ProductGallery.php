<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;

// Галерея фото и видео товаров
class ProductGallery extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'product_gallery';
    protected $guarded = false;
    public $timestamps = false;
    protected $appends = ['photos'];

    protected static function booted(): void
    {
        // Удаляем файлы с диска при удалении из бд
        static::deleted(function (ProductGallery $productGallery) {
            Storage::deleteDirectory(
                config('files.productGalleryFolder') . DIRECTORY_SEPARATOR . $productGallery->id
            );
        });
    }

    /**
     * Товар
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Фото разных размеров в папке
     * @return array
     */
    public function getPhotosAttribute(): array
    {
        $photos = [];
        foreach (Storage::allFiles(
            config('files.productGalleryFolder') . DIRECTORY_SEPARATOR . $this->id
        ) as $path) {
            $pathParts = explode(DIRECTORY_SEPARATOR, pathinfo($path)['dirname']);
            $photos[array_pop($pathParts)] = Storage::url($path);
        }
        return $photos;
    }

}

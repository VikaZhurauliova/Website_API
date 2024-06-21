<?php

namespace App\Models;

use App\Services\UrlService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    protected $table = 'banners';
    protected $guarded = false;

    /**
     * Удаляем превью с диска при удалении из бд
     */
    protected static function booted(): void
    {
        static::deleted(function (self $banner) {
            if (!empty($banner->image_preview)) Storage::delete($banner->image_preview);
        });
    }


    /**
     * Пути для ревалидации: где используется объект
     * @return string[]
     */
    public function getRevalidatePathAttribute(): array
    {
        $mainPageSeo = Seo::where('url', '')->first();
        return UrlService::getRevalidatePaths($mainPageSeo);
    }
}

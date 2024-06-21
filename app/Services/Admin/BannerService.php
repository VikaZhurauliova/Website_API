<?php
namespace App\Services\Admin;


use App\Models\Banner;
use App\Services\File\Upload\UploadFileService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    /**
     * Создание баннера. Баннер создаётся пустым, затем уже заполняются поля и отправляются на метод update
     * @return Banner
     */
    public static function store(): Banner
    {
        return DB::transaction(function () {
            DB::statement("UPDATE `banners` SET `position` = `position` + 1");
            return Banner::create(['status' => 1, 'position' => 0]);
        });
    }

    /**
     * Обновление баннера
     * @param Banner $banner
     * @param array $data
     * @return Banner
     */
    public static function update(Banner $banner, array $data): Banner
    {
        self::processImage($data, $banner);
        $banner->update($data);
        return $banner;
    }

    /**
     * Загружает файл из $data['image_preview'] если это Base64 или удаляет поле из массива
     * @param array $data
     * @param Banner $banner
     * @return void
     */
    public static function processImage(array &$data, Banner $banner): void
    {
        $imageParts = explode(";base64,", $data['image_preview']);
        if (isset($imageParts[1])) {
            $data['image_preview'] = UploadFileService::uploadFile($data['image_preview'], config('files.bannerPreviewsFolder'), 300);
            if ($banner->image_preview !== null) {
                Storage::delete($banner->image_preview);
            }
        } else {
            unset($data['image_preview']);
        }
    }

    /**
     * Создание баннера. Баннер создаётся пустым, затем уже заполняются поля и отправляются на метод update
     */
    public static function sort(array $ids): void
    {
        DB::transaction(function () use ($ids) {
            $position = 0;
            foreach ($ids as $id) {
                $position++;
                Banner::where('id', $id)->update(['position' => $position]);
            }
        });
    }

}

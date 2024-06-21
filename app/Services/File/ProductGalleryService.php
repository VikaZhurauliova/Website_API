<?php

namespace App\Services\File;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

// Набор функций для работы с фото в галерее товаров
class ProductGalleryService
{
    /**
     * Сохраняет все фото для галереи товаров в формате webp
     * @param string $filePath Путь к оригинальному фото товара
     * @return void
     */
    public static function makeWebPImagesFromOriginal(string $filePath): void
    {
        self::makeWebPImageFromOriginal($filePath); // Дефолтное фото с размером как у оригинала
        foreach (config('files.productPhotoSizes') as $size) {
            self::makeWebPImageFromOriginal($filePath, $size); // Фото каждого размера
        }
    }

    /**
     * Сохраняет одно фото заданного размера для галереи товаров в формате webp
     * @param string $filePath Путь к оригинальному фото товара
     * @param string|int $size Размер фото - число или "default" (как у оригинала)
     * @return void
     */
    public static function makeWebPImageFromOriginal(string $filePath, string|int $size = 'default'): void
    {
        try {
            $path = Storage::path($filePath);
            $fileName = pathinfo($filePath)['filename'];
            $img = Image::read($path);
            if ($size !== 'default') $img->resize($size, $size);
            $img->save(
                Storage::path(
                    self::makeFolderForPhoto($filePath, $size) . DIRECTORY_SEPARATOR . $fileName . '.webp'
                ),
                config('files.productPhotoQuality')
            );
        } catch (\Exception $e) {
            // TODO Обработка ошибок
        }
    }

    /**
     * Создаёт папку для каждого конкретного фото товара
     * @param string $filePath Путь к оригинальному фото товара
     * @param string $dirName Название папки размера
     * @return string
     */
    public static function makeFolderForPhoto(string $filePath, string $dirName): string
    {
        $dirParts = explode(DIRECTORY_SEPARATOR, pathinfo($filePath)['dirname']);
        array_pop($dirParts);
        $dirParts[] = $dirName;
        $newFolder = implode(DIRECTORY_SEPARATOR, $dirParts);
        Storage::makeDirectory($newFolder);
        return $newFolder;
    }

}

<?php

namespace App\Services\File\Upload\UploadProcessStrategies;

use App\Services\File\Upload\UploadFileService;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ImageProcessor extends FileProcessor
{
    static function processUploadedFile(string $src, ?int $width = null, ?int $height = null): string
    {
        $image = Image::read(Storage::path($src));
        // Изменение размеров и обрезка
        if ($width !== null) {
            if ($height !== null) {
                $image->cover($width, $height);
            } else {
                $image->scale(width: $width);
            }
        } elseif ($height !== null) {
            $image->scale(height: $height);
        }
        $format = self::getFormatToSave($src); // Формат для сохранения
        $quality = self::getQuality($format); // Качество для сохранения
        $filePath = UploadFileService::getFilePathWithChangedExtension($src, $format); // Путь для сохранения
        // Сохранение обработанного файла
        $image->save(
            Storage::path($filePath),
            $quality
        );
        return $filePath;
    }

    /**
     * PNG перекодируем в webp, AVIF и WEBP не конвертируем, остальные - в JPEG
     * @param string $src Путь к загруженному файлу
     * @return string|null Формат, в который нужно конвертировать изображение
     */
    public static function getFormatToSave(string $src): string|null
    {
        return match (Storage::mimeType($src)) {
            'image/png', 'image/webp' => 'webp',
            'image/avif' => 'avif',
            default => 'jpg'
        };
    }

    /**
     * Качество для разных форматов файлов
     * @param string $format Формат, в который нужно конвертировать изображение
     * @return int качество
     */
    public static function getQuality(string $format): int
    {
        return match ($format) {
            'webp', 'avif' => 90,
            default => 60
        };
    }
}

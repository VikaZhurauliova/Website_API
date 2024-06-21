<?php

namespace App\Services\File\Upload\UploadProcessStrategies;

use App\Jobs\CheckUploadedFile;
use App\Services\Common\File\BaseFileService;
use App\Services\Common\File\Compress\FileCompressor;
use Exception;
use Illuminate\Support\Facades\Storage;

abstract class FileProcessor
{
    /**
     * Возвращает имя обрабатывающего класса в зависимости от типа файла
     * @param string $src
     * @return FileProcessor
     */
    public static function getInstance(string $src): FileProcessor
    {
        $fileType = Storage::mimeType($src);

        if (str_starts_with($fileType, 'image/')) {
            return new ImageProcessor();
        }
        if (str_starts_with($fileType, 'video/')) {
            return new VideoProcessor();
        }
        if (str_starts_with($fileType, 'audio/')) {
            return new AudioProcessor();
        }
        if ($fileType === 'application/pdf') {
            return new PDFProcessor();
        }
        return new DocumentProcessor();
    }

    /**
     * Обработка загруженного файла
     * @param string $src Путь к загруженному файлу
     * @param int|null $width Ширина
     * @param int|null $height Высота
     * @return string Путь к обработанному файлу
     */
     static function processUploadedFile(string $src, ?int $width = null, ?int $height = null): string
     {
         return $src;
     }

}

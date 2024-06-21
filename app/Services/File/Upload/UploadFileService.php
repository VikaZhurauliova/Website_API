<?php

namespace App\Services\File\Upload;

use App\Services\File\Upload\UploadProcessStrategies\FileProcessor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

class UploadFileService
{
    /**
     * Загружает файл $file в папку $folder
     * @param mixed $file Загружаемый файл в Base64 или бинарник
     * @param string $folder Папка для загрузки
     * @param int|null $width Ширина
     * @param int|null $height Высота
     * @return string Путь к загруженному файлу
     */
    public static function uploadFile(mixed $file, string $folder = '', ?int $width = null, ?int $height = null): string
    {
        $src = self::saveFileToStorage($file, $folder); // Сохраняем файл на диск
        $fileProcessor = FileProcessor::getInstance($src); // Устанавливаем обработчик файла
        $processed = $fileProcessor::processUploadedFile($src, $width, $height); // Обрабатываем загруженный файл
        if ($processed !== $src) Storage::delete($src); // Если файл изменился, удаляем загруженный
        return $processed;
    }

    /**
     * Сохраняет файл в папку $folder Storage
     * @param $file - загружаемый файл
     * @param string $folder - папка для сохранения файла
     * @return string - путь к файлу
     */
    public static function saveFileToStorage($file, string $folder): string
    {
        Storage::makeDirectory($folder);
        if (is_string($file)) {
            // Декодируем base64
            $fileData = self::processBase64Image($file);
            $file = $fileData['fileContent'];
            $src = $folder . DIRECTORY_SEPARATOR . $fileData['imageName'];
            if (Storage::put($src, $file)) return $src;
        }
        return Storage::put($folder, $file);
    }

    /**
     * Декодирует файл, переданный в base64
     * @param string $base64 Изображение в формате base64
     * @return array Имя файла и декодированное изображение
     */
    #[ArrayShape(['imageName' => "string", 'fileContent' => "false|string"])]
    public static function processBase64Image(string $base64): array
    {
        $imageParts = explode(";base64,", $base64);
        $extension = explode('/', explode(':', substr($base64, 0, strpos($base64, ';')))[1])[1];   // .jpg .png .pdf
        return [
            'imageName' => Str::uuid() . '.' . $extension,
            'fileContent' => base64_decode($imageParts[1])
        ];
    }

    /**
     * Создаёт путь к файлу с изменённым расширением
     * @param string $src - путь к файлу
     * @param string $extension - устанавливаемое расширение
     * @return string - обновлённый путь к файлу
     */
    public static function getFilePathWithChangedExtension(string $src, string $extension): string
    {
        $path_parts = pathinfo($src);
        return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . $extension;
    }

}

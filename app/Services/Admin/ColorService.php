<?php
namespace App\Services\Admin;


use App\Models\Color;
use App\Services\File\Upload\UploadFileService;
use Illuminate\Support\Facades\Storage;

class ColorService
{
    /**
     * Создание цвета
     * @return Color
     */
    public static function store(): Color
    {
        return Color::create();
    }
    /**
     * Обновление цвета
     * @param Color $color
     * @param array $data
     * @return Color
     */

    public static function update(Color $color, array $data): Color
    {
        self::processImage($data, $color);
        $color->update($data);
        return $color;
    }
    public static function processImage(array &$data, Color $color): void
    {
        $imageParts = explode(";base64,", $data['image']);
        if (isset($imageParts[1])) {
            $data['image'] = UploadFileService::uploadFile($data['image'], config('files.colorsFolder'), 300);
            if ($color->image !== null) {
                Storage::delete($color->image);
            }
        } else {
            unset($data['image']);
        }
    }

}

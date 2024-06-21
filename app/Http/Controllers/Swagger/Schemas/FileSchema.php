<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "FileSchema",
    title: "Файл",
    required: ["id", "type", "name_init", "url"],
    properties: [
        new OA\Property(property: "id", description: "Внутренний ID записи на сайте", type: "integer", example: 189),
        new OA\Property(property: "type", description: "Тип файла", type: "string", example: "video", nullable: true),
        new OA\Property(property: "name_init", description: "Оригинальное имя файла", type: "string", example: "Мой-файл.mp4", nullable: true),
        new OA\Property(property: "url", description: "URL", type: "string", example: "http://localhost:3007/video/pure-water-2/main/a5d6259cfweewewewdfcdew-71d7-4f3c-992a-7217c3d116d6_desktop.mp4", nullable: true),
    ]
)]

class FileSchema
{

}

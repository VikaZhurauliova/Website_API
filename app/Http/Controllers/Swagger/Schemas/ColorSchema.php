<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ColorSchema",
    title: "Цвет",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 18),
        new OA\Property(property: "name", description: "Цвет товара", type: "string", example: "Красный"),
        new OA\Property(property: "code", description: "Код цвета", type: "string", example: "#FF0000"),
        new OA\Property(property: "image", description: "Изображение", type: "string", example: "https://api.market.ru/storage/colors/preview/5.webp", nullable: true),
        new OA\Property(property: "isCode", description: "Код выбран", type: "integer", example: 1),
    ]
)]

class ColorSchema
{

}

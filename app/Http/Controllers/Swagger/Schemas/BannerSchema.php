<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "BannerSchema",
    title: "Баннер",
    required: ["id", "name", "html", "delay", "dateStart", "dateEnd", "status", "isActive", "imagePreview"],
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "name", description: "Название", type: "string", example: "Колесо фортуны", nullable: true),
        new OA\Property(property: "html", description: "HTML-код баннера", type: "string", example: "<div...><div ...><a href...></a></div></div>", nullable: true),
        new OA\Property(property: "delay", description: "Задержка, сек", type: "integer", example: 4, nullable: true),
        new OA\Property(property: "dateStart", description: "Дата начала отображения", type: "string", example: "2023-08-08 18:00:49", nullable: true),
        new OA\Property(property: "dateEnd", description: "Дата окончания отображения", type: "string", example: "2023-12-12 23:55:31", nullable: true),
        new OA\Property(property: "status", description: "Статус (публикация)", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "isActive", description: "Активность (архив)", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "imagePreview", description: "Превью", type: "string", example: "https://api.market.ru/storage/banners/preview/5", nullable: true),
    ]
)]

class BannerSchema
{

}

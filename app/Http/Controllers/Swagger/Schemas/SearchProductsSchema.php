<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "SearchProductsSchema",
    title: "Поиск",
    required: ["name", "img", "price", "pricePromotion", "url", "statusId"],
    properties: [
        new OA\Property(property: "name", description: "Название товара", type: "string"),
        new OA\Property(property: "img", description: "Главное фото товара", type: "string"),
        new OA\Property(property: "price", description: "Цена", type: "integer", example: "5900"),
        new OA\Property(property: "pricePromotion", description: "Цена со скидкой", type: "integer", example: "4500"),
        new OA\Property(property: "shortName", description: "Короткое название", type: "string", example: "Традиционная иглотерапия творит чудеса"),
        new OA\Property(property: "url", description: "url товара", type: "string", example: "tovari/y-auhgtfra"),
        new OA\Property(property: "statusId", description: "Статус товара", type: "int", example: 2),
    ]
)]

class SearchProductsSchema
{

}

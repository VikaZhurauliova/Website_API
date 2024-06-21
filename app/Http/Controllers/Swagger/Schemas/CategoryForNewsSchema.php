<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CategoryForNewsSchema",
    title: "Категория новостей",
    required: ["id", "name", "sort", "active"],
    properties: [
        new OA\Property(property: "id", description: "Внутренний ID записи на сайте", type: "integer", example: 189),
        new OA\Property(property: "name", description: "Название категории", type: "string", example: "Здоровье", nullable: true),
        new OA\Property(property: "sort", description: "Порядок", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "active", description: "Активность", type: "integer", example: 1, nullable: true),
    ]
)]

class CategoryForNewsSchema
{

}

<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "SeoSchema",
    title: "Seo страницы без мета-тегов",
    required: ["id", "url", "title", "keywords", "description", "status", "canonical"],
    properties: [
        new OA\Property(property: "id", description: "Внутренний ID записи на сайте", type: "integer", example: 189),
        new OA\Property(property: "url", description: "URL страницы", type: "string", example: "aksessuari", nullable: true),
        new OA\Property(property: "title", description: "Заголовок страницы", type: "string", example: "Фитнес", nullable: true),
        new OA\Property(property: "keywords", description: "Ключевые слова", type: "string", example: "Фитнес", nullable: true),
        new OA\Property(property: "description", description: "Description страницы", type: "string", example: "Фитнес", nullable: true),
        new OA\Property(property: "status", description: "Статус: опубликован - не опубликован", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "canonical", description: "Canonical страницы", type: "string", example: "/aksessuari", nullable: true),
    ]
)]

class SeoSchema
{

}

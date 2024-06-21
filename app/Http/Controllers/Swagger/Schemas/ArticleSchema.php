<?php

namespace App\Http\Controllers\Swagger\Schemas;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ArticleSchema",
    title: "Статья",
    required: [
        "id",
        "title",
        "teaser",
        "body",
        "status",
        "created_at",
        "updated_at",
    ],
    properties: [
        new OA\Property(property: "id", description: "Внутренний ID записи на сайте", type: "integer", example: 189),
        new OA\Property(property: "title", description: "Заголовок страницы", type: "string", example: "кресла - перспективы технологической эволюции", nullable: true),
        new OA\Property(property: "teaser", type: "string", example: "<p>Сегодня технический прогресс всё шире охватывает индустрию производства высокотехнологичных товаров для здоровья, постоянно расширяя покупательский выбор</p>", nullable: true),
        new OA\Property(property: "body", type: "string", example: "<p>Сегодня технический прогресс всё шире охватывает индустрию производства высокотехнологичных товаров для здоровья, постоянно расширяя покупательский выбор</p>", nullable: true),
        new OA\Property(property: "status", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
        new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
        new OA\Property(property: "seo", description: "SEO страницы", type: "object", allOf: [new OA\Schema(ref: "#/components/schemas/SeoSchema")])
    ]
)]

class ArticleSchema
{

}

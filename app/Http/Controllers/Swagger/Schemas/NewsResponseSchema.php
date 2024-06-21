<?php

namespace App\Http\Controllers\Swagger\Schemas;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "NewsResponseSchema",
    title: "Новость: Response",
    properties: [
        new OA\Property(property: "id", description: "ID новости на сайте", type: "integer", example: 189),
        new OA\Property(property: "title", description: "Заголовок страницы", type: "string", example: "Новости: 15 мая состоялось от", nullable: true),
        new OA\Property(property: "teaser", type: "string", example: "<p>В клинике кинезиотерапии и реабилитац", nullable: true),
        new OA\Property(property: "body", type: "string", example: "<p>В клинике кинезиотера", nullable: true),
        new OA\Property(property: "status", type: "integer", example: 1),
        new OA\Property(property: "sticky", type: "integer", example: 1),
        new OA\Property(property: "type", type: "integer", example: 1),
        new OA\Property(property: "categories",
            description: " ID категории товара",
            type: "array",
            items: new OA\Items(
                type: "integer",example: 1
            )
        ),
        new OA\Property(property: "image_title", type: "string", example: "Новость"),
        new OA\Property(property: "image_alt", type: "string", example: "Встреча"),
        new OA\Property(
            property: "image_src",
            description: "Новое превью в Base64 или ссылка на уже загруженную картинку",
            oneOf: [
                new OA\Schema(
                    description: "URL уже загруженного изображения",
                    type: "string",
                    example: "https://api.market.ru/storage/banners/preview/bc3ca40b-70c5-493a-9c38-cbaeree10f60289.webp"
                ),
                new OA\Schema(
                    description: "null или пустое поле, если превью не загружено",
                    example: null
                )
            ]
        ),
        new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
        new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
        new OA\Property(property: "seo_url", description: "Адрес страницы", type: "string", example: "catalog/market-cape", nullable: true),
        new OA\Property(property: "seo_title", description: "Заголовок страницы", type: "string", example: "catalog/market-cape", nullable: true),
        new OA\Property(property: "seo_keywords", description: "Ключевые слова", type: "string", example: "накидки", nullable: true),
        new OA\Property(property: "seo_description", description: "Описание страницы", type: "string", example: "Кресла, на которых мы сидим, зачастую дарят нам не только удобство, но и целый букет проблем", nullable: true),
        new OA\Property(property: "seo", description: "SEO страницы", type: "object", allOf: [new OA\Schema(ref: "#/components/schemas/SeoSchema")])
    ]
)]

class NewsResponseSchema
{

}

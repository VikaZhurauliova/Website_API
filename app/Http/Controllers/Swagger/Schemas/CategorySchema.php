<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CategorySchema",
    title: "Категория",
    required: ["data"],
    properties: [
        new OA\Property(
            property: "data",
            required: [
                "id",
                "parent_id",
                "name",
                "sort",
                "description_short",
                "description_full",
                "description_app",
                "name_singular",
                "is_video_review",
                "name_video_review",
                "seo_url",
                "seo_title",
                "seo_keywords",
                "seo_description",
            ],
            properties: [
                new OA\Property(property: "id", type: "integer", example: 138),
                new OA\Property(property: "parent_id", description: "ID родительской категории", type: "integer", example: 12, nullable: true),
                new OA\Property(property: "name", description: "Название категории", type: "string", example: "фитнес", nullable: true),
                new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                new OA\Property(property: "description_short", description: "Короткое описание", type: "string", example: "фитнес", nullable: true),
                new OA\Property(property: "description_full", description: "Полное описание", type: "string", example: "фитнес", nullable: true),
                new OA\Property(property: "description_app", description: "Описание для приложения", type: "string", example: "фитнес", nullable: true),
                new OA\Property(property: "name_singular", description: "Название категории в единственном числе", type: "string", example: "Беговая дорожка", nullable: true),
                new OA\Property(property: "is_video_review", description: "Показывать блок с видеоотзывами", type: "string", example: 1, nullable: true),
                new OA\Property(property: "name_video_review", description: "Название блока с видеоотзывами", type: "integer", example: "Беговая дорожка", nullable: true),
                new OA\Property(property: "seo_url", description: "Адрес страницы", type: "string", example: "catalog/market-cape", nullable: true),
                new OA\Property(property: "seo_title", description: "Заголовок страницы", type: "string", example: "catalog/market-cape", nullable: true),
                new OA\Property(property: "seo_keywords", description: "Ключевые слова", type: "string", example: "накидки", nullable: true),
                new OA\Property(property: "seo_description", description: "Описание страницы", type: "string", example: "Кресла, на которых мы сидим, зачастую дарят нам не только удобство, но и целый букет проблем", nullable: true),
                new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2023-11-01T01:00:21.000000Z", nullable: true),
                new OA\Property(property: "filters", description: "Фильтры", type: "object", allOf: [
                    new OA\Schema(
                        properties: [
                            new OA\Property(property: "params", description: "Параметры", type: "object", allOf: [
                                new OA\Schema(
                                    properties: [
                                        new OA\Property(property: "name", description: "Название параметра", type: "string", example: "Артикул"),
                                        new OA\Property(property: "filters", description: "Название фильтров", type: "object")
                                    ]
                                )
                            ])
                        ]
                    )
                ])
            ],
            type: "object"
        )
    ]
)]

class CategorySchema
{

}

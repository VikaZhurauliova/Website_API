<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CategoryListSchema",
    title: "Категория в списке",
    required: ["id", "parent_id", "name", "products_qnt", "filters_qnt", "subcategories"],
    properties: [
        new OA\Property(property: "id", type: "integer", example: 2),
        new OA\Property(property: "parent_id", description: "ID родительской категории", type: "integer", example: 2, nullable: true),
        new OA\Property(property: "name", description: "Название категории", type: "string", example: "кресла", nullable: true),
        new OA\Property(property: "products_qnt", description: "Количество товаров в категории", type: "integer", example: 10),
        new OA\Property(property: "filters_qnt", description: "Количество фильтров в категории", type: "integer", example: 5),
        new OA\Property(
            property: "type",
            type: "array",
            items: new OA\Items(
                properties: [
                    new OA\Property(property: "id", type: "integer", example: 85),
                    new OA\Property(property: "name", description: "Название типа", type: "string", example: "Подкатегории каталога"),
                    new OA\Property(property: "description", description: "Описание типа категорий", type: "string", example: "Подкатегории, которые видят клиенты на сайте в разделе Каталог"),
                ]
            )
        ),
        new OA\Property(
            property: "subcategories",
            type: "array",
            items: new OA\Items(
                properties: [
                    new OA\Property(property: "id", type: "integer", example: 85),
                    new OA\Property(property: "parent_id", description: "ID родительской категории", type: "integer", example: 2, nullable: true),
                    new OA\Property(property: "name", description: "Название категории", type: "string", example: "кресла", nullable: true),
                    new OA\Property(property: "products_qnt", description: "Количество товаров в категории", type: "integer", example: 10),
                    new OA\Property(property: "filters_qnt", description: "Количество фильтров в категории", type: "integer", example: 5),
                    new OA\Property(
                        property: "type",
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 85),
                                new OA\Property(property: "name", description: "Название типа", type: "string", example: "Подкатегории каталога"),
                                new OA\Property(property: "description", description: "Описание типа категорий", type: "string", example: "Подкатегории, которые видят клиенты на сайте в разделе Каталог"),
                            ]
                        )
                    ),
                    new OA\Property(property: "subcategories", type: "array", items: new OA\Items(), example: "[]")
                ]
            )
        )
    ]
)]

class CategoryListSchema
{

}

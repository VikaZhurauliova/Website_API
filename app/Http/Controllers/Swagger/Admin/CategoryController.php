<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / Category",
    description: "Админка / Категории товаров"
)]
#[OA\Get(
    path: "/api/admin/categories/schema",
    summary: "Список категорий товаров с вложенностью",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Category"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        title: "CategoryList",
                        required: ["data"],
                        properties: [
                            new OA\Property(
                                property: "data",
                                type: "array",
                                items: new OA\Items(
                                    allOf: [
                                        new OA\Schema(ref: "#/components/schemas/CategoryListSchema")
                                    ]
                                )
                            )
                        ]
                    )
                ]
            )
        )
    ]
)]
#[OA\Get(
    path: "/api/admin/categories/{category}",
    summary: "Одна категория",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Category"],
    parameters: [
        new OA\Parameter(
            name: "category",
            description: "ID категории",
            in: "path",
            required: true,
            example: 1
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(ref: "#/components/schemas/CategorySchema")
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]
#[OA\Post(
    path: "/api/admin/categories",
    summary: "Создание категории",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: [
                        "name",
                        "seo_url",
                    ],
                    properties: [
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
                    ],
                )
            ]
        )
    ),
    tags: ["Admin / Category"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                required: ["data", "revalidatePath"],
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "object",
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/CategorySchema")
                        ]
                    ),
                    new OA\Property(
                        property: "revalidatePath",
                        ref: "#/components/schemas/RevalidatePath"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]
#[OA\Patch(
    path: "/api/admin/categories/{category}",
    summary: "Обновление категории",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: [
                        "id",
                        "name",
                        "seo",
                        "seo_url",
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
                         new OA\Property(
                            property: "seo",
                            type: "object",
                            allOf: [
                                new OA\Schema(ref: "#/components/schemas/SeoSchema")
                            ]
                        ),
                    ],
                )
            ]
        )
    ),
    tags: ["Admin / Category"],
    parameters: [
        new OA\Parameter(
            name: "category",
            description: "ID категории",
            in: "path",
            required: true,
            example: 1
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                required: ["data", "revalidatePath"],
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "object",
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/CategorySchema")
                        ]
                    ),
                    new OA\Property(
                        property: "revalidatePath",
                        ref: "#/components/schemas/RevalidatePath"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]
#[OA\Get(
    path: "/api/admin/categories/list",
    summary: "Список всех категорий товаров",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Category"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        title: "CategoryList",
                        required: ["data"],
                        properties: [
                            new OA\Property(
                                property: "data",
                                type: "array",
                                items: new OA\Items(
                                    required: ["id", "parent_id", "name", "sort"],
                                    properties: [
                                        new OA\Property(property: "id", type: "integer", example: 2),
                                        new OA\Property(property: "parent_id", description: "ID родительской категории", type: "integer", example: 2, nullable: true),
                                        new OA\Property(property: "name", description: "Название категории", type: "string", example: "Массажеры", nullable: true),
                                        new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 2, nullable: true)
                                    ]
                                )
                            )
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401)
    ]
)]
#[OA\Get(
    path: "/api/admin/categories/types",
    summary: "Список всех типов категорий товаров",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Category"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        title: "CategoryList",
                        required: ["data"],
                        properties: [
                            new OA\Property(
                                property: "data",
                                type: "array",
                                items: new OA\Items(
                                    required: ["id", "name"],
                                    properties: [
                                        new OA\Property(property: "id", type: "integer", example: 2),
                                        new OA\Property(property: "name", description: "Название типа", type: "string", example: "Подкатегории каталога"),
                                        new OA\Property(property: "description", description: "Описание типа категорий", type: "string", example: "Подкатегории, которые видят клиенты на сайте в разделе Каталог", nullable: true)
                                    ]
                                )
                            )
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401)
    ]
)]
#[OA\Get(
    path: "/api/admin/categories",
    summary: "Список всех категорий товаров",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Category"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "data", type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 138),
                                new OA\Property(property: "parent_id", description: "ID родительской категории", type: "integer", example: 12, nullable: true),
                                new OA\Property(property: "name", description: "Название категории", type: "string", example: "фитнес", nullable: true),
                                new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                                new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                                new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2023-11-01T01:00:21.000000Z", nullable: true),
                            ])
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401)
    ]
)]
#[OA\Delete(
    path: "/api/admin/categories/{category}",
    summary: "Удаление категории",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Category"],
    parameters: [
        new OA\Parameter(
            name: "category",
            description: "ID категории",
            in: "path",
            required: true,
            example: 1
        )
    ],
    responses: [
        new OA\Response(
            response: 204,
            description: "Категория удалена",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "message",
                        type: "string",
                        example: "Категория удалена"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]
class CategoryController extends Controller
{

}

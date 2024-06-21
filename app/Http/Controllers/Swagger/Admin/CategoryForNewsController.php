<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / CategoryForNews",
    description: "Админка / Категории новостей"
)]
#[OA\Get(
    path: "/api/admin/category_for_news",
    summary: "Список категорий новостей",
    security: [["bearerAuth" => []]],
    tags: ["Admin / CategoryForNews"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        title: "CategoryForNews",
                        required: ["data"],
                        properties: [
                            new OA\Property(
                                property: "data",
                                type: "array",
                                items: new OA\Items(
                                    allOf: [
                                        new OA\Schema(ref: "#/components/schemas/CategoryForNewsSchema")
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
    path: "/api/admin/category_for_news/{category_for_news}",
    summary: "Одна категория новостей",
    security: [["bearerAuth" => []]],
    tags: ["Admin / CategoryForNews"],
    parameters: [
        new OA\Parameter(
            name: "category_for_news",
            description: "ID категории",
            in: "path",
            required: true,
            example: 3
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(ref: "#/components/schemas/CategoryForNewsSchema")
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

#[OA\Post(
    path: "/api/admin/category_for_news",
    summary: "Создание категории новостей",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: [
                        "name",
                    ],
                    properties: [
                        new OA\Property(property: "name", description: "Название категории для новости", type: "string", example: "фитнес"),
                        new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                        new OA\Property(property: "active", description: "Активность", type: "boolean", example: 1, nullable: true),
                    ],
                )
            ]
        )
    ),
    tags: ["Admin / CategoryForNews"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Ok",
            content: new OA\JsonContent(
                required: ["data"],
                properties: [
                    new OA\Property(
                        property: "data",
                        required: ["name"],
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", description: "Название категории для новости", type: "string", example: "фитнес"),
                            new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                            new OA\Property(property: "active", description: "Активность", type: "boolean", example: 1, nullable: true),
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/422", response: 422),
    ]
)]

#[OA\Delete(
    path: "/api/admin/category_for_news/{category_for_news}",
    summary: "Удаление категории новостей",
    security: [["bearerAuth" => []]],
    tags: ["Admin / CategoryForNews"],
    parameters: [
        new OA\Parameter(
            name: "category_for_news",
            description: "ID категории для новости",
            in: "path",
            required: true,
            example: 1
        )
    ],
    responses: [
        new OA\Response(
            response: 204,
            description: "Категория для новости удалена",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "message",
                        type: "string",
                        example: "Категория для новости удалена"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]


#[OA\Patch(
    path: "/api/admin/category_for_news/{category_for_news}",
    summary: "Обновление категории новостей",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: [
                        "name",
                    ],
                    properties: [
                        new OA\Property(property: "name", description: "Название категории для новости", type: "string", example: "фитнес"),
                        new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                        new OA\Property(property: "active", description: "Активность", type: "boolean", example: 1, nullable: true),
                    ],
                )
            ]
        )
    ),
    tags: ["Admin / CategoryForNews"],
    parameters: [
        new OA\Parameter(
            name: "category_for_news",
            description: "ID категории для новости",
            in: "path",
            required: true,
            example: 1
        )
    ],
    responses: [
        new OA\Response(
            response: 201,
            description: "Ok",
            content: new OA\JsonContent(
                required: ["data"],
                properties: [
                    new OA\Property(
                        property: "data",
                        required: ["name"],
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", description: "Название категории для новости", type: "string", example: "фитнес"),
                            new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                            new OA\Property(property: "active", description: "Активность", type: "boolean", example: 1, nullable: true),
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/422", response: 422),
    ]
)]
class CategoryForNewsController extends Controller
{

}

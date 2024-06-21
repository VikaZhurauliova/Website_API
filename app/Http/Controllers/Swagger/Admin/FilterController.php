<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / ProductFilter",
    description: "Админка / Фильтры"
)]

#[OA\Get(
    path: "/api/admin/product_filters",
    summary: "Список фильтров",
    security: [["bearerAuth" => []]],
    tags: ["Admin / ProductFilter"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "name", description: "Наименование фильтра", type: "string", example: "Фильтр"),
                            ]
                        )
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401)
    ]
)]

#[OA\Post(
    path: "/api/admin/product_filters",
    summary: "Создание нового фильтра",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        description: "Создание нового фильтра",
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: "name",
                    description: "Название фильтра",
                    type: "string",
                    example: "Фильтр"
                ),
            ]
        )
    ),
    tags: ["Admin / ProductFilter"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Фильтр успешно создан",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 12),
                            new OA\Property(property: "name", description: "Название фильтра", type: "string", example: "Фильтр"),
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/400", response: 400),
        new OA\Response(ref: "#/components/responses/401", response: 401)
    ]
)]

#[OA\Patch(
    path: "/api/admin/product_filters/{product_filters}",
    summary: "Обновление фильтра",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: [
                        "name"
                    ],
                    properties: [
                        new OA\Property(property: "name", description: "Название фильтра", type: "string", example: "Фильтр"),
                    ],
                )
            ]
        )
    ),
    tags: ["Admin / ProductFilter"],
    parameters: [
        new OA\Parameter(
            name: "product_filters",
            description: "ID фильтра",
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
                required: ["data"],
                properties: [
                    new OA\Property(property: "id", type: "integer", example: 12),
                    new OA\Property(property: "name", description: "Название фильтра", type: "string", example: "Фильтр"),
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

#[OA\Delete(
    path: "/api/admin/product_filters/{product_filters}",
    summary: "Удаление фильтра",
    security: [["bearerAuth" => []]],
    tags: ["Admin / ProductFilter"],
    parameters: [
        new OA\Parameter(
            name: "product_filters",
            description: "ID фильтра",
            in: "path",
            required: true,
            example: 1
        )
    ],
    responses: [
        new OA\Response(ref: "#/components/responses/204", response: 204),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

class FilterController extends Controller
{

}

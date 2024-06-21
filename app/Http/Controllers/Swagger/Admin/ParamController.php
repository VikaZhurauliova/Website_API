<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / ProductParam",
    description: "Админка / Параметры товаров"
)]

#[OA\Get(
    path: "/api/admin/product_params",
    summary: "Список параметров",
    security: [["bearerAuth" => []]],
    tags: ["Admin / ProductParam"],
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
                                new OA\Property(property: "name", description: "Наименование параметра", type: "string", example: "Ширина"),
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
    path: "/api/admin/product_params",
    summary: "Создание нового параметра",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        description: "Создание нового параметра",
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: "name",
                    description: "Название параметра",
                    type: "string",
                    example: "Ширина"
                ),
            ]
        )
    ),
    tags: ["Admin / ProductParam"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Параметр успешно создан",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 12),
                            new OA\Property(property: "name", description: "Название параметра", type: "string", example: "Ширина"),
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
    path: "/api/admin/product_params/{product_params}",
    summary: "Обновление параметра",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: [
                        "name"
                    ],
                    properties: [
                        new OA\Property(property: "name", description: "Название параметра", type: "string", example: "Высота"),
                    ],
                )
            ]
        )
    ),
    tags: ["Admin / ProductParam"],
    parameters: [
        new OA\Parameter(
            name: "product_params",
            description: "ID параметра",
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
                    new OA\Property(property: "name", description: "Название параметра", type: "string", example: "Высота"),
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

#[OA\Delete(
    path: "/api/admin/product_params/{product_params}",
    summary: "Удаление параметра",
    security: [["bearerAuth" => []]],
    tags: ["Admin / ProductParam"],
    parameters: [
        new OA\Parameter(
            name: "product_params",
            description: "ID параметра",
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

class ParamController extends Controller
{

}

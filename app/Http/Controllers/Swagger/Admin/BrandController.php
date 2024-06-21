<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / Brand",
    description: "Админка / Бренды"
)]

#[OA\Get(
    path: "/api/admin/brands",
    summary: "Список брендов",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Brand"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                required: ["data"],
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 4),
                                new OA\Property(property: "name", description: "Название бренда", type: "string", example: "Маркет"),
                                new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                                new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                                new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                            ],
                            type: "object"
                        )
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
    ]
)]

#[OA\Get(
    path: "/api/admin/brands/{brand}",
    summary: "Один бренд",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Brand"],
    parameters: [
        new OA\Parameter(
            name: "brand",
            description: "ID бренда",
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
                properties: [
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 4),
                            new OA\Property(property: "name", description: "Название бренда", type: "string", example: "Маркет"),
                            new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: "Укрепи дружбу", nullable: true),
                            new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                            new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)

    ]
)]

#[OA\Patch(
    path: "/api/admin/brands/{brand}",
    summary: "Обновление бренда",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: [
                        "name"
                    ],
                    properties: [
                        new OA\Property(property: "name", description: "Название бренда", type: "string", example: "Маркет"),
                    ],
                )
            ]
        )
    ),
    tags: ["Admin / Brand"],
    parameters: [
        new OA\Parameter(
            name: "brand",
            description: "ID бренда",
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
                    new OA\Property(property: "name", description: "Название бренда", type: "string", example: "Маркет"),
                    new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: "Укрепи дружбу", nullable: true),
                    new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                    new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

#[OA\Delete(
    path: "/api/admin/brands/{brand}",
    summary: "Удаление бренда",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Brand"],
    parameters: [
        new OA\Parameter(
            name: "brand",
            description: "ID бренда",
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

#[OA\Post(
    path: "/api/admin/brands",
    summary: "Создание нового бренда",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        description: "Создание нового бренда",
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "name", description: "Название бренда", type: "string", example: "Маркет"),
            ]
        )
    ),
    tags: ["Admin / Brand"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Бренд успешно создан",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 12),
                            new OA\Property(property: "name", description: "Название бренда", type: "string", example: "Маркет"),
                            new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                            new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                            new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
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
class BrandController extends Controller
{

}

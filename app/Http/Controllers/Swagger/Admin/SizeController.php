<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / Size",
    description: "Админка / Размеры товаров"
)]

#[OA\Get(
    path: "/api/admin/sizes",
    summary: "Список размеров",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Size"],
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
                                new OA\Property(property: "id", type: "integer", example: 3),
                                new OA\Property(property: "name", description: "Название размера", type: "string", example: "S", nullable: true),
                                new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                            ]
                        )
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
    ]
)]

#[OA\Get(
    path: "/api/admin/sizes/{size}",
    summary: "Один размер",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Size"],
    parameters: [
        new OA\Parameter(
            name: "size",
            description: "ID размера",
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
                            new OA\Property(property: "id", type: "integer", example: 3),
                            new OA\Property(property: "name", description: "Название размера", type: "string", example: "S", nullable: true),
                            new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
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

class SizeController extends Controller
{

}

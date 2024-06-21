<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / RentType",
    description: "Админка / Типы аренды"
)]

#[OA\Get(
    path: "/api/admin/rent_types",
    summary: "Список типов аренды",
    security: [["bearerAuth" => []]],
    tags: ["Admin / RentType"],
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
                                new OA\Property(property: "name", description: "Название типа аренды", type: "string", example: "Аренда на 1 месяц", nullable: true),
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
    path: "/api/admin/rent_types/{rent_type}",
    summary: "Один тип аренды",
    security: [["bearerAuth" => []]],
    tags: ["Admin / RentType"],
    parameters: [
        new OA\Parameter(
            name: "rent_type",
            description: "ID типа аренды",
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
                            new OA\Property(property: "name", description: "Название типа аренды", type: "string", example: "Аренда на 1 месяц", nullable: true),
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

class RentTypeController extends Controller
{

}

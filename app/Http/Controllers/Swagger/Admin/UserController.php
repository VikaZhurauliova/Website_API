<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / User",
    description: "Админка / Пользователи"
)]
#[OA\Get(
    path: "/api/admin/users",
    summary: "Список",
    security: [["bearerAuth" => []]],
    tags: ["Admin / User"],
    parameters: [
        new OA\Parameter(name: "phone", description: "Номер телефона для поиска", in: "query", example: "354"),
        new OA\Parameter(name: "full_name", description: "Имя для поиска", in: "query", example: "Иван"),
        new OA\Parameter(name: "email", description: "Почта для поиска", in: "query", example: "admin@gmail.com"),
        new OA\Parameter(name: "per_page", description: "Пагинация", in: "query", example: "15")
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "data", type: "array",
                        items: new OA\Items(
                            allOf: [
                                new OA\Schema(ref: "#/components/schemas/UserSchema")
                            ]
                        )
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401)
    ]
)]

#[OA\Get(
    path: "/api/admin/users/{user}",
    summary: "Один пользователь",
    security: [["bearerAuth" => []]],
    tags: ["Admin / User"],
    parameters: [
        new OA\Parameter(name: "user", description: "ID пользователя", in: "path", required: true, example: 1)
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        title: "User",
                        required: ["data"],
                        properties: [
                            new OA\Property(property: "data", type: "array",
                                items: new OA\Items(
                                    allOf: [
                                        new OA\Schema(ref: "#/components/schemas/UserSchema")
                                    ]
                                )
                            )
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

#[OA\Patch(
    path: "/api/admin/users/{user}",
    summary: "Обновление пользователя",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 1),
                        new OA\Property(property: "first_name", type: "string", example: "Иван", nullable: true),
                        new OA\Property(property: "middle_name", type: "string", example: "Иванович", nullable: true),
                        new OA\Property(property: "last_name", type: "string", example: "Иванов", nullable: true),
                        new OA\Property(property: "email", type: "string", example: "test@gmail.com"),
                        new OA\Property(property: "role", type: "string", example: "admin"),
                        new OA\Property(property: "phone", type: "string", example: "79265656738", nullable: true),
                        new OA\Property(property: "customer_id", type: "integer", example: "3546613", nullable: true),
                    ],
                )
            ]
        )
    ),
    tags: ["Admin / User"],
    parameters: [
        new OA\Parameter(
            name: "user",
            description: "ID пользователя",
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
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "first_name", type: "string", example: "Иван", nullable: true),
                            new OA\Property(property: "middle_name", type: "string", example: "Иванович", nullable: true),
                            new OA\Property(property: "last_name", type: "string", example: "Иванов", nullable: true),
                            new OA\Property(property: "email", type: "string", example: "test@gmail.com"),
                            new OA\Property(property: "role", type: "string", example: "admin"),
                            new OA\Property(property: "phone", type: "string", example: "79265656738", nullable: true),
                            new OA\Property(property: "customer_id", type: "integer", example: "3546613", nullable: true),
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

class UserController extends Controller
{

}

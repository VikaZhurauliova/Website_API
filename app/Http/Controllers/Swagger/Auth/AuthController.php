<?php

namespace App\Http\Controllers\Swagger\Auth;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Auth",
    description: "Авторизация и аутентификация"
)]

#[OA\Post(
    path: "/api/auth/login",
    summary: "Авторизация",
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    properties: [
                        new OA\Property(property: "email", type: "string", example: "email@domain.com"),
                        new OA\Property(property: "password", type: "string", example: "password"),
                    ]
                )
            ]
        )
    ),
    tags: ["Auth"],
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
                            new OA\Property(property: "access_token", type: "string", example: "foobar"),
                            new OA\Property(property: "token_type", type: "string", example: "bearer"),
                            new OA\Property(property: "expires_in", type: "integer", example: 201),
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401)
    ]
)]

#[OA\Post(
    path: "/api/auth/logout",
    summary: "Выход",
    security: [["bearerAuth" => []]],
    tags: ["Auth"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "message", type: "string", example: "Successfully logged out"),
                ]
            )
        )
    ]
)]

#[OA\Post(
    path: "/api/auth/me",
    summary: "Данные пользователя",
    security: [["bearerAuth" => []]],
    tags: ["Auth"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                required: ["id", "first_name", "middle_name", "last_name", "email", "role", "phone", "created_at", "updated_at"],
                properties: [
                    new OA\Property(property: "id", type: "integer", example: 1),
                    new OA\Property(property: "first_name", description: "Имя", type: "string", example: "Иван", nullable: true),
                    new OA\Property(property: "middle_name", description: "Отчество", type: "string", example: "Иванович", nullable: true),
                    new OA\Property(property: "last_name", description: "Фамилия", type: "string", example: "Иванов", nullable: true),
                    new OA\Property(property: "email", description: "Email", type: "string", example: "user@email.com"),
                    new OA\Property(property: "role", description: "Роль", type: "string", example: "user", nullable: true),
                    new OA\Property(property: "phone", description: "Телефон", type: "string", example: "9151711111", nullable: true),
                    new OA\Property(property: "created_at", type: "date-time", example: "2023-07-07T07:11:40.000000Z"),
                    new OA\Property(property: "updated_at", type: "date-time", example: "2023-07-07T07:11:40.000000Z"),
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401)
    ]
)]

#[OA\Get(
    path: "/api/auth/guest_id",
    summary: "ID гостя",
    tags: ["Auth"],
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
                            new OA\Property(property: "access_token", type: "string", example: "anon_65cc651932bdd5.02075262"),
                            new OA\Property(property: "token_type", type: "string", example: "bearer"),
                            new OA\Property(property: "expires_in", type: "integer", example: 1209600),
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
    ]
)]

class AuthController extends Controller
{
    //
}

<?php
namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Market API"
)]
#[OA\PathItem(
    path: "/api/"
)]
#[OA\Components(
    securitySchemes: [
        new OA\SecurityScheme(
            securityScheme: "bearerAuth",
            type: "http",
            scheme: "bearer"
        )
    ]
)]
#[OA\Response(
    response: 204,
    description: "Ресурс удалён",
    content: new OA\MediaType(mediaType: "application/json")
)]
#[OA\Response(
    response: 400,
    description: "Error: Bad Request",
    content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: "message",
                type: "string",
                example: "Некорректный запрос серверу"
            )
        ]
    )
)]
#[OA\Response(
    response: 401,
    description: "Error: Unauthorized",
    content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: "message",
                type: "string",
                example: "Unauthenticated"
            )
        ]
    )
)]
#[OA\Response(
    response: 404,
    description: "Error: Not Found",
    content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: "message",
                type: "string",
                example: "Запрашиваемый ресурс не найден в базе"
            )
        ]
    )
)]
#[OA\Response(
    response: 422,
    description: "Error: Unprocessable Content",
    content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: "message",
                type: "string",
                example: "Описание ошибки"
            )
        ]
    )
)]
#[OA\Response(
    response: 500,
    description: "Error: Unprocessable Content",
    content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: "message",
                type: "string",
                example: "Описание ошибки"
            )
        ]
    )
)]
#[OA\Schema(
    schema: "RevalidatePath",
    description: "Где используется",
    type: "array",
    items: new OA\Items(type: "string", example: "market.ru")
)]
#[OA\Tag(
    name: "Test",
    description: "Функции для разработки и тестирования"
)]
#[OA\Post(
    path: "/api/test",
    summary: "Тестовый метод",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    properties: [
                        new OA\Property(
                            property: "key",
                            type: "string",
                            example: "value",
                            nullable: true
                        )
                    ]
                )
            ]
        )
    ),
    tags: ["Test"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent()
        )
    ]
)]

class MainController extends Controller
{
    //
}


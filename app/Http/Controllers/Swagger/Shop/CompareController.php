<?php

namespace App\Http\Controllers\Swagger\Shop;
use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;

#[OA\Tag(
    name: "Shop / Compare",
    description: "Сайт / Сравнение"
)]

#[OA\Get(
    path: "/api/shop/compare",
    summary: "Список сравнения товаров пользователя",
    security: [["bearerAuth" => []]],
    tags: ["Shop / Compare"],
    parameters: [
        new OA\Parameter(
            name: "domain",
            description: "Домен",
            in: "query",
            required: true,
            example: "market.ru"
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
                        type: "array",
                        items: new OA\Items(
                            allOf: [
                                new OA\Schema(ref: "#/components/schemas/CompareSchema")
                            ]
                        )
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
    ]
)]

#[OA\Post(
    path: "/api/shop/add_to_compare",
    summary: "Добавление товара в сравнение",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: ["product_id"],
                    properties: [
                        new OA\Property(property: "product_id", description: "ID товара", type: "integer", example: 7),
                        new OA\Property(property: "domain", description: "Домен, с которого отправлен заказ", type: "string", example: "market.ru"),
                    ]
                )
            ]
        )
    ),
    tags: ["Shop / Compare"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Товар добавлен в сравнение",
            content: new OA\JsonContent(
                required: ["data"],
                properties: [
                    new OA\Property(
                        property: "data",
                        required: ["id"],
                        properties: [
                            new OA\Property(property: "id", description: "ID записи в сравнении", type: "number", example: 5),
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/422", response: 422)
    ]
)]

#[OA\Delete(
    path: "/api/shop/compare/{compare}",
    summary: "Удаление товара из сравнения",
    security: [["bearerAuth" => []]],
    tags: ["Shop / Compare"],
    parameters: [
        new OA\Parameter(
            name: "compare",
            description: "ID записи в избранном",
            in: "path",
            required: true,
            example: 7
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
                        type: "object",
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/CompareSchema")
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/204", response: 204),
        new OA\Response(ref: "#/components/responses/404", response: 404),
        new OA\Response(ref: "#/components/responses/500", response: 500)
    ]
)]

class CompareController extends Controller
{

}

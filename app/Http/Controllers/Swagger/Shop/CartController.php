<?php

namespace App\Http\Controllers\Swagger\Shop;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Shop / Cart",
    description: "Сайт / Корзина"
)]

#[OA\Get(
    path: "/api/shop/cart",
    summary: "Корзина пользователя",
    security: [["bearerAuth" => []]],
    tags: ["Shop / Cart"],
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
                    required: ["items", "itemsSum", "deliverySum", "totalSum"],
                    properties: [
                        new OA\Property(property: "items", description: "Состав корзины", type: "array",
                            items: new OA\Items(
                                allOf: [
                                    new OA\Schema(ref: "#/components/schemas/CartItemSchema")
                                ]
                            )
                        ),
                        new OA\Property(property: "itemsSum", description: "Сумма товаров в корзине", type: "number", example: 5000),
                        new OA\Property(property: "deliverySum", description: "Сумма доставки", type: "number", example: 800),
                        new OA\Property(property: "totalSum", description: "Сумма итого", type: "number", example: 5800)
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
    path: "/api/shop/add_to_cart",
    summary: "Добавление товара в корзину",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: ["product_id", "quantity"],
                    properties: [
                        new OA\Property(property: "product_id", type: "integer", example: 7),
                        new OA\Property(property: "quantity", description: "Количество", type: "integer", example: 1),
                        new OA\Property(property: "domain", description: "Домен, с которого отправлен заказ", type: "string", example: "market.ru"),
                    ]
                )
            ]
        )
    ),
    tags: ["Shop / Cart"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Товар добавлен в корзину",
            content: new OA\JsonContent(
                required: ["data"],
                properties: [
                    new OA\Property(
                        property: "data",
                        required: ["id"],
                        properties: [
                            new OA\Property(property: "id", description: "ID записи в корзине", type: "number", example: 5),
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/400", response: 400),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/422", response: 422)
    ]
)]

#[OA\Delete(
    path: "/api/shop/cart/{cart}",
    summary: "Удаление товара из корзины",
    security: [["bearerAuth" => []]],
    tags: ["Shop / Cart"],
    parameters: [
        new OA\Parameter(
            name: "cart",
            description: "ID записи в корзине",
            in: "path",
            required: true,
            example: 7
        )
    ],
    responses: [
        new OA\Response(ref: "#/components/responses/204", response: 204),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

class CartController extends Controller
{

}

<?php

namespace App\Http\Controllers\Swagger\Shop;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Shop / Order",
    description: "Сайт / Заказ"
)]

#[OA\Get(
    path: "/api/shop/order",
    summary: "Список всех заказов текущего пользователя",
    security: [["bearerAuth" => []]],
    tags: ["Shop / Order"],
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
                                new OA\Schema(ref: "#/components/schemas/OrderSchema")
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
    path: "/api/shop/order",
    summary: "Отправка заказа из корзины",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: ["name", "phone", "comment", "domain"],
                    properties: [
                        new OA\Property(property: "name", description: "Имя покупателя",  example: "Иван"),
                        new OA\Property(property: "phone", description: "Телефон покупателя", example: "+375 (33) 6938346"),
                        new OA\Property(property: "email", description: "Email покупателя", type: "string", example: "email@domain.com"),
                        new OA\Property(property: "address", description: "Адрес доставки", type: "string", example: "Минск"),
                        new OA\Property(property: "comment", description: "Комментарий к заказу", type: "string", example: "Текст комментария"),
                        new OA\Property(property: "domain", description: "Домен, с которого отправляется заказ", type: "string", example: "market.ru"),
                    ]
                )
            ]
        )
    ),
    tags: ["Shop / Order", "Shop / Cart"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Заказ отправлен",
            content: new OA\JsonContent(
                required: ["data"],
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "object",
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/OrderSchema")
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404),
        new OA\Response(ref: "#/components/responses/422", response: 422)
    ]
)]

#[OA\Post(
    path: "/api/shop/order/fast",
    summary: "Быстрая покупка или Обратный звонок",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            oneOf: [
                new OA\Schema(
                    title: "Форма быстрого заказа",
                    required: ["name", "phone", "type", "domain", "url", "product_id"],
                    properties: [
                        new OA\Property(property: "name", description: "Имя покупателя", type: "string", example: "Иван"),
                        new OA\Property(property: "phone", description: "Телефон покупателя", type: "string", example: "+375 (33) 6938346"),
                        new OA\Property(property: "type", description: "Тип действия", type: "string", enum: ["Форма быстрого заказа"], example: "Заказать обратный звонок"),
                        new OA\Property(property: "domain", description: "Домен, с которого отправляется заказ", type: "string", example: "market.ru"),
                        new OA\Property(property: "url", description: "Адрес страницы, с которой отправляется заказ", type: "string", example: "https://market.ru)"),
                        new OA\Property(property: "product_id", description: "ID товара", type: "integer", example: 43)
                    ]
                ),
                new OA\Schema(
                    title: "Заказать обратный звонок",
                    required: ["name", "phone", "type", "domain", "url"],
                    properties: [
                        new OA\Property(property: "name", description: "Имя покупателя", type: "string", example: "Иван"),
                        new OA\Property(property: "phone", description: "Телефон покупателя", type: "string", example: "+375 (33) 6938346"),
                        new OA\Property(property: "type", description: "Тип действия", type: "string", enum: ["Заказать обратный звонок"], example: "Заказать обратный звонок"),
                        new OA\Property(property: "domain", description: "Домен, с которого отправляется заказ", type: "string", example: "market.ru"),
                        new OA\Property(property: "url", description: "Адрес страницы, с которой отправляется заказ", type: "string", example: "https://market.ru")
                    ]
                )
            ]
        )
    ),
    tags: ["Shop / Order"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Заказ отправлен",
            content: new OA\JsonContent(
                required: ["data"],
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "object",
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/OrderSchema")
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/400", response: 400),
        new OA\Response(ref: "#/components/responses/404", response: 404),
        new OA\Response(ref: "#/components/responses/422", response: 422)
    ]
)]

class OrderController extends Controller
{

}

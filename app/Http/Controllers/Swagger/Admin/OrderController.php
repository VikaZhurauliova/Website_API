<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / Order",
    description: "Сайт / Заказ"
)]

#[OA\Get(
    path: "/api/admin/orders",
    summary: "Все заказы",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Order"],
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
                                new OA\Property(property: "id", description: "ID заказа на сайте", type: "integer", example: 1),
                                new OA\Property(property: "ya_orders_id", description: "ID заказа в борбозе", type: "integer", example: 1),
                                new OA\Property(property: "name", description: "Имя покупателя", type: "string", example: "Иван"),
                                new OA\Property(property: "phone", description: "Телефон покупателя", type: "string", example: "+375 (33) 6828654"),
                                new OA\Property(property: "email", description: "Email покупателя", type: "string", example: "email@domain.com"),
                                new OA\Property(property: "items_sum", description: "Сумма товаров в корзине", type: "integer", example: 5000),
                                new OA\Property(property: "delivery_sum", description: "Стоимость доставки", type: "integer", example: 5000),
                                new OA\Property(property: "sum", description: "Полная сумма заказа", type: "integer", example: 5000),
                                new OA\Property(property: "created_at", description: "Дата создания", type: "date-time", example: "2023-07-07T07:11:40.000000Z"),
                                new OA\Property(property: "updated_at", description: "Дата обновления", type: "date-time", example: "2023-07-07T07:11:40.000000Z"),
                                new OA\Property(property: "user_id", description: "ID пользователя на сайте", type: "integer", example: 1, nullable: true),
                                new OA\Property(property: "address", description: "Адрес доставки", type: "string", example: "Минск, Независимости"),
                                new OA\Property(property: "comment", description: "Комментарий к заказу", type: "string", example: "Текст комментария"),
                                new OA\Property(property: "domain", description: "Домен, с которого отправлен заказ", type: "string", example: "market.ru"),
                            ],
                        )
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
    ]
)]

#[OA\Get(
    path: "/api/admin/orders/{order}",
    summary: "Один заказ",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Order"],
    parameters: [
        new OA\Parameter(
            name: "order",
            description: "ID заказа",
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
                        type: "object",
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/OrderSchema")
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

class OrderController extends Controller
{

}

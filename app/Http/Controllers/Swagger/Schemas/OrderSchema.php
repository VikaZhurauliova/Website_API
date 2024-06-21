<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "OrderSchema",
    title: "Заказ",
    required: ["id", "name", "phone", "email", "sum", "created_at"],
    properties: [
        new OA\Property(property: "id", description: "ID заказа на сайте", type: "integer", example: 1),
        new OA\Property(property: "name", description: "Имя покупателя", type: "string", example: "Иван"),
        new OA\Property(property: "phone", description: "Телефон покупателя", type: "string", example: "+7 (926) 123-45-67"),
        new OA\Property(property: "email", description: "Email покупателя", type: "string", example: "email@domain.com"),
        new OA\Property(property: "items_sum", description: "Сумма товаров в корзине", type: "integer", example: 5000),
        new OA\Property(property: "delivery_sum", description: "Стоимость доставки", type: "integer", example: 5000),
        new OA\Property(property: "sum", description: "Полная сумма заказа", type: "integer", example: 5000),
        new OA\Property(property: "created_at", description: "Дата создания", type: "date-time", example: "2023-07-07T07:11:40.000000Z"),
        new OA\Property(property: "updated_at", description: "Дата обновления", type: "date-time", example: "2023-07-07T07:11:40.000000Z"),
        new OA\Property(property: "user_id", description: "ID пользователя на сайте", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "address", description: "Адрес доставки", type: "string", example: "Минск"),
        new OA\Property(property: "comment", description: "Комментарий к заказу", type: "string", example: "Текст комментария"),
        new OA\Property(property: "domain", description: "Домен, с которого отправлен заказ", type: "string", example: "us-market.ru"),
        new OA\Property(property: "items", description: "Состав заказа", type: "array", items: new OA\Items(
            required: ["product", "quantity", "price"],
            properties: [
                new OA\Property(property: "quantity", description: "Количество товаров", type: "integer", example: 2),
                new OA\Property(property: "price", description: "Цена, по которой был оформлен заказ", type: "integer", example: 5000),
                new OA\Property(property: "product", description: "Товар", type: "object", allOf: [new OA\Schema(ref: "#/components/schemas/ShopProductSchema")])
            ]
        ))
    ]
)]

class OrderSchema
{

}

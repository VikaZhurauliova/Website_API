<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CartItemSchema",
    title: "Товар в корзине",
    required: ["id", "product_id", "quantity"],
    properties: [
        new OA\Property(property: "id", description: "ID записи в корзине", type: "integer", example: 2),
        new OA\Property(property: "quantity", description: "Количество товаров", type: "integer", example: 2),
        new OA\Property(property: "product", description: "Товар", type: "object", allOf: [new OA\Schema(ref: "#/components/schemas/ShopProductSchema")])
    ]
)]

class CartItemSchema
{

}

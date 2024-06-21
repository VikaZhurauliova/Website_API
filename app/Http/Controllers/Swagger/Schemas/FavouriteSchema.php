<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "FavouriteSchema",
    title: "Избранное",
    required: ["product_id"],
    properties: [
        new OA\Property(property: "product", description: "Товар", type: "object",
            allOf: [
                new OA\Schema(ref: "#/components/schemas/ShopProductSchema")
            ]
        )
    ]
)]

class FavouriteSchema
{

}

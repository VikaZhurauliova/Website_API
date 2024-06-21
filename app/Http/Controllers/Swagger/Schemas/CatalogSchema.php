<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CatalogSchema",
    title: "Каталог",
    required: ["href", "id", "name"],
    properties: [
        new OA\Property(property: "href", description: "Ссылка с учетом перекрытия", type: "string", example: "https://market.ru/kresla"),
        new OA\Property(property: "id", description: "Внутренний ID категории", type: "integer", example: 2),
        new OA\Property(property: "name", description: "Название категории", type: "string", example: "кресла"),
        new OA\Property(property: "subcategories", description: "Подкатегории", type: "object", allOf: [
            new OA\Schema(
                required: ["href", "id", "name"],
                properties: [
                    new OA\Property(property: "href", description: "Ссылка с учетом перекрытия", type: "string", example: "https://market.ru/kresla"),
                    new OA\Property(property: "id", description: "Внутренний ID категории", type: "integer", example: 2),
                    new OA\Property(property: "name", description: "Название категории", type: "string", example: "кресла"),
                    new OA\Property(property: "subcategories", description: "Название подкатегории", type: "object", example: [])
                ]
            )
        ])
    ]
)]

class CatalogSchema
{

}

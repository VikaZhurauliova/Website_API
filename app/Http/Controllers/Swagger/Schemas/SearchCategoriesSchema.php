<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "SearchCategoriesSchema",
    title: "Поиск",
    required: ["name", "url"],
    properties: [
        new OA\Property(property: "name", description: "Название категории", type: "string", example: "кресла"),
        new OA\Property(property: "url", description: "url категории", type: "string", example: "market"),
    ]
)]

class SearchCategoriesSchema
{

}




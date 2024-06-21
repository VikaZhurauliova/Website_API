<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "UserSchema",
    title: "Пользователь",
    required: ["id", "email", "role", "phone", "customer_id", "full_name"],
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "email", type: "string", example: "gtest@gmail.com"),
        new OA\Property(property: "role", type: "string", example: "admin"),
        new OA\Property(property: "phone", type: "string", example: "79265656738", nullable: true),
        new OA\Property(property: "customer_id", type: "integer", example: "3546613", nullable: true),
        new OA\Property(property: "full_name", type: "string", example: "Иван Иванович Иванов", nullable: true),
    ]
)]

class UserSchema
{

}

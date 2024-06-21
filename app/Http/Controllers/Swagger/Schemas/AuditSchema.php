<?php

namespace App\Http\Controllers\Swagger\Schemas;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "AuditSchema",
    title: "Аудит",
    required: ["id", "user_name", "event", "old_values", "new_values", "created_at"],
    properties: [
        new OA\Property(property: "id", description: "Внутренний ID записи на сайте", type: "integer", example: 707504),
        new OA\Property(property: "user_name", description: "Фамилия Имя пользователя", type: "text", example: "Иванов Сергей", nullable: true),
        new OA\Property(property: "event", type: "string", example: "updated"),
        new OA\Property(property: "old_values", description: "Старое значение", type: "text", example: "name:красный,code:#ааааааа"),
        new OA\Property(property: "new_values", description: "Новое значение", type: "text", example: "name:u0443,code:#u04430"),
        new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true)
    ]
)]

class AuditSchema
{

}

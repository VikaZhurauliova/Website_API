<?php

namespace App\Http\Controllers\Swagger\Schemas;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ErrorValidationSchema",
    title: "Ошибка валидации данных",
    required: ["message", "errors"],
    properties: [
        new OA\Property(property: "message", description: "Описание первой ошибки", type: "string", example: "Значение поля property имеет ошибочный формат"),
        new OA\Property(
            property: "errors",
            description: "Объект, содержащий имена полей и массивы их ошибок",
            properties: [
                new OA\Property(property: "property", description: "Имя поля и массив его ошибок", type: "array",
                    items: new OA\Items(
                        description: "Описание ошибки",
                        type: "string",
                        example: "Значение поля property имеет ошибочный формат"
                    )
                )
            ],
            type: "object"
        )
    ]
)]

class ErrorValidationSchema
{

}

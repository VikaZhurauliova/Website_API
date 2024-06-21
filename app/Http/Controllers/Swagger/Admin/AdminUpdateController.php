<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / Update",
    description: "Админка / Обновление"
)]

#[OA\Post(
    path: "/api/admin/update",
    summary: "Обновление кода",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Update"],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Ok',
            content: new OA\JsonContent(
                required: ["data"],
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "string",
                        example: "Обновление запущено"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
    ]
)]

class AdminUpdateController extends Controller
{
    //
}

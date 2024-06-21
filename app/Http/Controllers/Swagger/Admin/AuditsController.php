<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / Audit",
    description: "Админка / Аудит"
)]

#[OA\Get(
    path: "/api/admin/audits",
    summary: "Список аудита",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Audit"],
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
                            allOf: [
                                new OA\Schema(ref: "#/components/schemas/AuditSchema")
                            ]
                        )
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
    ]
)]

#[OA\Get(
    path: "/api/admin/audits/{audit}",
    summary: "Выбранный аудит",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Audit"],
    parameters: [
        new OA\Parameter(
            name: "audit",
            description: "ID аудита",
            in: "path",
            required: true,
            example: 2
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
                            new OA\Schema(ref: "#/components/schemas/AuditSchema")
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

class AuditsController extends Controller
{
    //
}

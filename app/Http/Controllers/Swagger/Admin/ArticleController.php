<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;
#[OA\Tag(
    name: "Admin / Article",
    description: "Админка / Статьи"
)]

#[OA\Get(
    path: "/api/admin/articles",
    summary: "Список статей",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Article"],
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
                            new OA\Schema(ref: "#/components/schemas/ArticleSchema")
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
    ]
)]

#[OA\Get(
    path: "/api/admin/articles/{article}",
    summary: "Одна статья",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Article"],
    parameters: [
        new OA\Parameter(
            name: "article",
            description: "ID статьи",
            in: "path",
            required: true,
            example: 3
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "object",
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/ArticleSchema")
                        ]
                    )
                ]
            )
        ),
        new OA\Response(
            ref: "#/components/responses/401",
            response: 401

        ),
        new OA\Response(
            ref: "#/components/responses/404",
            response: 404
        )
    ]
)]

class ArticleController extends Controller
{

}

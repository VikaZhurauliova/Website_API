<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / Seo",
    description: "Админка / SEO"
)]

#[OA\Get(
    path: "/api/admin/seo",
    summary: "Список SEO страниц",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Seo"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        title: "Seo",
                        required: ["data"],
                        properties: [
                            new OA\Property(
                                property: "data",
                                type: "array",
                                items: new OA\Items(
                                    allOf: [
                                        new OA\Schema(ref: "#/components/schemas/SeoSchema")
                                    ]
                                )
                            )
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
    ]
)]

#[OA\Get(
    path: "/api/admin/seo/{seo}",
    summary: "Seo одной страницы",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Seo"],
    parameters: [
        new OA\Parameter(
            name: "seo",
            description: "ID записи",
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
                allOf: [
                    new OA\Schema(ref: "#/components/schemas/SeoSchema")
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

#[OA\Patch(
    path: "/api/admin/seo/{seo}",
    summary: "Обновление seo",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(ref: "#/components/schemas/SeoSchema")
            ]
        )
    ),
    tags: ["Admin / Seo"],
    parameters: [
        new OA\Parameter(
            name: "seo",
            description: "ID записи",
            in: "path",
            required: true,
            example: 1
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(ref: "#/components/schemas/SeoSchema")
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

class SeoController extends Controller
{

}

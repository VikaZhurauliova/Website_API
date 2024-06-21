<?php

namespace App\Http\Controllers\Swagger\Shop\PageData;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Shop / PageData",
    description: "Сайт / Данные для страницы по URL"
)]

#[OA\Get(
    path: "/api/shop/page_data",
    summary: "Данные для страницы по URL",
    security: [["bearerAuth" => []]],
    tags: ["Shop / PageData"],
    parameters: [
        new OA\Parameter(
            name: "url",
            description: "Url для поиска",
            in: "query",
            example: "market.ru/doma"
        ),
        new OA\Parameter(
            name: "lang",
            description: "Язык",
            in: "query",
            required: false,
            example: "kz"
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
                        required: ["page_type", "adminLink", "breadcrumbs", "seo", "content"],
                        properties: [
                            new OA\Property(
                                property: "page_type",
                                description: "Тип страницы",
                                type: "string",
                                enum: [
                                    "mainPage",
                                    "category",
                                    "servicePage",
                                    "sale",
                                    "newsList",
                                    "product",
                                    "redirect",
                                    "catalog"
                                ],
                                nullable: true
                            ),
                            new OA\Property(
                                property: "adminLink",
                                description: "Ссылка в админку",
                                type: "string",
                                example: "https://www.market.ru/",
                                nullable: true
                            ),
                            new OA\Property(
                                property: "breadcrumbs",
                                description: "Хлебные крошки",
                                type: "array",
                                items: new OA\Items(
                                    required: ["name", "link"],
                                    properties: [
                                        new OA\Property(
                                            property: "name",
                                            description: "Название",
                                            type: "string",
                                            example: "Главная"
                                        ),
                                        new OA\Property(
                                            property: "link",
                                            description: "Ссылка",
                                            type: "string",
                                            example: "https://www.market.ru/",
                                            nullable: true
                                        )
                                    ]
                                )
                            ),
                            new OA\Property(
                                property: "seo",
                                required: ["title", "canonical", "meta"],
                                properties: [
                                    new OA\Property(property: "title", type: "string", nullable: true),
                                    new OA\Property(property: "canonical", type: "string", nullable: true),
                                    new OA\Property(
                                        property: "meta",
                                        type: "array",
                                        items: new OA\Items(
                                            oneOf: [
                                                new OA\Schema(
                                                    properties: [
                                                        new OA\Property(property: "property", type: "string", example: "ya:type"),
                                                        new OA\Property(property: "content", type: "string", example: "one_product")
                                                    ],
                                                    type: "object"
                                                ),
                                                new OA\Schema(
                                                    properties: [
                                                        new OA\Property(property: "name", type: "string", example: "description"),
                                                        new OA\Property(property: "content", type: "string", example: "Фитнес")
                                                    ],
                                                    type: "object"
                                                )
                                            ]
                                        )
                                    )
                                ],
                                type: "object"
                            ),
                            new OA\Property(property: "content", description: "Фитнес.", type: "object", nullable: true)
                        ],
                        type: "object"
                    )
                ]
            )
        )
    ]
)]

class PageDataController extends Controller
{

}

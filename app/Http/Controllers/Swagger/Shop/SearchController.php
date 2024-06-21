<?php

namespace App\Http\Controllers\Swagger\Shop;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Shop / Search",
    description: "Сайт / Поиск по сайту"
)]

#[OA\Get(
    path: "/api/shop/search/products",
    summary: "Поиск товаров с опциональной пагинацией",
    security: [["bearerAuth" => []]],
    tags: ["Shop / Search"],
    parameters: [
        new OA\Parameter(
            name: "search",
            description: "Текст в поле ввода",
            in: "query",
            example: "Фитнес"
        ),
        new OA\Parameter(
            name: "domain",
            description: "Домен",
            in: "query",
            example: "market.ru"
        ),
        new OA\Parameter(
            name: "page",
            description: "Номер страницы при пагинации",
            in: "query",
            example: "1"
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
                        type: "array",
                        items: new OA\Items(
                            allOf: [
                                new OA\Schema(ref:"#/components/schemas/SearchProductsSchema")
                            ]
                        )
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

#[OA\Get(
    path: "/api/shop/search/categories",
    summary: "Поиск категорий",
    security: [["bearerAuth" => []]],
    tags: ["Shop / Search"],
    parameters: [
        new OA\Parameter(
            name: "search",
            description: "Текст в поле ввода",
            in: "query",
            example: "Фитнес"
        ),
        new OA\Parameter(
            name: "domain",
            description: "Домен",
            in: "query",
            example: "market.ru"
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
                        type: "array",
                        items: new OA\Items(
                            allOf: [
                                new OA\Schema(ref:"#/components/schemas/SearchCategoriesSchema")
                            ]
                        )
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

#[OA\Get(
    path: "/api/shop/search/tips",
    summary: "Подсказки для поиска",
    security: [["bearerAuth" => []]],
    tags: ["Shop / Search"],
    parameters: [
        new OA\Parameter(
            name: "search",
            description: "Подсказки для поиска",
            in: "query",
            example: "фитнес"
        ),
        new OA\Parameter(
            name: "domain",
            description: "Домен",
            in: "query",
            example: "market.ru"
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
                        required: ["searchTips", "history", "products", "newProducts", "categories"],
                        properties: [
                            new OA\Property(
                                property: "searchTips",
                                description: "Подсказки",
                                type: "array",
                                items: new OA\Items(
                                    type: "string",
                                    example: "фитнес"
                                )
                            ),
                            new OA\Property(
                                property: "history",
                                description: "История",
                                type: "array",
                                items: new OA\Items(
                                    type:"string",
                                    example: "фитнес"
                                )
                            ),
                            new OA\Property(
                                property: "products",
                                description: "Товары",
                                type: "array",
                                items: new OA\Items(
                                    allOf: [

                                        new OA\Schema(ref:"#/components/schemas/SearchProductsSchema")
                                    ]
                                )
                            ),
                            new OA\Property(
                                property: "newProducts",
                                description: "Новинки",
                                type: "array",
                                items: new OA\Items(
                                    allOf: [
                                        new OA\Schema(ref:"#/components/schemas/SearchProductsSchema")
                                    ]
                                )
                            ),
                            new OA\Property(
                                property: "categories",
                                description: "Категории",
                                type: "array",
                                items: new OA\Items(
                                    allOf: [
                                        new OA\Schema(ref:"#/components/schemas/SearchCategoriesSchema")
                                    ]
                                )
                            )
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

class SearchController extends Controller
{
    //
}

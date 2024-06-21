<?php

namespace App\Http\Controllers\Swagger\Shop;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Shop / Product",
    description: "Сайт / Товар"
)]

#[OA\Get(
    path: "/api/shop/product/actual/{products}",
    summary: "Актуальные данные (цены) одного или нескольких товаров",
    security: [["bearerAuth" => []]],
    tags: ["Shop / Product"],
    parameters: [
        new OA\Parameter(
            name: "products",
            description: "ID товара или массив ID товаров",
            in: "path",
            required: true,
            example: 43
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
                        oneOf: [
                            new OA\Schema(
                                type: "array",
                                items: new OA\Items(
                                    required: ["id", "price", "pricePromotion", "pricePreorder", "storageStatus"],
                                    properties: [
                                        new OA\Property(property: "id", description: "ID товара", type: "integer", example: 43),
                                        new OA\Property(property: "price", description: "Цена", type: "integer", example: 95, nullable: true),
                                        new OA\Property(property: "pricePromotion", description: "Цена по акции", type: "integer", example: 95, nullable: true),
                                        new OA\Property(property: "pricePreorder", description: "Цена предзаказа", type: "integer", example: 95, nullable: true),
                                        new OA\Property(property: "storageStatus", description: "Статус наличия товара", type: "object", allOf: [
                                            new OA\Schema(
                                                required: ["code", "text"],
                                                properties: [
                                                    new OA\Property(property: "code", description: "Код статуса", type: "string", enum: ["discontinued", "pre-order", "avail", "check-avail", "not-avail"]),
                                                    new OA\Property(property: "text", description: "Название статуса", type: "string", enum: ["Снят с производства", "Предзаказ", "В наличии", "Уточнить наличие", "Нет в наличии"]),
                                                ]
                                            )
                                        ]),
                                    ]
                                )
                            ),
                            new OA\Schema(
                                required: ["id", "price", "pricePromotion", "pricePreorder", "storageStatus"],
                                properties: [
                                    new OA\Property(property: "id", description: "ID товара", type: "integer", example: 43),
                                    new OA\Property(property: "price", description: "Цена", type: "integer", example: 95, nullable: true),
                                    new OA\Property(property: "pricePromotion", description: "Цена по акции", type: "integer", example: 95, nullable: true),
                                    new OA\Property(property: "pricePreorder", description: "Цена предзаказа", type: "integer", example: 95, nullable: true),
                                    new OA\Property(property: "storageStatus", description: "Статус наличия товара", type: "object", allOf: [
                                        new OA\Schema(
                                            required: ["code", "text"],
                                            properties: [
                                                new OA\Property(property: "code", description: "Код статуса", type: "string", enum: ["discontinued", "pre-order", "avail", "check-avail", "not-avail"]),
                                                new OA\Property(property: "text", description: "Название статуса", type: "string", enum: ["Снят с производства", "Предзаказ", "В наличии", "Уточнить наличие", "Нет в наличии"]),
                                            ]
                                        )
                                    ]),
                                ],
                                type: "object"
                                )
                        ],
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
    ]
)]

class ProductController extends Controller
{

}

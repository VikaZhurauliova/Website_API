<?php

namespace App\Http\Controllers\Swagger\Schemas;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ShopProductSchema",
    title: "Карточка товара в каталоге сайта",
    required: ["data"],
    properties: [
        new OA\Property(
            property: "data",
            required: ["id", "name", "price", "pricePromotion", "url", "categories", "shortName", "statusId", "storageStatus"],
            properties: [
                new OA\Property(property: "id", type: "integer", example: 331),
                new OA\Property(property: "price", description: "Цена", type: "integer", example: 1900, nullable: true),
                new OA\Property(property: "pricePromotion", description: "Цена по акции", type: "integer", example: 1900, nullable: true),
                new OA\Property(property: "name", description: "Название товара", type: "string", example: "Фитнес", nullable: true),
                new OA\Property(property: "url", description: "Адрес страницы", type: "string", example: "tovari-dlya-zdorovya", nullable: true),
                new OA\Property(property: "shortName", description: "Короткое название", type: "string"),
                new OA\Property(property: "statusId", description: "ID статуса товара", type: "int", example: 2),
                new OA\Property(property: "storageStatus", description: "Статус наличия товара", type: "object", allOf: [
                    new OA\Schema(
                        required: ["code", "text"],
                        properties: [
                            new OA\Property(property: "text", description: "Название статуса", type: "string", enum: ["Снят с производства", "Предзаказ", "В наличии", "Уточнить наличие", "Нет в наличии"]),
                        ]
                    )
                ]),
                new OA\Property(
                    property: "gallery",
                    description: "Галерея фото и видео товаров",
                    type: "array",
                    items: new OA\Items(
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/ProductGallerySchema"),
                        ]
                    )
                ),
            ],
            type: "object"
        )
    ]
)]

class ShopProductSchema
{

}

<?php
namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / ProductStatus",
    description: "Админка / Статусы товаров"
)]

#[OA\Get(
    path: "/api/admin/product_statuses",
    summary: "Список статусов товаров",
    security: [["bearerAuth" => []]],
    tags: ["Admin / ProductStatus"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 4),
                            new OA\Property(property: "name", description: "Название статуса", type: "string", example: "Опубликован", nullable: true),
                            new OA\Property(property: "description", description: "Описание статуса", type: "string", example: "Виден в поиске сайта, в каталогах и доступен для поисковиков", nullable: true),
                            new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                            new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                        ],
                        type: "object"
                    )
                ]
            )
        )
    ]
)]

#[OA\Get(
    path: "/api/admin/product_statuses/{product_status}",
    summary: "Один статус товара",
    security: [["bearerAuth" => []]],
    tags: ["Admin / ProductStatus"],
    parameters: [
        new OA\Parameter(
            name: "product_status",
            description: "ID статуса товара",
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
                properties: [
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", description: "Название статуса", type: "string", example: "Опубликован", nullable: true),
                            new OA\Property(property: "description", description: "Описание статуса", type: "string", example: "Виден в поиске сайта, в каталогах и доступен для поисковиков", nullable: true),
                            new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                            new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404),
    ]
)]

class ProductStatusController extends Controller
{

}

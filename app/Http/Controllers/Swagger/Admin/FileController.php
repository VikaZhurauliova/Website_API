<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Admin / File",
    description: "Админка / Файлы"
)]

#[OA\Get(
    path: "/api/admin/files",
    summary: "Список файлов",
    security: [["bearerAuth" => []]],
    tags: ["Admin / File"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "array",
                        items: new OA\Items(
                            allOf: [
                                new OA\Schema(ref: "#/components/schemas/FileSchema")
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
    path: "/api/admin/files/{file}",
    summary: "Один файл",
    security: [["bearerAuth" => []]],
    tags: ["Admin / File"],
    parameters: [
        new OA\Parameter(
            name: "file",
            description: "ID файла",
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
                            new OA\Schema(ref: "#/components/schemas/FileSchema")
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404),
    ]
)]

#[OA\Post(
    path: "/api/admin/files",
    summary: "Загрузка файла",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: [
            new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    required: ["file", "folder"],
                    properties: [
                        new OA\Property(
                            property: "file",
                            description: "Загружаемый файл",
                            type: "file"
                        ),
                        new OA\Property(
                            property: "folder",
                            description: "Имя папки",
                            type: "string",
                            example: " colors"
                        )
                    ]
                )
            )
        ]
    ),
    tags: ["Admin / File"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Файл загружен",
            content: new OA\JsonContent(
                required: ["data"],
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "object",
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/FileSchema")
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/422", response: 422)
    ]
)]

#[OA\Post(
    path: "/api/admin/files/ckeditor",
    summary: "Загрузка изображения из CKEditor",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: [
            new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    required: ["upload"],
                    properties: [
                        new OA\Property(
                            property: "upload",
                            description: "Загружаемый файл",
                            type: "file"
                        )
                    ]
                )
            )
        ]
    ),
    tags: ["Admin / File"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Файл загружен",
            content: new OA\JsonContent(
                required: ["url"],
                properties: [
                    new OA\Property(
                        property: "url",
                        description: "Ссылка на загруженный файл",
                        type: "string",
                        example: "https://api.market.ru/ckeditor/a56259cf-71d7-4f3c-992a-7217c3d116d6_desktop.jpg"
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/422", response: 422)
    ]
)]

#[OA\Delete(
    path: "/api/admin/files/{file}",
    summary: "Удаление файла",
    security: [["bearerAuth" => []]],
    tags: ["Admin / File"],
    parameters: [
    new OA\Parameter(
        name: "file",
        description: "ID файла",
        in: "path",
        required: true,
        example: 26
    )],
    responses: [
    new OA\Response(
        response: 200,
        description: "Ok",
        content: new OA\JsonContent(
            required: ["data", "revalidatePath"],
            properties: [
                new OA\Property(
                    property: "data",
                    type: "object",
                    allOf: [new OA\Schema(ref: "#/components/schemas/FileSchema")]
                ),
                new OA\Property(
                    property: "revalidatePath",
                    type: "string"
                )
            ]
        )
    ),
    new OA\Response(ref: "#/components/responses/401", response: 401),
    new OA\Response(ref: "#/components/responses/404", response: 404)
]
)]

class FileController extends Controller
{

}

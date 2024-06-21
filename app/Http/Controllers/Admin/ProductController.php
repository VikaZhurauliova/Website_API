<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Borboza\BorbozaBaseController;
use App\Http\Controllers\Borboza\StorageController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductCreateRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Http\Resources\Admin\Product\ProductListSchemaResource;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Models\Product;
use App\Services\Admin\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * Список товаров
     */
    public function listSchema(): AnonymousResourceCollection
    {
        $products = Product::with([
            'brand',
            'status',
            'categoryBreadcrumbs.parent.subcategories',
            'categoryBreadcrumbs.subcategories'
        ])->get();
        return ProductListSchemaResource::collection($products);
    }

    /**
     * Один товар
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource(ProductService::getProductFullData($product));
    }

    /**
     * Создание нового товара
     */
    public function store(ProductCreateRequest $request): ProductResource
    {
        $data = $request->validated();
        return ProductResource::make(ProductService::store($data));
    }

    /**
     * Обновление товара
     */
    public function update(ProductUpdateRequest $request, Product $product): ProductResource
    {
        $data = $request->validated();
        $product = ProductService::update($product, $data);

        return ProductResource::make($product)
            ->additional(
                [
                    'revalidatePath' => $product->revalidate_path,
                ]
            );
    }

    /**
     * Удаление товара
     */
    public function destroy(Product $product): ProductResource
    {
        $product->seo?->update(['status' => null]);
        $product->delete();
        return ProductResource::make($product)
            ->additional(['revalidatePath' => $product->revalidate_path]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryCreateRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Http\Resources\Admin\Category\CategoryListAllSchemaResource;
use App\Http\Resources\Admin\Category\CategoryListWithSubCategoriesSchemaResource;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Http\Resources\Admin\Category\CategoryTypeListResource;
use App\Models\Category;
use App\Models\CategoryType;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * Список всех категорий товаров
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Создание категории
     */
    public function store(CategoryCreateRequest $request)
    {
        $data = $request->validated();
        return CategoryResource::make(CategoryService::store($data));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): CategoryResource
    {
        return new CategoryResource(Category::findOrFail($id));
    }

    /**
     * Обновление категории
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        return CategoryResource::make(CategoryService::update($category, $data))
            ->additional(['revalidatePath' => $category->revalidate_path]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return response()->json(['message' => 'Невозможно удалить категорию, так как она связана с товарами'], 422);
        }

        $category->seo()->delete();
        $category->delete();
        return response()->noContent();
    }

    /**
     * Список категорий товаров с вложенностью
     */
    public function listWithSubCategoriesSchema(): array
    {
        return [
            'data' => CategoryService::getDataForCategoriesListSchema()
                ->map(function ($item) {
                    return new CategoryListWithSubCategoriesSchemaResource($item);
                })
        ];
    }
}

<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Domain;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryService
{

    /**
     * Обновляет категорию
     * @param Category $category
     * @param array $data данные из формы карточки категории
     * @return Category
     */
    public static function update(Category $category, array $data): Category
    {
        DB::transaction(function () use ($category, $data) {
            $category->seo->updateOrCreate(
                ['id' => $data['seo']['id'] ?? null],
                $data['seo']
            );
            unset($data['seo']);

            $category->update($data);
        });
        return $category->fresh();
    }

    /**
     * Создаёт категорию
     * @param array $data данные из формы карточки категории
     * @return Category
     */
    public static function store(array $data): Category
    {
        $category = Category::create();
        $category->seo()->create();
        $data['seo']['id'] = $category->seo->id;
        return self::update($category, $data);
    }

    /**
     * Список категорий для основной таблицы категорий в админке и таблицы перекрытий
     * @return Collection Данные из выборки
     */
    public static function getDataForCategoriesListSchema(): Collection
    {
        return Category::where('parent_id', null)
                ->with('type')
                ->with(['products' => function ($query) {
                    $query->without('seo');
                }])
                ->with(['subcategories' => function ($query) {
                    $query->with('type')
                        ->with(['products' => function ($query) {
                            $query->without('seo');
                        }]);
                }])
                ->has('subcategories')
                ->orderBy('name')
                ->get()
                ->merge(
                    Category::where('parent_id', null)
                        ->with(['products' => function ($query) {
                            $query->without('seo');
                        }])
                        ->with('subcategories', 'type')
                        ->doesntHave('subcategories')
                        ->orderBy('name')
                        ->get()
                );
    }

}

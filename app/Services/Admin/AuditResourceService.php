<?php
namespace App\Services\Admin;

use App\Models\Category;
use App\Models\ProductRent;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class AuditResourceService
{
    /**
     * Перевод ключей
     *
     * @param array $values
     * @param array $translations
     * @return string
     */
    public static function translateValues(array $values, array $translations): string
    {
        $translatedValues = [];
        foreach ($values as $key => $value) {
            $translatedKey = $translations[$key] ?? $key;
            $translatedValues[] = "$translatedKey: $value";
        }
        return implode(', ', $translatedValues);
    }

    /**
     * Получает название по связи
     *
     * @param array $values
     * @param array $translations
     * @return string
     */
    public static function processValue(array $values, array &$translations): string
    {
        if (isset($values['rent_id'])) {
            $rentType = ProductRent::find($values['rent_id'])->rentType->name;
            $values['rent_id'] = $rentType;
        }
        if (isset($values['category_breadcrumbs_id'])) {
            $category = Category::find($values['category_breadcrumbs_id']);
            $categoryName = $category ? $category->name : null;
            $values['category_breadcrumbs_id'] = $categoryName;
        }
        return self::translateValues($values, $translations);
    }
}

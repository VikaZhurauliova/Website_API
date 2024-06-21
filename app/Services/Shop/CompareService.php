<?php
namespace App\Services\Shop;

use App\Models\Compare;
use Illuminate\Database\Eloquent\Collection;

class CompareService
{
    /**
     * Добавление товара в сравнение
     * @param array $data
     * @return Compare
     */
    public static function store(array $data): Compare
    {
        return Compare::addMy($data);
    }

    /**
     * Список товаров в сравнении
     * @param int $domainId
     * @return Collection
     */
    public static function items(int $domainId): Collection
    {
        return Compare::with('product.status')->my($domainId)->get();
    }

    /**
     * Удаление товара из сравнения
     *
     * @param Compare $compare
     * @return bool
     */
    public static function destroy(Compare $compare): bool
    {
        return $compare->deleteMy();
    }
}

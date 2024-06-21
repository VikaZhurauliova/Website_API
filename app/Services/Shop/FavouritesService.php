<?php
namespace App\Services\Shop;

use App\Models\Favourite;
use Illuminate\Database\Eloquent\Collection;

class FavouritesService
{
    /**
     * Добавление товара в избранное
     * @param array $data
     * @return Favourite
     */
    public static function store(array $data): Favourite
    {
        return Favourite::addMy($data);
    }

    /**
     * Список товаров в избранном
     * @param int $domainId
     * @return Collection
     */
    public static function items(int $domainId): Collection
    {
        return Favourite::with('product.status')->my($domainId)->get();
    }

    /**
     * Удаление товара из избранного
     * @param Favourite $favourite
     * @return bool
     */
    public static function destroy(Favourite $favourite): bool
    {
        return $favourite->deleteMy();
    }
}

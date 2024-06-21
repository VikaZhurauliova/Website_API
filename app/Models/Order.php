<?php

namespace App\Models;

use App\Models\Traits\MyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Заказы
class Order extends Model
{
    use MyTrait;

    protected $table = 'orders';
    protected $guarded = false;

    /**
     * Состав заказа
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderedItem::class, 'order_id');
    }

    /**
     * Пользователь
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'ordered_items', 'order_id', 'product_id')
            ->withPivot('quantity', 'price');
    }
}

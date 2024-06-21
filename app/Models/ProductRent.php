<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

// Аренда товаров
class ProductRent extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'product_rent';
    protected $guarded = false;
    public $timestamps = false;

    /**
     * Тип аренды
     * @return BelongsTo
     */
    public function rentType(): BelongsTo
    {
        return $this->belongsTo(RentType::class, 'rent_id');
    }

    /**
     * Товар
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

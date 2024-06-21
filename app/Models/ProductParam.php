<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;

// Технические характеристики товаров
class ProductParam extends Model implements Auditable
{
    protected $table = 'product_params';
    protected $guarded = false;
    public $timestamps = false;
    use \OwenIt\Auditing\Auditable;

    /**
     * Фильтры
     * @return BelongsToMany
     */
    public function filters(): BelongsToMany
    {
        return $this->belongsToMany(Filter::class, 'product_param_filters');
    }

    public function param(): BelongsTo
    {
        return $this->belongsTo(Param::class);
    }
}

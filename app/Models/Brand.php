<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Бренды
class Brand extends Model
{
    protected $table = 'brands';
    protected $guarded = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

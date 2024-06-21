<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Размеры
class Size extends Model
{
    protected $table = 'sizes';
    protected $guarded = false;
    public $timestamps = false;
}

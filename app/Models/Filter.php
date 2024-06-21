<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Значения фильтров параметров товаров
class Filter extends Model
{
    protected $table = 'filters';
    protected $guarded = false;
    protected $fillable = ['name'];
    public $timestamps = false;
}

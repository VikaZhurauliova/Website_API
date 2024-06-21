<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Параметры товаров
class Param extends Model
{
    public $timestamps = false;
    protected $table = 'params';
    protected $guarded = false;
    protected $fillable = ['name'];

}

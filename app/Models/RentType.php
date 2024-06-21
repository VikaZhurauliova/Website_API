<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Типы аренды
class RentType extends Model
{
    protected $table = 'rent_types';
    protected $guarded = false;
    public $timestamps = false;
}

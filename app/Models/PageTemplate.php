<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Шаблоны страниц
class PageTemplate extends Model
{
    protected $table = 'page_templates';
    protected $guarded = false;
    public $timestamps = false;
}

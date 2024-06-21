<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Мета-теги для страниц
class SeoMeta extends Model
{
    protected $table = 'seo_meta';
    protected $guarded = false;
}

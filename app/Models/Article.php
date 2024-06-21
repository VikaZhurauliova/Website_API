<?php

namespace App\Models;

use App\Models\Traits\SeobleTrait;
use Illuminate\Database\Eloquent\Model;

// Статьи
class Article extends Model
{
    use SeobleTrait;
    protected $table = 'articles';
    protected $guarded = false;
    protected $with = ['seo'];
}

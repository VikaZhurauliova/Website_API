<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;
class Color extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'colors';
    protected $guarded = false;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'code',
        'image',
        'is_code',
    ];
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_colors',
            'color_id',
            'product_id'
        );
    }
}

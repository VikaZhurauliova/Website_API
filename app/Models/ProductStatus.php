<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

// Статусы товара
class ProductStatus extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'product_statuses';
    protected $guarded = false;
}

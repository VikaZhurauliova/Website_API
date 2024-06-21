<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Audit extends Model
{
    protected $table = 'audits';
    protected $guarded = false;

    /**
     * Получить все изменившие модели.
     */
    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }
}

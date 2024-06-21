<?php

namespace App\Models;

use App\Models\Traits\RevalidateTrait;
use App\Models\Traits\SeobleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Страницы
class Page extends Model
{
    use SeobleTrait;
    protected $table = 'pages';
    protected $guarded = false;
    protected $with = ['seo'];
    use RevalidateTrait {
        getRevalidatePathAttribute as initialGetRevalidatePathAttribute;
    }

    /**
     * Пути для ревалидации: где используется объект
     * @return string[]
     */
    public function getRevalidatePathAttribute(): array
    {
        return $this->initialGetRevalidatePathAttribute();
    }

    /**
     * Шаблон страницы
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(PageTemplate::class, 'template_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Contracts\Auditable;

// SEO: urlы всех страниц
class Seo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'seo';
    protected $guarded = false;
    public $timestamps = false;
    protected $with = ['seoRegion'];

    /**
     * Мета-теги
     * @return HasMany
     */
    public function seoMeta(): HasMany
    {
        return $this->hasMany(SeoMeta::class, 'seo_id');
    }

    /**
     * Модель, которой соответствует эта seo-строка
     */
    public function seoble(): MorphTo
    {
        return $this->morphTo();
    }


}

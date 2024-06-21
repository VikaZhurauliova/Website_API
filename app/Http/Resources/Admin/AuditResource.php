<?php

namespace App\Http\Resources\Admin;

use App\Models\Category;
use App\Models\ProductRent;
use App\Services\Admin\AuditResourceService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class AuditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = auth()->user();
        $date = Carbon::parse($this->created_at)->isoFormat('Do MMMM', 'Do MMMM');
        $date = str_replace('-го', '', $date);

        $eventTranslate = [
            'updated' => 'Обновление',
            'created' => 'Создание',
            'deleted' => 'Удаление',
        ];
        $event = $eventTranslate[$this->event] ?? $this->event;
        // Загрузка содержимого файла translations.json
        $translations = json_decode(File::get(storage_path('app/translations.json')), true);

        $data = [
            'id' => $this->id,
            'user_name' => $user->first_name . ' ' . $user->last_name,
            'date' => $date,
            'user_id' => $this->user_id,
            'auditable_id' => $this->auditable_id,
            'event' => $event,
            'auditable_type' => $this->getAuditableTypeDescription(),
        ];

        // В зависимости от значения event, добавляем соответствующие данные
        if ($this->event === 'updated') {
            $data['old_values'] = AuditResourceService::processValue(json_decode($this->old_values, true), $translations);
            $data['new_values'] = AuditResourceService::processValue(json_decode($this->new_values, true), $translations);
        } elseif ($this->event === 'created') {
            $data['new_values'] = AuditResourceService::processValue(json_decode($this->new_values, true), $translations);
        } elseif ($this->event === 'deleted') {
            $data['old_values'] = AuditResourceService::processValue(json_decode($this->old_values, true), $translations);
        }

        return $data;
    }

    /**
     * @return string
     */
    protected function getAuditableTypeDescription(): string
    {
        $modelDescriptions = [
            'App\\Models\\Product' => 'Товар',
            'App\\Models\\ProductRent' => 'Аренда',
            'App\\Models\\ProductSize' => 'Размер',
            'App\\Models\\Category' => 'Категория',
            'App\\Models\\ProductBadge' => 'Бейджи товара',
            'App\\Models\\ProductGallery' => 'Галерея',
            'App\\Models\\ProductParam' => 'Технические характеристики товаров',
            'App\\Models\\Color' => 'Цвет',
            'App\\Models\\Seo' => 'Сео',
        ];

        return $modelDescriptions[$this->auditable_type] ?? $this->auditable_type;
    }
}

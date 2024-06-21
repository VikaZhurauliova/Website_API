<?php

namespace App\Models\Traits;

use App\Services\AuthService;
use Illuminate\Database\Eloquent\Builder;

trait MyTrait
{
    /**
     * Выбор сущностей для текущего пользователя
     * @param Builder $query ID домена в таблице domains
     * @param int $domainId
     * @return void
     */
    public function scopeMy(Builder $query, int $domainId): void
    {
        $guestId = AuthService::getGuestToken();
        if (!empty(auth()->user()?->id)) {
            $query->where('user_id', auth()->user()->id);
        } elseif (!empty($guestId)) {
            $query->where('guest_id', $guestId);
        } else {
            $query->where('id', null);
        }
        $query->where('domain_id', $domainId);
    }

    /**
     * Добавление сущности текущего пользователя
     * @param array $data
     * @return static
     */
    public static function addMy(array $data): static
    {
        $existingItem = static::where(function($query) use ($data) {
            AuthService::addUserOrGuestSearchCondition($query);
        })
            ->where('product_id', $data['product_id'])
            ->where('domain_id', $data['domain_id'])
            ->first();

        if ($existingItem) {
            return $existingItem;
        } else {
            return static::create($data);
        }
    }

    /**
     * Удаление сущности текущего пользователя
     * @return bool
     */
    public function deleteMy(): bool
    {
        $guestId = AuthService::getGuestToken();
        if (
            (!empty(auth()->user()?->id) && $this->user_id === auth()->user()->id) ||
            (!empty($guestId) && $this->guest_id === $guestId)
        ) {
            $this->delete();
            return true;
        }
        return false;
    }

}

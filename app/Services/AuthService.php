<?php
namespace App\Services;

class AuthService
{
    public static function getUserToken(): string|null
    {
        return request()->bearerToken();
    }

    public static function getGuestToken(): string|null
    {
        $token = self::getUserToken();
        return str_starts_with($token, 'anon_') ? $token : null;
    }

    /**
     * Добавляет к поиску выбор по user_id или guest_id
     * @param $query
     * @return void
     */
    public static function addUserOrGuestSearchCondition(&$query): void
    {
        $guestId = self::getGuestToken();
        if (!empty(auth()->user()?->id)) {
            $query->where('user_id', auth()->user()->id);
        } elseif (!empty($guestId)) {
            $query->where('guest_id', $guestId);
        } else {
            $query->where('id', null);
        }
    }

}

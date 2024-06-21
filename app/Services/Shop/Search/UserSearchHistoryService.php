<?php
namespace App\Services\Shop\Search;

use App\Models\UserSearchHistory;
use App\Services\AuthService;
use Illuminate\Support\Collection;

class UserSearchHistoryService
{
    /**
     * Сохранение в историю поиска
     * @param array $data
     * @return void
     */
    public static function store(array $data): void
    {
        $userId = auth()->user()?->id ?? null;
        $guestId = AuthService::getGuestToken();
        $searchTerm = $data['search'];
        if ($userId !== null || $guestId !== null) {
            UserSearchHistory::create([
                'text' => $searchTerm,
                'user_id' => $userId,
                'guest_id' => $guestId,
                'domain_id' => $data['domain_id'],
            ]);
        }
    }


    /**
     * Получение уникальных строк истории поиска пользователя
     * @param int $domainId
     * @return Collection
     */
    public static function getUserSearchHistory(int $domainId): Collection
    {
        return UserSearchHistory::my($domainId)
            ->orderByDesc('id')
            ->limit(4)
            ->get()
            ->unique('text')
            ->pluck('text');
    }

}

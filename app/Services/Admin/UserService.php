<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserService
{
    /**
     * Возвращает список пользователей с пагинацией
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function getUsers(Request $request): LengthAwarePaginator
    {
        $query = User::where('role', '!=', 'app');

        if ($request->has('phone')) {
            $query->where('phone', 'LIKE', '%' . $request->input('phone') . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        if ($request->has('full_name')) {
            $fullName = $request->input('full_name');
            $query->where(function ($q) use ($fullName) {
                return $q->whereRaw("CONCAT(first_name,' ', last_name) LIKE ?", ["%$fullName%"])
                    ->orWhereRaw("CONCAT(last_name,' ', first_name) LIKE ?", ["%$fullName%"]);
            });
        }

        $perPage = $request->input('per_page', 15);
        return $query->paginate($perPage);
    }

}

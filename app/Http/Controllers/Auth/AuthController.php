<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Borboza\BorbozaBaseController;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Favourite;
use App\Models\UserSearchHistory;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $customClaims = [
            'role' => auth()->user()->role,
        ];

        // Токен на 50 лет для фронта (для серверной генерации страниц)
        if (auth()->user()->role === 'app') {
            $customClaims = array_merge($customClaims, [
                'sub' => auth()->user()->id,
                'exp' => 3155749200,
                'iss' => 'app',
                'iat' => 1577826000,
                'nbf' => 1577826000,
                'jti' => auth()->user()->id,
            ]);
        }

        $payload = JWTFactory::customClaims($customClaims)->make();
        if (! $token = JWTAuth::encode($payload, '', 'HS256')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Привязываем корзину, избранное и историю поисков гостя к пользователю
        $this->setUserToGuestData();

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]
        ]);
    }

    /**
     * Создаёт уникальный идентификатор гостя и возвращает его
     * @return JsonResponse
     */
    public function guestId(): JsonResponse
    {
        // Генерируем уникальный идентификатор пользователя
        $guestId = uniqid('anon_', true);
        return $this->respondWithToken($guestId);
    }

    /**
     * Привязываем корзину, избранное и историю поисков гостя к пользователю
     * @return void
     */
    protected function setUserToGuestData(): void
    {
        $guestId = AuthService::getGuestToken();
        if (!empty(auth()->user()->id) && !empty($guestId)) {
            Cart::where('guest_id', $guestId)->where('user_id', null)->update(['guest_id' => $guestId]);
            Favourite::where('guest_id', $guestId)->where('user_id', null)->update(['guest_id' => $guestId]);
            UserSearchHistory::where('guest_id', $guestId)->where('user_id', null)->update(['guest_id' => $guestId]);
        }
    }
}

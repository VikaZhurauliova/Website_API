<?php

namespace App\Http\Controllers\Shop;
use App\Http\Requests\Common\DomainRequest;
use App\Http\Requests\Shop\FavouritesRequest;
use App\Http\Resources\Shop\FavouritesResource;
use App\Models\Domain;
use App\Services\Shop\FavouritesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Favourite;
use Illuminate\Http\Response;

class FavouritesController extends Controller
{
    /**
     * Получение списка избранного для определенного пользователя
     * @param DomainRequest $request
     * @return array
     */
    public function index(DomainRequest $request): array
    {
        $domainId = $request->validated()['domain_id'];
        $domain = Domain::findOrFail($domainId);
        return [
            'data' => FavouritesService::items($domainId)->map(function ($item) use ($domain) {
                return new FavouritesResource($item, $domain);
            })->toArray()
        ];
    }

    /**
     * Добавление товара в избранное
     *
     * @param FavouritesRequest $request
     * @return Response
     */
    public function store(FavouritesRequest $request): Response
    {
        $data = $request->validated();
        $result = FavouritesService::store($data);
        if (isset($result['message'])) {
            return response(['message' => $result['message']], 400);
        }
        return response(['data' => ['id' => $result->id]]);
    }

    /**
     * Удаление товара из избранного
     *
     * @param Favourite $favourite
     * @return Response
     */
    public function destroy(Favourite $favourite)
    {
        return FavouritesService::destroy($favourite) ? response()->noContent() : response(
            [
                'error' => 'Не удалось удалить товар из избранного'
            ],
            500);
    }
}

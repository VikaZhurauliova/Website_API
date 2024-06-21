<?php

namespace App\Http\Controllers\Shop\PageData;

use App\Http\Requests\Shop\PageData\PageDataRequest;
use App\Http\Controllers\Controller;
use App\Services\Shop\PageData\PageDataService;

class PageDataController extends Controller
{
    public function __invoke(PageDataRequest $request): array
    {
        $data = $request->validated();
        return PageDataService::getPageData($data['url'], $data['lang']);
    }

}

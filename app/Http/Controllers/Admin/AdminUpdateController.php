<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateBackJob;
use App\Jobs\UpdateFrontJob;
use Illuminate\Http\JsonResponse;

class AdminUpdateController extends Controller
{
    public function index(): JsonResponse
    {
        UpdateFrontJob::dispatch()->onConnection('git')->onQueue('git');
        UpdateBackJob::dispatch()->onConnection('git')->onQueue('git');
        return response()->json(['data' => 'Обновление запущено']);
    }

}

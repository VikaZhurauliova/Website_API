<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class TestApiController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->headers;
    }

}

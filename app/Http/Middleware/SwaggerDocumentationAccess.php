<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SwaggerDocumentationAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth('web')->user()?->role !== 'admin') {
            auth('web')->logout();
            return redirect()->route('swagger_auth_form');
        }
        return $next($request);
    }
}

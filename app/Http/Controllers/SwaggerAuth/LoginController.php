<?php

namespace App\Http\Controllers\SwaggerAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    protected string $redirectTo = RouteServiceProvider::HOME;

    public function showSwaggerLoginForm(): View
    {
        return view('swagger_auth_form');
    }

    public function login(): RedirectResponse
    {
        $credentials = request(['email', 'password']);
        if (auth('web')->attempt($credentials)) {
            return redirect('api/documentation');
        } else {
            return redirect()->route('swagger_auth_form')
                ->withInput();
        }
    }

    public function logout(): RedirectResponse
    {
        auth('web')->logout();
        return redirect()->route('swagger_auth_form');
    }

}

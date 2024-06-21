<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::get('/test', \App\Http\Controllers\TestController::class);

Route::get('/swagger_auth_form', [\App\Http\Controllers\SwaggerAuth\LoginController::class, 'showSwaggerLoginForm'])->name('swagger_auth_form');
Route::post('/swagger_auth_login', [\App\Http\Controllers\SwaggerAuth\LoginController::class, 'login'])->name('swagger_auth_login');
Route::get('/swagger_auth_logout', [\App\Http\Controllers\SwaggerAuth\LoginController::class, 'logout'])->name('swagger_auth_logout');

<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'showAll']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'register'])
    ->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::put('/users/{id}', [UserController::class, 'update'])
    ->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::delete('/users/{id}', [UserController::class, 'delete'])
    ->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);




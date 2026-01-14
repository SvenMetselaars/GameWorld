<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GamesController;

Route::get('/', [GamesController::class, 'GetCategories'])->name('home');

Route::get('/platform', [GamesController::class, 'getPlatforms'])->name('platforms');

Route::get('/info', [GamesController::class, 'getInfo'])->name('info');

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlatformController;

Route::get('/', [CategoryController::class, 'GetCategories'])->name('home');

Route::get('/platform', [PlatformController::class, 'GetPlatforms'])->name('platforms');

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

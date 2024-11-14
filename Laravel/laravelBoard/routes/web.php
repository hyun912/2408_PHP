<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('goLogin');
});

// 로그인
Route::get('/login', [UserController::class, 'goLogin'])->name('goLogin');
Route::post('/login', [UserController::class, 'login'])->name('login');

// 로그아웃
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// 게시판
Route::resource('/boards', BoardController::class)->except('edit', 'update');
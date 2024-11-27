<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// 인증이 필요한 그룹
Route::middleware('my.auth')->group(function() {
  // 로그아웃 인증
  Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

  // 게시판 관련
  Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');
  Route::get('/boards/{id}', [BoardController::class, 'show'])->name('boards.show');
  Route::post('/boards', [BoardController::class, 'store'])->name('boards.store');
});
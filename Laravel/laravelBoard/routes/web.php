<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('goLogin');
});



// Route::middleware(['guest'])->group(function () {
  // 로그인
  Route::get('/login', [UserController::class, 'goLogin'])->name('goLogin');
  Route::post('/login', [UserController::class, 'login'])->name('login');
  
  // 로그아웃
  Route::get('/logout', [UserController::class, 'logout'])->name('logout');

  // 회원가입
  // Route::get('/register', [UserController::class, 'goRegister'])->name('get.register');
  // Route::post('/register', [UserController::class, 'register'])->name('register');
  Route::match(['get', 'post'], '/register', [UserController::class, 'register'])->name('register');
// });

Route::middleware(['auth'])->group(function () {
  // 게시판
  Route::resource('/boards', BoardController::class)->except(['edit', 'update']); 
});
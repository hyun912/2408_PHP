<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('goLogin');
});

Route::get('/login', [UserController::class, 'goLogin'])->name('goLogin');
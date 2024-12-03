<?php

use App\Http\Controllers\BoardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');

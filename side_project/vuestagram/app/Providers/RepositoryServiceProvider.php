<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\BoardRepositoryInterface;
use App\Repositories\BoardRepository;
use App\Services\BoardService;
use App\Services\Interfaces\BoardServiceInterface;

class RepositoryServiceProvider extends ServiceProvider {
  public function register() {
    $this->app->bind(BoardRepositoryInterface::class, BoardRepository::class);
    $this->app->bind(BoardServiceInterface::class, BoardService::class);
  }
}
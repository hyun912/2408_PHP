<?php

namespace App\Providers;

use App\Repositories\BoardRepository;
use App\Repositories\Interfaces\BoardRepositoryInterface;
use App\Services\BoardService;
use App\Services\Interfaces\BoardServiceInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
  /**
   * 서비스 등록
   *
   * @return void
   */
  public function register() {
    $this->app->bind(BoardRepositoryInterface::class, BoardRepository::class);
    $this->app->bind(BoardServiceInterface::class, BoardService::class);
  }

  /**
   * 서비스 부트스트랩
   * 
   * @return void
   */
  public function boot() {
    //
  }
}
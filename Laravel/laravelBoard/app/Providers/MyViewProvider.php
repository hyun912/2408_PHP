<?php

namespace App\Providers;

use App\Models\BoardsCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MyViewProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        View::composer(['board', 'insert'], function($view) { // * 을빼고 적용하고 싶은곳을 []로 view처럼 적으면됨
          $resultBoardCategoryInfo = BoardsCategory::orderBy('bc_type')->get();
          $view->with('myGlobalBoardsCategoryInfo', $resultBoardCategoryInfo);
        }); // 모든 뷰에서 실행, 콜백
    }
}

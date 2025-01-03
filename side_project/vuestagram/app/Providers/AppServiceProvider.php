<?php

namespace App\Providers;

use App\Exceptions\MyAuthException;
use App\Utils\MyEncrypt;
use App\Utils\MyToken;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
  public function register() {
    $this->app->bind('MyEncrypt', function() {
      return new MyEncrypt();
    });
    $this->app->bind('MyToken', function() {
      return new MyToken();
    });
    $this->app->bind('MyAuthException', function() {
      return new MyAuthException();
    });
  }

  public function boot() {
    //
  }
}

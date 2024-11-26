<?php

namespace App\Http\Middleware;

use Closure;
use MyToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MyAuth {
  public function handle(Request $request, Closure $next) {
    // 토큰 검증
    Log::debug('MyAuth: ' . $request->bearerToken());

    MyToken::chkToken($request->bearerToken());
    
    return $next($request);
  }
}

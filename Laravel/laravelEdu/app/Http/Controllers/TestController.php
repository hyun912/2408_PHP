<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller {
  public function index() {
    $result = '홍';
    return view('test')
      ->with('name', $result);
  }
}

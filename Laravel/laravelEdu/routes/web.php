<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/hi', function () {
    return 'hello, world!';
});

Route::get('/myview', function () {
    return view('myView');
});


// httpMethod 대응 메소드
Route::prefix('/home')->group(function () {
  // Route::get('', function () { return view('home'); });
  // Route::post('', function () { return 'HOME POST'; });
  // Route::put('', function () { return 'HOME PUT'; });
  // Route::delete('', function () { return 'HOME DELETE'; });
  // Route::patch('', function () { return 'HOME PATCH'; });

  Route::match(['get', 'post', 'put', 'delete', 'patch'], '', function (Request $request) {
    if ($request->isMethod('get')) {
      return view('home');
    } elseif ($request->isMethod('post')) {
      return 'HOME POST';
    } elseif ($request->isMethod('put')) {
      return 'HOME PUT';
    } elseif ($request->isMethod('delete')) { 
      return 'HOME DELETE';
    } elseif ($request->isMethod('patch')) {
      return 'HOME PATCH';
    }
  });
});


// 파라미터 제어
Route::get('/param', function (Request $request) {
    // request()->id; // 리소스 많이먹음

    // http://localhost:8000/param?id=1&name=dd
    return 'ID : '.$request->id.' NAME: '.$request->name;
});

// 세그먼트 파라미터
Route::get('/param/{id}', function ($id) {
    // http://localhost:8000/param/1
    return 'ID 1 : '.$id;
});
Route::get('/param/{id}', function (Request $request) {
    return 'ID 2 : '.$request->id;
});
Route::get('/param2/{id}', function (Request $request, $id) {
    return 'ID 3 : '.$id."  ".$request->id;
});
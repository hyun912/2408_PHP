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


// 
// httpMethod 대응 메소드
// 

Route::get('/home', function () { return view('home'); });
Route::post('/home', function () { return 'HOME POST'; });
Route::put('/home', function () { return 'HOME PUT'; });
Route::delete('/home', function () { return 'HOME DELETE'; });
Route::patch('/home', function () { return 'HOME PATCH'; });

// Route::match(['get', 'post', 'put', 'delete', 'patch'], '/home', function (Request $request) {
//   if ($request->isMethod('get')) {
//     return view('home');
//   } elseif ($request->isMethod('post')) {
//     return 'HOME POST';
//   } elseif ($request->isMethod('put')) {
//     return 'HOME PUT';
//   } elseif ($request->isMethod('delete')) { 
//     return 'HOME DELETE';
//   } elseif ($request->isMethod('patch')) {
//     return 'HOME PATCH';
//   }
// });


// 
// 파라미터 제어
// 
Route::get('/param', function (Request $request) {
    // request()->id; // 리소스 많이먹음

    // http://localhost:8000/param?id=1&name=dd
    return 'ID : '.$request->id.' NAME: '.$request->name;
});


// 
// 세그먼트 파라미터
// 
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


// 세그먼트 파라미터 디폴트 설정, 중복경로 라우트 안되도록 주의
Route::get('/param3', function () {
    return 'PARAM3';
});
Route::get('/param3/{id?}', function ($id = 1) {
    return 'ID 4 : '.$id;
});

// 이름 지정
Route::get('/name', function () {
  return view('name');
});
Route::get('/home/php/laravel/newbi', function () {
  return "촘 길어";
})->name('long');


// 
// 뷰에 데이터 전달
// 
Route::get('/send', function() {
  $result = [
    ['id' => 1, 'name' => '홍']
    ,['id' => 2, 'name' => '갑']
  ];
  
  // return view('send')
  //   ->with('gender', '무성')
  //   ->with('data', $result); // key, value

  // return view('send', ['gender' => '무성', 'data' => $result]);
  return view('send')->with(['gender' => '무성', 'data' => $result]);

  // 리다이렉션과 세션 데이터를 전달할 때는 with()를 사용
  // 일반적인 뷰 데이터를 전달할 때는 view()를 사용하는 것이 가독성과 유지보수성 측면에서 더 나은 선택
});

// 
// 대체 라우트
// 
Route::fallback(function () {
  // 라우트에 없는 경로를 칠경우 반환
  return '이상한 URL';
});


// 
// 라우트 그룹
// 
Route::get('/users', function () { return 'GET : /users'; });
Route::post('/users', function () { return 'POST : /users'; });
Route::put('/users/{id}', function () { return 'PUT : /users'; });
Route::delete('/users/{id}', function () { return 'DELETE : /users'; });
// ↑를 묶음
Route::prefix('/users')->group(function () {
  Route::get('/', function () { return 'GET : /users'; });
  Route::post('/', function () { return 'POST : /users'; });
  Route::put('/{id}', function () { return 'PUT : /users'; });
  Route::delete('/{id}', function () { return 'DELETE : /users'; });
});
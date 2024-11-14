<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
  
  /**
   * 로그인 이동
   */
  public function goLogin() {
    return view('login');
  }

  /**
   * 로그인 처리
   */
  public function login(Request $request) {
    
    // 유효성 검사
    $validator = Validator::make(
      $request->only('u_email', 'u_password')
      ,[
        'u_email' => ['required'
                      ,'exists:users,u_email'
                      ,'regex:/^[0-9a-zA-Z](?!.*?[\-\_\.]{2})[a-zA-Z0-9\-\_\.]{3,63}@[0-9a-zA-Z](?!.*?[\-\_\.]{2})[a-zA-Z0-9\-\_\.]{3,63}\.[a-zA-Z]{2,3}$/'
                    ]
        ,'u_password' => ['required', 'between:6,20', 'regex:/^[a-zA-Z0-9!@]+$/']
      ]
    );

    if($validator->fails()) {
      return redirect()
              ->route('goLogin')
              ->withErrors($validator->errors());
    }

    // 회원정보 획득
    $userInfo = User::where('u_email', $request->u_email)->first();

    // 비밀번호 검사
    if(!(Hash::check($request->u_password, $userInfo->u_password))) {
      return redirect()->route('goLogin')->withErrors('비밀번호가 일치하지 않습니다.');
    }

    // 인증 처리
    Auth::login($userInfo);

    // var_dump(Auth::id());
    // var_dump(Auth::user()->u_id);
    // var_dump(Auth::check());
    
    return redirect()->route('boards.index');
  }

  public function logout() {
    Auth::logout();
    Session::invalidate(); // 기존 세션 모든 데이터 제거 및 새로운 새션 ID 발급
    Session::regenerateToken(); // CSRF토큰 재발급
    
    return redirect()->route('goLogin');
  }

}

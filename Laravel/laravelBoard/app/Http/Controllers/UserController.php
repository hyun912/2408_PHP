<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Throwable;

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

  // public function goRegister() {
  //   return view('register');
  // }

  public function register(Request $request) {
    if($request->isMethod('get')) {
      return view('register');
    }else { // post
      // 유효성 체크

      $validator = Validator::make(
        $request->only('u_email', 'u_password', 'u_password_chk', 'u_name')
        ,[
          'u_email' => ['required'
                        ,'unique:users,u_email'
                        ,'regex:/^[0-9a-zA-Z](?!.*?[\-\_\.]{2})[a-zA-Z0-9\-\_\.]{3,63}@[0-9a-zA-Z](?!.*?[\-\_\.]{2})[a-zA-Z0-9\-\_\.]{3,63}\.[a-zA-Z]{2,3}$/'
                      ]
          ,'u_password' => ['required', 'between:6,20', 'regex:/^[a-zA-Z0-9!@]+$/']
          ,'u_password_chk' => ['same:u_password']
          ,'u_name' => ['required',  'between:1,10', 'regex:/^[가-힣]+$/u']
        ]
      );
  
      if($validator->fails()) {
        return redirect()->route('register')->withErrors($validator->errors())->withInput();
      }
  
      // 회원 정보 생성
      try{
        DB::beginTransaction();
        $userInsert = new User();
        $userInsert->u_email = $request->u_email;
        $userInsert->u_password = Hash::make($request->u_password);
        $userInsert->u_name = $request->u_name;
        $userInsert->save();
        DB::commit();
  
        // Auth::login($userInsert);
        // return redirect()->route('boards.index')->withInput();
      }catch(Throwable $th) {
        DB::rollBack();
        // return redirect()->route('register')->withInput()
        //         ->withErrors('회원가입중 문제가 발생하였습니다. 관리자에게 문의해주세요.\n'.$th->getMessage());
      }

      return redirect()->route('goLogin');
    }
  }
}

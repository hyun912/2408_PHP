<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
  public function rules() {
    $rules = [
      'account' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z]+$/']
      ,'password' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z!@]+$/']
    ];

    // 로그인 요청 시 중복 계정 체크
    if($this->routeIs('auth.login')) {
      $rules['account'][] = 'exists:users,account';
    }

    // 회원가입 요청 시 비밀번호 확인
    elseif($this->routeIs('user.store')) {
      $rules['account'][] = 'unique:users,account';
      $rules['password_chk'] = ['same:password'];
      $rules['name'] = ['required', 'between:1,20', 'regex:/^[가-힣]+$/u'];
      $rules['gender'] = ['required', 'regex:/^[0-1]{1}$/'];
      $rules['profile'] = ['required', 'image'];
    }

    return $rules;
  }

  protected function failedValidation(Validator $validator) {
    $response = response()->json([
      'success' => false,
      'message' => '유효성 검사 오류',
      'data' => $validator->errors()
    ], 422);

    throw new HttpResponseException($response);
  }
}

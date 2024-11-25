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

    if($this->routeIs('post.login')) {
      $rules['account'][] = 'exists:users,account';
    }

    return $rules;
  }

  protected function failedValidation(Validator $validator) {
    $response = response()->json([
      'success' => false,
      'message' => '유효성 검사 오류',
      'data' => $validator->errors()
    ]);

    throw new HttpResponseException($response);
  }
}

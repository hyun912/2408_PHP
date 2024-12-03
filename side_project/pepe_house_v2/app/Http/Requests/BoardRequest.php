<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardRequest extends FormRequest {
  /**
   * 사용자가 이 요청을 수행할 권한이 있는지 확인합니다.
   *
   * @return bool
   */
  public function authorize() {
    return false;
  }

  /**
   * 요청에 적용되는 유효성 검사 규칙을 가져옵니다.
   *
   * @return array<string, mixed>
   */
  public function rules() {
    return [
      //
    ];
  }
}
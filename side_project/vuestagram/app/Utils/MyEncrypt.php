<?php

namespace App\Utils;

use Illuminate\Support\Str;

class MyEncrypt {
  /**
   * base64 URL 인코딩
   * 
   * @param string $json
   * 
   * @return string base64UrlEncode
  */
  public function base64UrlEncode(string $json) {
    return rtrim(strtr(base64_encode($json), '+/', '-_'), '=');
  }

  /**
   * base64 URL 디코딩
   * 
   * @param string $base64 - base64UrlEncode
   * 
   * @return string $json
  */
  public function base64UrlDecode(string $base64) {
    return base64_decode(strtr($base64, '-_', '+/'));
  }

  /**
   * 솔트(특정 길이만큼 랜덤한 문자열) 생성
   * 
   * @param int $saltLength
   * 
   * @return string 랜덤 문자열
   */
  public function makeSalt(int $saltLength) {
    return Str::random($saltLength);
  }

  /**
   * 문자열 암호화
   * 
   * @param string $alg 알고리즘명
   * @param string $str 암호화 할 문자열
   * @param string $salt 솔트
   * 
   * @return string 암호화 된 문자열
   */
  public function hasWithSalt(string $alg, string $str, string $salt) {
    return hash($alg, $str).$salt;
  }

  /**
   * 특정 길이의 솔트를 제거한 문자열 반환
   * 
   * @param string $signature 솔트가 포함된 시그니처
   * @param int $saltLength 솔트 길이
   * 
   * @return string 솔트가 제거된 문자열
  */
  public function subSalt(string $signature, int $saltLength) {
    return mb_substr($signature, 0, (-1 * $saltLength));
  }
}

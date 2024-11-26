<?php

namespace App\Utils;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use MyEncrypt;
use PDOException;

class MyToken {

  /**
   * 액서스 토큰과 리프레시 토큰 생성
   * 
   * @param// App\Models\User $user
   * 
   * @return Array [$accessToken, $refreshToken]
  */
  public function createTokens(User $user) {
    $accessToken = $this->createToken($user, env('TOKEN_EXP_ACCESS'));
    $refreshToken = $this->createToken($user, env('TOKEN_EXP_REFRESH'), false);

    return [$accessToken, $refreshToken];
  }

  /**
   * 리프레시 토큰 업데이트
   * 
   * @param// App\Models\User $userInfo - 유저정보
   * @param string $refreshToken - 리프레시 토큰
   * 
   * @return bool true
  */
  public function updateRefreshToken(User $userInfo, string $refreshToken) {
    $userInfo->refresh_token = $refreshToken;

    DB::beginTransaction();
    
    if(!($userInfo->save())) {
      DB::rollBack();
      throw new PDOException('Error: updateRefreshToken()');
    }
    
    DB::commit();

    return true;
  }

  // private ------------------------------------------------------------

  /**
   * JWT 토큰 생성
   * 
   * @param// App\Models\User $user
   * @param int $ttl
   * @param bool $accessFlg = true
   * 
   * @return String JWT
  */
  private function createToken(User $user, int $ttl, bool $accessFlg = true) {
    $header = $this->createHeader();
    $payload = $this->createPayload($user, $ttl, $accessFlg);
    $signature = $this->createSignature($header, $payload);

    return $header . '.'. $payload . '.' . $signature;
  }

  /**
   * JWT Header 생성
   * 
   * @return String base64UrlEncode
  */
  private function createHeader() {
    $header = [
      'alg' => env('TOKEN_ALG')
      ,'typ' => env('TOKEN_TYPE')
    ];
    
    return MyEncrypt::base64UrlEncode(json_encode($header));
  }

  /**
   * JWT 페이로드 생성
   * 
   * @param// App\Models\User $user
   * @param int $ttl
   * @param bool $accessFlg = true
   * 
   * @return string base64UrlPayload
  */
  private function createPayload(User $user, int $ttl, bool $accessFlg = true) {
    $now = time();

    // 페이로드 기본 데이터 생성
    $payload = [
      'idt' => $user->user_id,
      'iat' => $now,
      'exp' => $now + $ttl,
      'ttl' => $ttl
    ];

    // 액서스 토큰일 경우 아래 데이터 추가
    if($accessFlg) {
      $payload['acc'] = $user->account;
    }

    return MyEncrypt::base64UrlEncode(json_encode($payload));
  }

  /**
   * JWT 시그니쳐 작성
   * 
   * @param string $header
   * @param string $payload
   * 
   * @return string base64UrlSignature
  */
  private function createSignature(string $header, string $payload) {
    return MyEncrypt::hasWithSalt(env('TOKEN_ALG'), $header.env('TOKEN_SECRET_KEY').$payload, MyEncrypt::makeSalt(env('TOKEN_SALT_LENGTH')));
  }
}

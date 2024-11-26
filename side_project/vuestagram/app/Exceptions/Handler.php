<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use PDOException;
use Throwable;
// use MyAuthException; // 같은 폴더내면 없어도됨

class Handler extends ExceptionHandler {
  protected $dontReport = [
      //
  ];
  
  protected $dontFlash = [
      'current_password',
      'password',
      'password_confirmation',
  ];

  public function register() {
      $this->reportable(function (Throwable $e) {
          //
      });
  }

  /**
   * 모든 예외를 여기다 처리
   * 예외 및 에러 발생시 호출
   * 주로 로깅이나 외부 서비스에 보고를 위한 작업 수행
  */
  public function report(Throwable $th) {
    Log::info($th->getMessage());
  }

  /**
   * 에러 핸들링 커스텀
   * 예외 및 에러가 브라우저로 랜더링 되기전 호출
   * 커스텀 HTTP 응답 전달
  */
  public function render($request, Throwable $th) {
    // 예외정보 초기화
    $code = 'E99';

    // 인스턴스 확인 후 예외 정보 변경 **많이 사용됨
    if($th instanceof AuthenticationException) {
      $code = 'E01';
    }elseif($th instanceof PDOException) {
      $code = 'E80';
    }

    $errInfo = $this->context()[$code];

    // 커스텀 인스턴스 확인
    if($th instanceof MyAuthException) {
      $code = $th->getMessage();
      $errInfo = $th->context()[$code];
    }

    // Response 객체 생성 및 반환
    $responseData = [
      'success' => false
      ,'msg' => $errInfo['msg']
      ,'code' => $code
    ];

    return response()->json($responseData, $errInfo['status']);
  }

  /**
   * 에러 메세지 리스트
   * 
   * @return Array 에러배열
  */
  public function context() {
    return [
      'E01' => [ 'status' => 401, 'msg' => '비밀번호가 일치하지 않습니다.'],
      'E99' => [ 'status' => 500, 'msg' => '시스템 에러가 발생했습니다.'],
      'E80' => [ 'status' => 500, 'msg' => 'DB 에러가 발생했습니다.'],
    ];
  }
}

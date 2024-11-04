<?php

namespace Controllers;

class Controller {

  public function __construct(string $action) {
    // 세션 시작
    
    // 유저 로그인 및 권한 체크
  
    // 해당 액션 호출
    $resultAction = $this->$action();

    // 뷰 호출
    $this->callView($resultAction);

    // 프흐프 종료
    exit;
  }

  // 뷰 or 로케이션 처리용 메소드
  private function callView($path) {
    if(mb_strpos($path, 'Location:') === 0) {
      header($path);
    }else {
      require_once(_PATH_VIEW.'/'.$path);
    }
  }
}
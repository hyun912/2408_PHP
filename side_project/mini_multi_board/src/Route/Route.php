<?php

namespace Route;

use Controllers\UserController;

// 라우터 : 유저의 요청을 분선해 해당 컨트롤러로 연결해주는 클래스
class Route {
  // 생성자
  public function __construct() {
    $url = $_GET['url']; // 요청 경로 획득
    $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']); // HTTP 메소드 획득

    // 요청 경로 체크
    if($url === 'login') {
      // 회원 로그인 관련
      if($httpMethod === 'GET') {
        new UserController('goLogin'); // 해당 컨트롤러 생성자에 없으면 extends된 부모 생성자로 찾아감

      }elseif($httpMethod === 'POST') {

      }
    } 
  }
}

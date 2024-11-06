<?php

namespace Lib;

class Auth {
  
  public static function chkAuthorization() {
    $url = $_GET['url'];
    $arrNeedAuth = [
       'boards'
      ,'boards/detail'
      ,'logout'
      ,'boards/insert'
    ]; // 비로그인시 접속 불가능한 리스트

    // 세션에 이메일이 있고 리스트에 있으면 로그인으로 보냄
    if(!isset($_SESSION['u_email']) && in_array($url, $arrNeedAuth)) {
      header('Location: /login');
      exit;
    }

    // 로그인한 상태에서 로그인 페이지 접속시 게시판 이동
    if(isset($_SESSION['u_email']) && !in_array($url, $arrNeedAuth)) {
      header('Location: /boards');
      exit;
    }
  }
}
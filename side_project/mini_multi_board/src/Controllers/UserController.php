<?php

namespace Controllers;

use Controllers\Controller;
use Lib\UserValidator;
use Models\User;

class UserController extends Controller {
  protected function goLogin() {
    return 'login.php';
  }

  protected function login() {
    // 유저 입력 정보 획득
    $requestData = [
      'u_email' => $_POST['u_email']
      ,'u_password' => $_POST['u_password']
    ];

    // 유효성 검사
    $requestValidator = UserValidator::chkValidator($requestData);

    if(count($requestValidator) > 0) {
      $this->arrErrorMsg = $requestValidator;
      return 'login.php';
    }

    // 유저 정보 획득
    $userModel = new User();
    $arrPrepare = [
      'u_email' => $requestData['u_email']
    ];
    $resultUserInfo = $userModel->getUserInfo($arrPrepare);
    
    // 비밀번호 암호화
    // var_dump(password_hash($requestData['u_password'], PASSWORD_DEFAULT)); // Qwer123!
    // exit;
    
    // 유저 존재 유무 확인
    if(!$resultUserInfo) {
      $this->arrErrorMsg[] = '존재하지 않는 이메일입니다.';
      return 'login.php';
    }elseif(!password_verify($requestData['u_password'], $resultUserInfo['u_password'])) {
      // 비밀번호 체크 : password_verify('체크할 비번', '암호화된 비번')
      $this->arrErrorMsg[] = '비밀번호가 일치하지 않습니다.';
      return 'login.php';
    }

    // 세션에 u_id 저장
    $_SESSION['u_email'] = $resultUserInfo['u_email'];

    // 로케이션 처리
    return 'Location: /boards';
  }
}
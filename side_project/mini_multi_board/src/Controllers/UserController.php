<?php

namespace Controllers;

use Controllers\Controller;
use Lib\UserValidator;
use Models\User;

class UserController extends Controller {
  protected $userInfo = [
    'u_email' => ''
    ,'u_name' => ''
  ];

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

  public function logout() {
    unset($_SESSION['u_email']); // 이메일 세션 삭제
    session_destroy(); // 세션 파기

    return 'Location: /login';
  }

  public function goRegist() {
    return 'regist.php';
  }

  public function regist() {
    $requestData = [
       'u_email'        => isset($_POST['u_email']) ? $_POST['u_email'] : ''
      ,'u_password'     => isset($_POST['u_password']) ? $_POST['u_password'] : ''
      ,'u_password_chk' => isset($_POST['u_password_chk']) ? $_POST['u_password_chk'] : ''
      ,'u_name'         => isset($_POST['u_name']) ? $_POST['u_name'] : ''
    ];
    $this->userInfo = [
       'u_email' => $requestData['u_email']
      ,'u_name' => $requestData['u_name']
    ];
    
    // 유효성 체크
    $resultValidator = UserValidator::chkValidator($requestData);

    if(count($resultValidator) > 0) {
      $this->arrErrorMsg = $resultValidator;

      return 'regist.php';
    }

    // 이메일 중복 체크
    $userModel = new User();
    $arrPrepare = [
      'u_email' => $requestData['u_email']
    ];
    $resultUserInfo = $userModel->getUserInfo($arrPrepare);

    if($resultUserInfo) {
      $this->arrErrorMsg[] = '이미 가입된 이메일 입니다.';

      return 'regist.php';
    }

    // 회원 정보 생성
    $userModel->beginTransaction();
    $arrPrepare = [
       'u_email' => $requestData['u_email']
      ,'u_password' => password_hash($requestData['u_password'], PASSWORD_DEFAULT)
      ,'u_name' => $requestData['u_name']
    ];
    $resultRegistUserInfo = $userModel->registUserInfo($arrPrepare);

    if($resultRegistUserInfo !== 1) {
      $userModel->rollBack();
      $this->arrErrorMsg[] = '회원가입에 실패했습니다.';
      
      return 'regist.php';
    }

    $userModel->commit();

    return 'Location: /login';
  }
}
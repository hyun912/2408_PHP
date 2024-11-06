<?php

namespace Controllers;

use Lib\Auth;
use Models\BoardsCategory;

class Controller {
  protected $arrErrorMsg = []; // 화면에 표시할 에러 메세지 표시용
  protected $arrBoardNameInfo = []; // 헤더 게시판 드롭다운 리스트

  public function __construct(string $action) {
    // 세션 체크, v5.4이후 사용 가능
    if(session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    
    
    // 유저 로그인 및 권한 체크
    Auth::chkAuthorization();

    // 헤더 드롭다운 리스트 획득
    $boardsCategoryModel = new BoardsCategory();
    $this->arrBoardNameInfo = $boardsCategoryModel->getBoardsNameList();
   
    // 해당 액션 호출
    $resultAction = $this->$action();

    // 뷰 호출
    $this->callView($resultAction);

    // 처리 종료
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
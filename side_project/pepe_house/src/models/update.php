<?php

$conn = null;
$arr_prepare = [];

try{
  if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
    $conn = my_db_conn();

    $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

    $arr_preare["id"] = $id;
    $arr_preare["title"] = $_POST["title"];
    $arr_preare["content"] = $_POST["content"];

    if(isset($_POST["tab_id"])) {
        $arr_preare["tab_id"] = (int)$_POST["tab_id"];
    }

    // 첫번째 페페콘 추출
    $text = $_POST["content"];
    $pattern = '/src="([^"]+)"/'; // 정규식
    if (preg_match($pattern, $text, $matches)) {
        // $matches[1]에는 img src 포함
        $url = $matches[1];
        // src에서 파일 이름만 추출
        $fileName = basename($url);
    }

    if(isset($fileName)) { // 내용에 추출된 페페콘이 있을경우
        $arr_preare["pcon_id"] = (int)my_pcon_get_id_by_name($conn, $fileName)["id"]; // pcon_id 가져옴
    }

    $conn->beginTransaction();

    my_board_update($conn, $arr_preare);

    $conn->commit();

    header("Location: /detail.php?no=".$id);
    exit;

  }else {
    $conn = my_db_conn();

    $id = isset($_GET["no"]) ? (int)$_GET["no"] : 0;

    if($id < 1) {
        throw new Exception("ID Parameter Error");
    }
  
    $arr_prepare["id"] = $id;

    $result = my_board_select_id($conn, $arr_prepare);
    $result_tab = my_tab_select_name($conn); // 탭 출력용
    $result_pcon = my_pcon_select_name($conn); // 페페콘 출력용
  }
}catch(Throwable $th) {
  if(!is_null($conn) && $conn->inTransaction()) {
      $conn->rollBack();
  }
  // echo $th->getMessage();

  require_once(MY_PATH_ERROR);
  exit;
}
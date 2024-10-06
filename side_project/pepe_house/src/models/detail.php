<?php

    $conn = null;
    $arr_prepare = [];

try {
    // 작업 분기
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
      $conn = my_db_conn();

      $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

      $arr_prepare["id"] = $id;

      if(isset($_POST["work"])) {
        $work = $_POST["work"];

        if($work === "normal"){
          $arr_prepare["bookmark"] = '0';
          $arr_prepare["notice"] = '0';
        }elseif($work === "bookmark"){
          $arr_prepare["bookmark"] = '1';
          $arr_prepare["notice"] = '0';
        }elseif($work === "notice"){
          $arr_prepare["bookmark"] = '0';
          $arr_prepare["notice"] = '1';
        }
      }

      $conn->beginTransaction();

      my_board_work_update($conn, $arr_prepare);

      $conn->commit();

      header("Location: /detail.php?no=".$id);

      exit;

    }else {
      $id = isset($_GET["no"]) ? (int)$_GET["no"] : 0;

      if($id < 1) {
          throw new Exception("ID Parameter Error");
      }
  
      $conn = my_db_conn();
  
      $arr_prepare["id"] = $id;
  
      $result = my_board_select_id($conn, $arr_prepare);
    }
} catch(Throwable $th) {
    if(!is_null($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    // echo $th->getMessage();

    require_once(MY_PATH_ERROR);
    exit;
}

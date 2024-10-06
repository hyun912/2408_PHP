<?php

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
      $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

      if($id < 1) {
          throw new Exception("ID Parameter Error");
      }
  
      $conn = my_db_conn();

      $arr_prepare["id"] = $id;

      $conn->beginTransaction();
  
      my_board_delete($conn, $arr_prepare);
  
      $conn->commit();

      header("Location: /");
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
  
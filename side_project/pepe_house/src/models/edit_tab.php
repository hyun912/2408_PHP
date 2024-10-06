<?php

  

$conn = null;

try {
  if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {

    if(isset($_POST["save_tab"])) {
      $conn = my_db_conn();
      
      $save_tabs = json_decode($_POST["save_tab"], true); // 배열 형식으로 디코딩
      echo $save_tabs[0]["name"];

      $conn->beginTransaction();

      foreach($save_tabs as $item) {
        $arr_prepare = [
          "id" => (int)$item["id"]
          ,"number" => $item["number"]
          ,"name" => $item ["name"]
        ];
    
        my_tab_update($conn, $arr_prepare);
      }

      $conn->commit();
    }else{ 
      throw new Exception("Parameter is Null");
    }

    header("Location: /");
    exit;
  }else {
    $conn = my_db_conn();

    $result_tab = my_tab_select_name($conn); // 탭 출력용
  }
} catch(Throwable $th) {
  if(!is_null($conn) && $conn->inTransaction()) {
      $conn->rollBack();
  }
  
  echo $th->getMessage();
  // require_once(MY_PATH_ERROR);
    exit;
}
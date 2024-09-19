<?php

    require_once("./my_db.php");

    $conn = null; // my_db에서 예외 발생시 return값이 아예 안오므로  미리 초기화헤둠
    
    try {
        $conn = my_db_conn();

        $sql = 
             " INSERT INTO employees( "
            ."          name "
            ."         ,birth "
            ."         ,gender "
            ."         ,hire_at "
            ." ) "
            ." VALUES( "
            ."          :name "
            ."         ,:birth "
            ."         ,:gender "
            ."         ,DATE(NOW()) "
            ." ) "
        ;

        $arr_prepare = [
            "name" => "홍길동"
            ,"birth" => "2000-01-01"
            ,"gender" => "M"
        ];


        // start transaction : commit 전까진 데이터 안담김 insert,update,delete 무조건 넣어야함
        $conn->beginTransaction();

        $stmt = $conn->prepare($sql);
        $exec_flg = $stmt->execute($arr_prepare);
        $result_cnt = $stmt->rowCount(); // 영향받은 레코드수 반환

        // insert 실패시
        if(!$exec_flg){
            // 강제로 catch에 던짐
            throw new Exception("execute 예외 발생", "001"); // (message, code)
        }

        // insert가 지금은 한 레코드 생성하니 1개가 아닐시
        if($result_cnt !== 1) { 
            throw new Exception("레코드수 이상 발생", "002");
        }

        $conn->commit(); // 이상없으면 transaction 끝내서 적용

    }catch(Throwable $th) {
        if(!is_null($conn)){
            $conn->rollBack(); // 이상발생시 적용안하고 되돌림
        }
        echo $th->getMessage();
        // echo $th->getCode(); // Error code
    }
<?php

    require_once("./my_db.php");

    $conn = null;

    try {
        $conn = my_db_conn();

        $sql = 
             " UPDATE employees "
            ." SET "
            ."     name = :name "
            ."     ,updated_at = NOW() " 
            ." WHERE "
            ."     emp_id = :emp_id "
        ;
        
        $arr_parpare = [
            "name" => "갑숭이"
            ,"emp_id" => 100001
        ];

        $conn->beginTransaction();

        $stmt = $conn->prepare($sql);
        $result_flg = $stmt->execute($arr_parpare);
        $result_cnt = $stmt->rowCount();

        $conn->commit();

        if(!$result_flg) {
            throw new Exception("쿼리 실행 예외");
        }

        if($result_cnt !== 1) {
            throw new Exception("수정 레코드수 이상");
        }

    }catch(Throwable $th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }
        echo $th->getMessage();
    }
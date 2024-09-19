<?php

    require_once("./my_db.php");

    $conn = null;

    try {
        
        $conn = my_db_conn();
        
        $sql = 
            "DELETE FROM employees"
            ." WHERE "
            ."       emp_id = :emp_id"
        ;

        $arr_prepare = [
            "emp_id" => 100001
        ];
        
        $conn->beginTransaction();

        $stmt = $conn->prepare($sql);
        $result_flg = $stmt->execute($arr_prepare);
        $result_cnt = $stmt->rowCount();
        
        if(!$result_flg) {
            throw new Exception("쿼리 에러");
        }

        if($result_cnt > 1) {
            throw new Exception("레코드 에러");
        } 

        $conn->commit();
        
    }catch(Throwable $th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }
        
        echo $th->getMessage();
    }
<?php

    // 내 급여 2500만 변경
    // update 먼저하고 insert하는게 효율 좋다함

    require_once("../Ex/my_db.php");

    $conn = null;

    try {
        $conn = my_db_conn();

        $conn->beginTransaction();

        // --------------------------------------
        // select
        $sql = 
            " SELECT "
            ."       * "
            ." FROM "
            ."      employees "
            ." WHERE "
            ."       name = :name "
            ."   AND birth = :birth "
            ."   AND gender = :gender "
            ."   AND hire_at = :hire_at "
            ." LIMIT 1 "
        ;

        $arr_prepare = [
            "name" => "김현석"
            ,"birth" => "1991-02-19"
            ,"gender" => "M"
            ,"hire_at" => "2024-09-19"
        ];
    
        $stmt = $conn->prepare($sql); 
        $result_flg = $stmt->execute($arr_prepare);
        $result = $stmt->fetchAll();

        if(!$result_flg) {
            throw new Exception("Select Query Error : employees");
        }

        if($stmt->rowCount() !== 1) {
            throw new Exception("Select Count Error : employees");
        }


        $emp_id = $result[0]["emp_id"];

    
        // ---------------------------------------
        // update
        $sql = 
            " UPDATE salaries "
            ." SET "
            ."      end_at = DATE(NOW()) "
            ."      ,updated_at = NOW() "
            ." WHERE "
            ."      emp_id = :emp_id "
            ."  AND end_at IS NULL "
            // ."  AND sal_id != :sal_id "
        ;

        $arr_prepare = [
            "emp_id" => $emp_id
            // ,"sal_id" => $sal_id
        ];

        $stmt = $conn->prepare($sql);

        if(!$stmt->execute($arr_prepare)) {
            throw new Exception("Update Query Error : salaries");
        }

        if($stmt->rowCount() !== 1) {
            throw new Exception("Update Count Error : salaries");
        }
    

        // ---------------------------------------
        // insert
        $sql = 
            " INSERT INTO salaries( "
            ."          emp_id "
            ."          ,salary "
            ."          ,start_at "
            ." ) "
            ." VALUES( "
            ."          :emp_id "
            ."          ,:salary "
            ."          ,DATE(NOW()) "
            ." ) "
        ;

        $arr_prepare = [
            "emp_id" => $emp_id
            ,"salary" => 25000000
        ];

        $stmt = $conn->prepare($sql);

        if(!$stmt->execute($arr_prepare)) {
            throw new Exception("Insert Query Error : salaries");
        }

        if($stmt->rowCount() !== 1) {
            throw new Exception("Insert Count Error : salaries");
        }

        // $sal_id = $conn->lastInsertId();

        $conn->commit();

    }catch(Throwable $th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }
        echo $th->getMessage();
    }
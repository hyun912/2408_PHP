<?php

    require_once("./my_db.php");

    $conn = null;

    try {

        $conn = my_db_conn();

        $conn->beginTransaction();

        // 사원 insert
        $sql = 
            " INSERT INTO employees( "
            ." name "
            ." ,birth"
            ." ,gender"
            ." ,hire_at"
            ." ) "
            ." VALUES( "
            ." :name "
            ." ,:birth"
            ." ,:gender"
            ." ,DATE(NOW())"
            ." ) "
        ;

        $arr_prepare = [
            "name" => "무모마"
            ,"birth" => "2000-01-01"
            ,"gender" => "M"
        ];

        $stmt = $conn->prepare($sql);
        $result_flg = $stmt->execute($arr_prepare);
        $result_cnt = $stmt->rowCount();

        if(!$result_flg) {
            throw new Exception("Insert Query Error : employees");
        }

        if($result_cnt !== 1) {
            throw new Exception("Insert Count Error : employees");
        }

        // insert한 레코드 pk 획득
        $emp_id = $conn->lastInsertId();

        
        // -------------------------------------------------------
        // 급여 insert
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
            ,"salary" => 175000000
        ];

        $stmt = $conn->prepare($sql);
        $result_flg = $stmt->execute($arr_prepare);
        $result_cnt = $stmt->rowCount();

        if(!$result_flg) {
            throw new Exception("Insert Query Error : salaries");
        }

        if($result_cnt !== 1) {
            throw new Exception("Insert Count Error : salaries");
        }


        // -------------------------------------------------------
        // 직급 insert
        $sql = 
            " INSERT INTO title_emps( "
            ."          emp_id "
            ."          ,title_code "
            ."          ,start_at "
            ." ) "
            ." VALUES( "
            ."          :emp_id "
            ."          ,:title_code "
            ."          ,DATE(NOW()) "
            ." ) "
        ;

        $arr_prepare = [
            "emp_id" => $emp_id
            ,"title_code" => "T001"
        ];

        $stmt = $conn->prepare($sql);
        $result_flg = $stmt->execute($arr_prepare);
        $result_cnt = $stmt->rowCount();

        if(!$result_flg) {
            throw new Exception("Insert Query Error : title_emps");
        }

        if($result_cnt !== 1) {
            throw new Exception("Insert Count Error : title_emps");
        }


        // -------------------------------------------------------
        // 부서 insert 
        $sql = 
            " INSERT INTO department_emps( "
            ."          emp_id "
            ."          ,dept_code "
            ."          ,start_at "
            ." ) "
            ." VALUES( "
            ."          :emp_id "
            ."          ,:dept_code "
            ."          ,DATE(NOW()) "
            ." ) "
        ;

        $arr_prepare = [
            "emp_id" => $emp_id
            ,"dept_code" => "D002"
        ];

        $stmt = $conn->prepare($sql);
        $result_flg = $stmt->execute($arr_prepare);
        $result_cnt = $stmt->rowCount();

        if(!$result_flg) {
            throw new Exception("Insert Query Error : department_emps");
        }

        if($result_cnt !== 1) {
            throw new Exception("Insert Count Error : department_emps");
        }

        $conn->commit();

    }catch(Throwable $th) {
        if(!is_null($conn)){
            $conn->rollBack();
        }

        echo $th->getMessage();
    }
<?php

    require_once("./my_db.php");


    try{
        $conn = my_db_conn();

        $id = 1;
        // 유지보수 추가가 용이함을 위해 따로따로, 반드시 앞뒤를 띄워야함
        $sql = " SELECT "
               ."     * "
               ." FROM employees "
               ." WHERE "
               ."   emp_id = :emp_id "
               ."   AND name = :name "
               ;
        
        // 프리페어드 스테이먼트 (Prepared Statement)
        // 보안상 공격을 방지하기위해 사용
        $arr_prepare = [
            "emp_id" => $id
            ,"name" => "아무개"
        ];
    
        $stmt = $conn->prepare($sql); // 준비시킴
        $stmt->execute($arr_prepare); // 실행
        $result = $stmt->fetchAll(); // 결과 패치
    
        print_r($result);
    } catch(Throwable $th) { 
        echo $th->getMessage();
    } 
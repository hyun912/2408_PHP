<?php

require_once("./my_db.php");

/* #동적 쿼리 */

    $data = [
        "name" => "무모마"
        ,"gender" => "M"
        ,"birth" => "2000-01-01"
    ];

    $sql =
        " SELECT * "
        ." FROM employees "
    ;

    $where = "";
    $arr_prepare = [];

    foreach($data as $key => $val) {

        $where .= empty($where) ? " WHERE " : " AND " ;

        $where .= " ".$key." = :".$key;

        $arr_prepare[$key] = $val; 
    }

    $sql .= $where;

    $conn = my_db_conn();
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr_prepare);

    print_r($stmt->fetchAll());
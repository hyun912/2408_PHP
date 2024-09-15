<?php

/* PDO class : DB 액서스 */

    // DB 정보들 입력
    $my_host = "localhost"; // DB Host
    $my_user = "root"; // DB 계정명
    $my_password = "123123"; // DB 비번
    $my_db_name = "dbsample"; // 접속 DB명
    $my_charset = "utf8mb4"; // DB Charset

    // DB 접속 명령어
    $my_dsn = "mysql:host=".$my_host.";dbname=".$my_db_name.";charset=".$my_charset; // DSN

    // PDO 옵션 설정
    $my_otp = [
        PDO::ATTR_EMULATE_PREPARES    => FALSE // PHP(true)와 DB(false) 어디에서 에뮬레이션 할지 결정
        ,PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION // 에러처리 방식 지정, exception이 보통
        ,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // DB 데이터를 어떤 방식으로 데이터를 가져올지 결정
                                                          // FETCH_ASSOC : 배열, FETCH_OBJ : 클래스
    ];

    // DB 접속
    $conn = new PDO($my_dsn, $my_user, $my_password, $my_otp); // (명령어, 계정명, 비번, 설정옵션);

    // -- 여기까지 고정 -- //

    // 조회 | 사번 오름차순 5개 
    $sql = "SELECT *
              FROM employees
              ORDER BY emp_id ASC
              LIMIT 5"
            ;
    
    $stmt = $conn->query($sql); // PDO::rquery() 쿼리 준비+실행
    $result = $stmt->fetchAll(); // 질의 결과 패치
    // print_r($result);


    // 사번과 이름 출력

    foreach($result as $item) {
        echo $item["emp_id"]." ".$item["name"]."\n";
    }
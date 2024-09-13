<?php

    // 3의 배수 박수
    for($i = 1; $i < 101; $i++) {
        echo $i % 3 === 0 ? " 짝" : " ".$i;
        if($i !== 100) echo ", ";
    }

    echo "\n";


    // 반복문 이용 급여 5000이상이고 성별 남자 사원 id, 이름 출력
    $arr  = [
        ["id" => 1, "name" => "미어캣", "gender" => "M", "salary" => "6000"]
        ,["id" => 2, "name" => "홍길동", "gender" => "M", "salary" => "3000"]
        ,["id" => 3, "name" => "갑순이", "gender" => "F", "salary" => "10000"]
        ,["id" => 4, "name" => "갑돌이", "gender" => "M", "salary" => "8000"]
    ];

    foreach($arr as $item) {
        if(((int)$item["salary"] >= 5000) && ($item["gender"] === "M"))
            echo "id: ".$item["id"].", name: ".$item["name"]."\n";
    }
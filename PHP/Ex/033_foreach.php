<?php

/* #foreach : 배열용 반복문 */

    $arr = [1, 2, 3];

    foreach ($arr as $key => $val) {
        echo "key: ".$key.", value: ".$val."\n";
    }

    //-------------//

/* #실습 */

    // arr2 이용 구구단 2단 출력
    $arr2 = [1, 2, 3, 4, 5, 6, 7, 8, 9];

    foreach($arr2 as $val) {
        echo "2 x ".$val." = ".(2*$val)."\n";
    }

    //-------------//

/* #연관 배열 */

    $arr3 = [
        "name" => "meerkat"
        ,"age" => 20
        ,"gender" => "M"
    ];

    foreach($arr3 as $key => $val) {
        echo $key." : ".$val."\n";
    }
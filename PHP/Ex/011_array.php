<?php

    /* #배열 */

    $arr = [4, 3, 6, 1];

    // 5.3 이하
    // $arr = array(4, 3, 6, 1);

    // 접근
    echo $arr[2]."\n";

    // 변환
    $arr[2] = 100;
    var_dump($arr);
    
//-------------//

    /* #연관 배열 */

    $arr2 = [
        "key" => "value"
        ,"key2" => "하이"
    ];

    echo $arr2["key2"]."\n";

    $arr2 ["key3"] = "용"; // 새값넣기
    var_dump($arr2);
     
//-------------//
    
    /* #다차원 배열 */

    $result1 = [
        [1, 2, 3]
        ,[4, 5, 6]
        ,[7, 8, 9]
    ];
    echo $result1[0][1]."\n";

    $result2 = [
        [
            "key1" => 1
            ,"key2" => 2
        ],
        [
            "key1" => 3
            ,"key2" => 4
        ],
        [
            "key1" => 5
            ,"key2" => 6
        ]
    ];
    echo $result2[0]["key1"]."\n";

//-------------//

     /* #배열함수 */

     $arr4 = [5, 8, 3, 1, 4, 6];

     echo count($arr4); // 배열내 요소개수

     unset($arr4[3]); // '값' 제거, 잘안씀

     asort($arr4); // '값' 오름차순 정렬

     arsort($arr4); // '값' 내림차순 정렬

     var_dump($arr4);


     $arr5 = [
        "d" => "1"
        ,"a" => "2"
        ,"c" => "3"
        ,"b" => "4"
     ];

     ksort($arr5); // '키' 오름차순 정렬

     krsort($arr5); // '키' 내림차순 정렬

     var_dump($arr5);
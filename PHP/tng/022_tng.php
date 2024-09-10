<?php

    // IF로 만들어주세요.
    // 성적 
    // 범위 : 
    //		100   : A+
    //		90이상 100미만 : A
    //		80이상 90미만 : B
    //		70이상 80미만 : C
    //		60이상 70미만 : D
    //		60미만: F

    //출력 문구 : "당신의 점수는 XXX점 입니다. <등급>"

    $score = 5;
    $rating = "";

    if((is_numeric($score)) && ($score >= 0 && $score <= 100)){
        if($score === 100) $rating = "A+";
        elseif($score >= 90) $rating = "A";
        elseif($score >= 80) $rating = "B";
        elseif($score >= 70) $rating = "C";
        elseif($score >= 60) $rating = "D";
        else $rating = "F";
            
        echo "당신의 점수는 ".$score."점 입니다. <".$rating.">";
    } else echo "ERROR!";

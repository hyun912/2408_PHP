<?php

    /* if 조건문 */

    $num = 5;

    if($num === 10) {
        echo "10임 \n";
    } else if($num === 5) {
        echo "5임 \n";
    } else {
        echo "아무튼 정수임 \n";
    }


    // 1이면 1등, 2면 2등, 3이면 3등, 나머진 순위외, 5번만 특별상
    $rank = 5;

    if($rank === 5) echo "특별상\n";
    else if($rank === 1) echo "1등\n";
    else if($rank === 2) echo "2등\n";
    else if($rank === 3) echo "3등\n";
    else echo "순위 외\n";


    // 1번문제의 정답은 2, 2번문제의 정답은 5
    // 1번문제와 2번문제 모두 정답이면 100점,
    // 둘중 하나만 정답이면 50점
    // 모두 오답이면 0점을 출력
    
    $answer1 = 2;
    $answer2 = 5;

    if($answer1 === 2 && $answer2 === 5) echo "100점";
    else if($answer1 === 2 || $answdr2 === 5) echo "50점";
    else echo "0점";


    //-------------//
    
    //-------------//
    
    //-------------//
    
    //-------------//
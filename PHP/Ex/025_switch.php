<?php

/* #switch : 이걸 쓰느니 if로 하는게 좋다함. 잘안씀 */
    
    $food = "짬뽕";

    switch($food) {
        case "떡볶이":
            echo "한식\n";
            break; // 필수
        
        case "짜장면": case "짬뽕":
            echo "중식\n";
            break;

        case "햄버거":
            echo "양식\n";
            break;
        
        default:
            echo "어쨋든 맛있는거\n";
            break;
    }
     
    //-------------//

/* 실습 */
    
    // switch를 이용하여 작성
    // 1등이면 금상, 2등이면 은상, 3등이면 동상, 4등이면 장려상, 그 외는 노력상
    // 을 출력해 주세요.
    
    $rank = 1;

    switch($rank) {
        case 1:
            echo "금상\n";
            break;
        
        case 2: 
            echo "은상\n";
            break;

        case 3:
            echo "동상\n";
            break;

        case 4:
            echo "장려상\n";
            break;
        
        default:
            echo "노력상\n";
            break;
    }
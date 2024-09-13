<?php

/* 참조 전달 (Passing By Reference) */

    $num1 = 100;
    $num2 = $num1; // 값을 복사함

    $num2 -= 50;

    echo $num1."  ".$num2."\n"; // 100  50

    echo ("\n");

    $num3 = 100;
    $num4 = &$num3; // 변수앞에 &를 붙이면 붙인 변수의 주소를 참조하여 둘이 같이 값을 공유함

    $num4 -= 50;

    echo $num3."  ".$num4."\n"; // 50  50
    
    echo ("\n");

    function my_test(&$num){ // &붙이면 return 안해도 주소 참조이므로 처리 반영이됨
        $num--;
    }

    $num5 = 5;
    my_test($num5);
    echo $num5."\n";

    echo ("\n");

    //-------------//
/* #Scope : 변함수 유효범위 */

    // 전역 스코프 : 스크립트(영역)내에 있는걸 어디서든 가져올수있음
    $str = "전역 스코프";

    function my_scope1() {
        global $str; // 위에걸 가져옴
        echo $str."\n";
    }

    my_scope1();

    echo ("\n");

    //-------------//

    // 지역 스코프

    function my_scope2() { // 함수, 클래스, 메소드에 적용됨
        $str2 = "지역 스코프";
        echo $str2."\n";
    }

    // echo $str2; // 함수안에 있는거라서 에러남
    my_scope2();

    echo ("\n");

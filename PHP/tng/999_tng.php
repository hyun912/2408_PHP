<?php

    // 구구단 출력형식
    // *** 2~9단 ***
    // ... 

    $gugu = range(2, 9);
    $dan = range(1, 9);
    $gugudan = [];

    foreach($gugu as $item1) {
        $gugudan[] = "*** ".$item1."단 ***\n";

        foreach($dan as $item2) {
            $gugudan[] = $item1." X ".$item2." = ".($item1 * $item2)."\n";
        }
    }

    echo implode($gugudan);


    // -------------------
    // 복습 1. 함수
    // 두수 더해서 반환
    // 변수앞의 ↘타입 힌트나, 뒤에 리턴타입 ↓ 을 요새는 기재헤줌
    function sum(int $num1, int $num2): int {
        return $num1 + $num2;
    }

    echo sum(1, 3);


    // -------------------
    // 복습 2. 예외처리

    // try {
    //     // 처리할 로직
    // } catch(Throwable $th) { // 7.ver 이하는 Exception
    //     // 예외 발생시 처리
    //     echo $th->getMessage();
    // } finally {
    //     // 상관없이 실행
    // }

    // try {
    //     echo "밖 try\n";
        
    //     try {
    //         echo "안 try\n";
    //     } catch(Throwable $th) {
    //         echo "안 catch\n";
    //     }
    // } catch(Throwable $th) {
    //     echo "밖 catch\n";
    // }


    // 강제 예외
    
    try {
        throw new Exception("강제 던지기");
    } catch(Throwable $th) {
        echo $th->getMessage();
    }
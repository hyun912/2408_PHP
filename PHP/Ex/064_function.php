<?php

/* #함수 */
    /**
     * 두 수의 합
     * @param int $num1 숫자
    */
    function my_sum($num1, $num2) {
        return $num1 + $num2; 
    }

    // 호출
    echo my_sum(5, 6)."\n";
    
    echo ("\n");

    //-------------//
/* #실습 */

    //두수를 받아서 +, -, *, /, %의 결과를 리턴하는 함수를 만들어 주세요.
    function juno($num1, $num2) {
        return $num1 + $num2." | "
              .$num1 - $num2." | "
              .$num1 * $num2." | "
              .round($num1 / $num2, 2)." | "
              .$num1 % $num2;
    }

    echo juno(8, 3)."\n";

    echo ("\n");

    //-------------//
/* #가변길이 아규먼트 */

    // 전달되는 모든 숫자를 더함
    function my_sum_all(...$numbers) { // 한무 담을수있음, 5.6 이상
        // $sum = 0;

        // foreach($numbers as $int) {
        //     $sum += $int;
        // }

        // return $sum;
        return array_sum($numbers);
    }

    // 5.5 이하
    // function my_sum_all() {
    //     $numbers = func_get_args();
    //     return array_sum($numbers);
    // }

    echo my_sum_all(1,2,4,8,16,32,64,128,256,512)."\n";
    
    echo ("\n");

    //-------------//
    //-------------//
    //-------------//
    //-------------//
    //-------------//
    //-------------//
    //-------------//
    //-------------//
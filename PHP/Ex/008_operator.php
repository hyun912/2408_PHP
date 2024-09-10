<?php

    /* #대입 연산자(=) */

    $num1 = 10; // 값을 변수에 대입
    $num2 = 5;

    // + - * / %
    echo $num1 + $num2 . "\n"; // 덧셈
    echo $num1 - $num2 . "\n"; // 뺄셈
    echo $num1 * $num2 . "\n"; // 곱셈
    echo $num1 / $num2 . "\n"; // 나눗셈
    echo $num1 % $num2 . "\n"; // 나머지
    
//-------------//

    /* #산술 대입 연산자 */

    $tmp1 = 0;
    $tmp1 = $tmp1 + 5;
    $tmp1 += 5; // 위를 생략

    $str1 = "He";
    $str1 .= "llo";


    /* 실습 */

    // 산술 대입 연산자만 이용
    $tng_num = 100;

    // $tng_num에 10을 더해주세요.
    $tng_num += 10;

    // $tng_num에 5로 나누어주세요.
    $tng_num /= 5;

    // $tng_num에 4를 빼주세요.
    $tng_num -= 4;

    // $tng_num를 7로 나눈 나머지를 구해주세요.
    $tng_num %= 7;

    // $tng_num에 3을 곱해주세요.
    $tng_num *= 3;

    echo $tng_num . "\n";

//-------------//

    /* 증감 연산자 */

    $num = 0;
    $num++; // 후위 증감
    echo $num."\n";
    echo $num++."\n"; // 다끝마쳐야 증감처리됨

    $num = 0;
    ++$num; // 전위 증감
    echo $num."\n";
    echo ++$num."\n"; // 먼저 계산하고 처리함
    
//-------------//

    /* 비교 연산자 */

    var_dump(1 > 0); // 크냐?
    var_dump(1 < 0); // 작냐?
    var_dump(1 >= 0); // 같거나 크냐?
    var_dump(1 <= 0); // 같거나 작냐?

    $num = 1;
    $str = "1";

    var_dump($num == $str); // 단순비교, 타입체크 X
    var_dump($num === $str); // 완전비교, 타입체크 O, 왠만하면 이걸로
    var_dump($num != $str); // 같지않는가
    var_dump($num !== $str); // 완전같지않는가

//-------------//

    /* 논리 연산자 : AND, OR , NOT */

    var_dump(1 === 1 && 2 === 1);
    var_dump(1 === 1 || 2 === 1);
    var_dump(!(2 === 1));


//-------------//

    /* 삼항 연산자 */

    $result = 1 === 1 ? "참" : "거짓";
    var_dump($result);

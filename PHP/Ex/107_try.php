<?php

    try { // 예외, 에러가 발생할 가능성이 있는 소스코드 작성
        echo "try start;\n";
        // 5 / 0;
        echo "try end;\n";
    } catch(Throwable $th) { // 위에서 이상이 발생할시 실행
        echo "님 에러남;\n";
    } finally { // 에러가 나든 안나는 무조건 실행
                // 앞의 상황에 헤야될 처리가 있을때 사용
        echo "finally\n";
    }


    echo "처리 종료";
<?php

/*
    #로또 생성기
    1 ~ 45 번호
    랜덤 6개 출력
    중복 불가능
*/

    function lotto() {
        // 1 ~ 45 숫자담은 배열 선언
        $nums = range(1, 45);
        
        // 랜덤 6개를 돌려서 담은걸 리턴
        // 이때 array_rand가 key를 선택헤서 담으므로 array_flip으로 key와 value를 뒤바꿔줌
        return array_rand(array_flip($nums), 6);
    }

    // 안에 있는 6개의 숫자를 차레대로 출력
    echo implode("  ", lotto()); // 공백을 사이로 배열을 문자열로 출력


    // echo implode("  ", array_rand(array_flip(range(1, 45)), 6));

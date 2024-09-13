<?php

/* 내장함수 */

/* #좌우 공백제거 */
    $str = "  미야옹  ";
    
    echo trim($str)."\n";
    
    echo ("\n");

    //-------------//

/* #대소문자 변환 */
    $str2 = "AbcDe";

    echo strtoupper($str2)."\n"; // 대문자로 변환 

    echo strtolower($str2)."\n"; // 소문자로 변환
    
    echo ("\n");

    //-------------//

/* #문자길이 구하기 */
    $str3 = "우야옹";

    echo strlen($str3)."\n"; // byte단위 길이반환, 쓰지마셈

    echo mb_strlen($str3)."\n"; // 단순 문자길이 반환, **위에거보다 이걸 많이씀
    
    echo ("\n");

    //-------------//

/* #특정 문자 바꾸기 */
    $str4 = "key: asdas123lkenq;lnr;qlwn;qlwkr";

    echo str_replace("key: ", "", $str4)."\n"; // (바꿀 문자, 바뀔 문자, 대상 문자)
    
    echo ("\n");

    //-------------//

/* #단순 문자 반복 */
    
    echo str_repeat("*", 3)."\n"; // (반복 문자, 반복 횟수)
    
    echo ("\n");

    //-------------//

/* #문자 자르기 */
    $str5 = "this is PHP";

    echo mb_substr($str5, 0, 4)."\n"; // (대상 문자, 자를 개수, 그뒤에 출력 개수)

    echo mb_substr($str5, -3, 3)."\n"; // 두번째값이 음수면 왼쪽으로 카운트, 양수는 오른쪽
    
    echo ("\n");

    //-------------//

/* #검색 문자 위치 반환 */
    $str6 = "좀심 모목쥐?";

    echo mb_strpos($str6, "목")."\n"; // 왼쪽부터 검색헤서 해당문자 시작위치 가져옴

    //"모"부터 3글자
    echo mb_substr($str6, mb_strpos($str6, "모"), 3)."\n";
    
    echo ("\n");

    //-------------//

/* #순차대입 */
    $str_format = "당신의 점수는 %d입니다. <%s>";

    echo sprintf($str_format, 2, "A")."\n"; // 설정한 포맷문자열에 순차적으로 대입, **생각보다 많이씀
                                            // (포맷문자, 대입문자1, 대입문자2 …)
    
    echo ("\n");

    //-------------//

/* #변수 확인 */
    $str7 = "";
    $str8 = null;

    // 값이 있으면 true, 없으면 false **굉장히 많이씀
    var_dump(isset($str7));
    var_dump(isset($str8));
    var_dump(isset($non));
    
    echo ("\n");

    //-------------//

/* #값이 비어있는지 확인 */
    $empty1 = "abc";
    $empty2 = "";
    $empty3 = 0;
    $empty4 = [];
    $empty5 = null;
    
    var_dump(empty($empty1)); // 이것만 있으니 false
    var_dump(empty($empty2));
    var_dump(empty($empty3));
    var_dump(empty($empty4));
    var_dump(empty($empty5));
    
    echo ("\n");

    //-------------//

/* #null 확인 */
    $chk_null = null;

    var_dump(is_null($chk_null));
    
    echo ("\n");

    //-------------//

/* #타입 체크용 */
    $type1 = "abc";
    $type2 = 0;
    $type3 = 1.2;
    $type4 = [];
    $type5 = true;
    $type6 = null;
    $type7 = new DateTime();

    echo gettype($type1)."\n";
    echo gettype($type2)."\n";
    echo gettype($type3)."\n";
    echo gettype($type4)."\n";
    echo gettype($type5)."\n";
    echo gettype($type6)."\n";
    echo gettype($type7)."\n";
    
    echo ("\n");

    //-------------//
/* #타입 변환  */
    $type8 = "1";

    // (int)$type8 // 원본 변경안하고 바꿈
    settype($type8, "int"); // 원본 변환

    var_dump($type8)."\n";
    
    echo ("\n");
    
    //-------------//
/* #현재시간(UTC 1970-01-01 기준, 초단위) */

    echo time()."\n";
    
    echo ("\n");

    //-------------//
/* 시간 포맷반환 */

    echo date("Y-m-d H:i:s", time())."\n";
    
    echo ("\n");

    //-------------//
/* 정수 올림, 반올림, 버림 */

    echo ceil(1.2)."\n";
    echo round(1.2)."\n";
    echo floor(1.2)."\n";
    
    echo ("\n");

    //-------------//
/* 숫자 배열 만들기 */
    $arrs = range(1, 45); // 1 ~ 45 배열

    print_r($arrs); // 배열전용 출력

    echo ("\n");

    //-------------//
/* 랜덤 돌리기, 재미용 */

    echo random_int(1, 10)."\n"; // (시작, 끝)
    


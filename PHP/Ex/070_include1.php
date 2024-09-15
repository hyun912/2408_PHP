<?php
/* #불러오기 */
    
    // include
    
    // include("./070_include2.php"); // 불러오기, 그냥 인클루드는 잘안씀
    // include_once("./070_include2.php"); // 여러줄 같은 파일을 중복실행헤도 한번만 불러옴, 이걸주로씀
    // 공통적 단점으로 불러온 파일에서 에러발생헤도 그냥 실행헤버림


    // require
    // require("./070_include2.php"); // 기본적으론 인클루드와 같음
    require_once("070_include2.php"); // 다른점이라면 파일에서 에러발생하면 멈춤 **위에거 아니면 이거씀 (_once만)

    
    //-------------//


    echo "include 1111 \n";

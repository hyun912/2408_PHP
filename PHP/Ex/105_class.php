<?php

    /* 
        **OOP | 객체지향 프로그래밍 | 오브젝트 오리엔티드 프로그래밍 
    
        -하드웨어의 빠른 발전 속도에 비해 소프트웨어의 개발 시간이 따라가지 못하게 되어,
            소프트웨어의 개발 시간을 단축시기키 위해 탄생
        -프로그래밍에서 필요한 데이터를 추상화시켜서 속성(어트리뷰트)와 행위(메서드)를 가진 객체로 만들고,
            그 객체간의 상호 작용을 통해 로직을 구성하는 방법

        -장점
            다른 클래스를 가져와 사용할 수 있고, 상속받을 수 있어 코드의 재사용성 증가
            자주 사용되는 로직을 라이브러리로 만들어두면 계속해서 사용할 수 있어 신뢰성을 확보 가능
            클래스 단위로 모듈화가 가능하여, JAVA같은 대형 프로젝트에 적합. 중소규모는 PHP
            객체 단위로 코드가 나눠져 작성되기 때문에 디버깅이 쉽고 유지보수가 용이함.

        -단점
            처리 속도가 상대적으로 느림
            객체가 많으면 용량이 커짐
            설계 시 많은 노오오오오력과 시간이 필요
    */

    require_once ("./Whale.php");
    require_once ("./Shark.php");

    // 인스턴스화
    $whale = new Whale();

    // 클래스내 메소드 사용
    $whale->breath();

    // 프로퍼티에 접근
    echo $whale->name."\n";
    // echo $whale->age; // Whale 클래스 내부가 아니라서 접근불가 
    
    echo $whale->info()."\n";

    // 스태틱 맴버에 접근
    Whale::myStatic();

    // 상어파일 접근
    $shark = new Shark("상어");
    echo $shark->name;
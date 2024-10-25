<?php

  class Whale {
    /* #프로퍼티*/
    // 접근 제어 지시자
    public $name = "고뤠"; // 클래스 내/외부 어디서든 접근 가능

    private $age = 30; // 클래스 내에서만 접근 가능

    protected $gender; // 클래스 내부와 상속관계 접근 가능 (외부 X)


    // 메소드 : 클래스 안에있는 함수들
    function breath() {
      echo "숨쉼\n";
    }

    function info() {
      // $this : 클래스 내 프로퍼티나 메소드에 접근하기위해 사용,즉 클래스 자신
      echo "나이는".$this->age;
    }

    public static function myStatic() { // static 쓰면 인스턴스화 안하고 바로 쓸수있음
      // 메모리에 바로 올라가서 리소스 관리가 어려우니 꼭 자주쓸것만 사용함
      echo "스테틱 메소드\n";
    }
  }
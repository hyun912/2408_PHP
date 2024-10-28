<?php

namespace PHP\oop;

////////////////
// 추상 클래스 //
////////////////
abstract class Mammal {
  private $name;
  private $residence;

  // 생성자
  public function __construct($name, $residence) {
    $this->name = $name;
    $this->residence = $residence;
  }

  // 추상 메소드: 자식한테 해달라고 강제함, 자식에 해당 함수가 없으면 에러뜸
  abstract public function printInfo();
}

// class Mammal {
//   private $name;
//   private $residence;

//   public function __construct($name, $residence) {
//     $this->name = $name;
//     $this->residence = $residence;
//   }

//   // final public function printInfo() // 앞에 final이 있으면 자식에게 상속못하도록 막음
//   public function printInfo() {
//     return $this->name . "가 " . $this->residence . "에 삽니다\n";
//   }
// }

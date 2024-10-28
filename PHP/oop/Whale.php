<?php

namespace PHP\oop;

require_once "./Mammal.php";
require_once "./Swim.php";

use PHP\oop\Mammal;
use PHP\oop\Swim;

class Whale extends Mammal implements Swim {
  public function swimming() {
    return "수영할거임\n";
  }

  public function printInfo() {
    return "구뤠";
  }
}

// class Whale {
//   public $name;
//   private $age;

//   public function __construct($name, $age) {
//     $this->name = $name;
//     $this->age = $age;
//   }

//   public function breath() {
//     echo "숨셔\n";
//   }

//   public function printInfo() {
//     return $this->name."는 ".$this->age."살 입니다.";
//   }

//   public function getAge() {
//     return $this->age;
//   }

//   public function setAge($age) {
//     $this->age = $age;
//   }

//   public static function dance() {
//     return "고래가 춤을 춥니다";
//   }
// }

// $whale->setAge(30);
// echo $whale->getAge();

// $whale = new Whale("분홍고뤠", 40);
// echo $whale->printInfo();

// echo Whale::dance();

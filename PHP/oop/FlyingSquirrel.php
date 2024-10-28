<?php

namespace PHP\oop;

require_once "./Mammal.php";
require_once "./Pet.php";

use PHP\oop\Mammal;
use PHP\oop\Pet;

class FlyingSquirrel extends Mammal implements Pet {
  public function flying() {
    return "날아간드아\n";
  }

  // 오버라이딩
  public function printInfo() {
    // return parent::printInfo() . "랄룰"; // 덮어씌워도 부모껄 부르고싶을때
    return " 랄룰";
  }

  public function printPet() {
    return " 찍찍";
  }
}

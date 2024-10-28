<?php

namespace PHP\oop;

require_once "./Swim.php";
require_once "./Pet.php";

use PHP\oop\Swim;
use PHP\oop\Pet;

class GoldFish implements Swim, Pet { // 인터페이스 사용시 extends 아닌 implements를 씀
  private $name = "금붕어";

  public function swimming() {
    return "숴엉";
  }

  public function printPet() {
    return "파닥";
  }
}

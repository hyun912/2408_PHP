<?php

class Whale {
  public $name = "구뤠";
  private $age = 30;

  public function breath() {
    echo "숨셔\n";
  }

  public function printInfo() {
    echo $this->name."는 ".$this->age."살 입니다.";
  }

  public function getAge() {
    return $this->age;
  }

  public function setAge($age) {
    $this->age = $age;
  }
}

$whale = new Whale();

$whale->setAge(30);
echo $whale->getAge();

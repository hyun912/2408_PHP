<?php

require_once "./Whale.php";
require_once "./FlyingSquirrel.php";

use PHP\oop\Whale;
use PHP\oop\FlyingSquirrel;

$whale = new Whale("고래", "바다");
echo $whale->printInfo();

$flyingSquirrel = new FlyingSquirrel("날다람쥐", "산");
echo $flyingSquirrel->printInfo();
echo $flyingSquirrel->printPet();

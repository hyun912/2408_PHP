<?php

// new 헤서 인스턴스 선언 하기전에 여기먼저 실행됨
spl_autoload_register(function($path) {
  require_once(str_replace('\\', '/', $path).'.php'); // \ 로 되있는걸 / 로 바꿔라
});
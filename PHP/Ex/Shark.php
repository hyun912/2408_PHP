<?php

    class Shark {
        public $name; // 프로퍼티, 아래거랑 다른거
        
        // 생성자 : 객체를 인스턴스화 할 때 딱 한번만 실행되는 메소드 
        public function __construct($name) {
            $this->name = $name; // 위에 퍼블릭name에 저장됨
        }

    }
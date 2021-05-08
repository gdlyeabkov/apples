<?php
    namespace app\classes;

use DateTime;

class Apple {

        public $color;
        public $size;
        
        public function __construct($color, $size = 1.0){
            $this->color = $color;
            $this->size = $size;
        }

        public function fallToGround(){
            $this->drop = true;
        }

        public function eat(int $percent){
            $percent /= 100;
            $this->size -= $percent;
        }
    }
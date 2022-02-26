<?php
    // print("こんにちは\n");
    // print('こんにちは' . PHP_EOL);
    // print 'こんにちは' . PHP_EOL;
    class User{
        public $name;
        public $age;
        
        public function __construct($name, $age){
            $this->name = $name;
            $this->age = $age;
            // print $this->name . 'さんが生まれた' . PHP_EOL;
        }
        public function drink(){
            if($this->age >= 20){
                print $this->name . 'さんお酒をお楽しみください' . PHP_EOL;
            }else{
                print $this->name . 'さん、お酒は20歳から' . PHP_EOL;
            }
        }
        public function talk($someone){
            print $this->name . 'さんが' . $someone->name . 'さんに話しかけた' . PHP_EOL; 
        }
        public function varidate(){
            $errors = array();
            if($this->name === ''){
                $errors[] = '名前が入力されていません';
            }
            if($this->age ===''){
                $errors[] = '年齢を入力してください';
            }elseif(!preg_match('/^[0-9]+$/', $this->age)){
                $errors[] = '年齢は正の整数を入力してください';
            }
            return $errors;
        }
    }
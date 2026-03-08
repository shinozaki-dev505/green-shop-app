<?php

class User{
  private $id;
  private $name;
  private $gender;
  
  //クラスプロパティ
  private static $count=0;

  public function __construct($id,$name,$gender){
    $this->id = $id;
    $this->name = $name;
    $this->gender = $gender;
    self::$count++;  // クラスプロパティ$countの値に1を足
    $this->id = self::$count;  //idプロパティにクラスプロパティ$countの値を代入
  }
  
  public function getName(){
    return $this->name;
  }
  public function getGender(){
    return $this->gender;
  }
  public function getId(){
    return $this->id;
  }

}

?>
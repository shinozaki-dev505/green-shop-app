<?php 
require_once('menu.php');


class Plant extends Menu {
private $place;

  public function __construct($id, $name, $image, $price, $type, $detail, $created_at) {
    // 親クラスのコンストラクタを呼び出す
    parent::__construct($id, $name, $image, $price, $created_at);
    $this->place = $detail;
  }
  
  public function getPlace() {
     return $this->place;
  }

  public function setPlace($place) {$this->place = $place;}

}
?>
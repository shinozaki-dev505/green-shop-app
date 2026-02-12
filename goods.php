<?php 
require_once('menu.php');

class Goods extends Menu {
  private $difficulty;
  
  public function __construct($name, $price, $image, $difficulty) {
    parent::__construct($name, $price, $image);
    $this->difficulty = $difficulty;
  }
  
  public function getDifficulty() {
    return $this->difficulty;
  }
  
}

?>
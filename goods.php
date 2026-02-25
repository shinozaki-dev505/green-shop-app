<?php 
require_once('menu.php');

class Goods extends Menu {
  private $difficulty;
  
 public function __construct($id, $name, $image, $price, $created_at) {
    // 親(Menu)のコンストラクタに5つすべてをパスする
    parent::__construct($id, $name, $image, $price, $created_at);
  }
  
  public function getDifficulty() {
    return $this->difficulty;
  }
  
}

?>
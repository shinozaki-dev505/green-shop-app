<?php 
require_once('menu.php');

class Plant extends Menu {
  private $place;
  
  public function __construct($name, $price, $image, $place) {
    parent::__construct($name, $price, $image);
    $this->place = $place;
  }
  
  public function getPlace() { return $this->place; }

  public function setPlace($place) {$this->place = $place;}

}
?>
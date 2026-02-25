<?php
class Menu {
  protected $id;      // 追加
  protected $name;
  protected $price;
  protected $image;
  protected $created_at; // 追加
  private $orderCount = 0;
  protected static $count = 0;
  
 // 引数の順番を MenuRepository の new Plant(...) と完全に合わせます
  public function __construct($id, $name, $image, $price, $created_at) {
    $this->id = $id;
    $this->name = $name;
    $this->image = $image;
    $this->price = $price;
    $this->created_at = $created_at;
    self::$count++;
  }
  
  public function hello() {
    echo '私は'.$this->name.'です';
  }
  
  public function getName() {
    return $this->name;
  }
  
  public function getImage() {
    return "images/" . $this->image;
  }
  
  public function getOrderCount() {
    return $this->orderCount;
  }
  
  public function setOrderCount($orderCount) {
    $this->orderCount = $orderCount;
  }
  
  public function getTaxIncludedPrice() {
    return floor($this->price * 1.08);
  }
  
  public function getTotalPrice() {
    return $this->getTaxIncludedPrice() * $this->orderCount;
  }
  
  // getReviewsメソッドを定義
  public function getReviews($reviews){
    $reviewsForMenu = array();
    foreach ($reviews as $review){
      if($review->getMenuName() == $this->name){
        $reviewsForMenu[] = $review;
      }
    }
    return $reviewsForMenu;
  } 
  
  
  public static function getCount() {
    return self::$count;
  }
  
  public static function findByName($menus, $name) {
    foreach ($menus as $menu) {
      if ($menu->getName() == $name) {
        return $menu;
      }
    }
  }
  
  public function getId() {
    return $this->id;
  }
}
?>
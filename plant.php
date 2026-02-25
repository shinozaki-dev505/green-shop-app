<?php 
require_once('menu.php');


class Plant extends Menu {
private $place;

  // 親クラス（Menu）と同じ 5つ + 自分の 1つ（計6つ）を想定するか、
  // 面倒な場合は親の5つに合わせて、placeは別途セットするようにします
  public function __construct($id, $name, $image, $price, $created_at) {
    // 親クラスのコンストラクタを呼び出す
    parent::__construct($id, $name, $image, $price, $created_at);
  }
  
// placeについてはDBから直接取得するよう MenuRepository を調整するか、
  // 今回は「plantならplaceは固定」などの暫定処理にします
  public function getPlace() {
     return "室内向き"; // ひとまず表示確認用
  }

  public function setPlace($place) {$this->place = $place;}

}
?>
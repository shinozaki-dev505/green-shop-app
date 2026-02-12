<?php
class Review {
  private $menuName;
  private $body;
  private $userId;  //ユーザId

  public function __construct($menuName, $userId, $body) {
    $this->menuName = $menuName;
    $this->userId = $userId;
    $this->body = $body;
  }

  public function getMenuName() {
    return $this->menuName;
  }

  public function getBody() {
    return $this->body;
  }

  public function getUser($users){
    foreach($users as $user){
      if($this->userId == $user->getId()){
        return $user;
      }
    }
  }
}

?>
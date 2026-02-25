<?php
require_once('user.php');
require_once('review.php');

// ユーザーデータ（そのまま残す）
$user1 = new User(1,'suzuki', 'male');
$user2 = new User(2,'tanaka', 'female');
$user3 = new User(3,'suzuki', 'female');
$users = array($user1, $user2,$user3);

// レビューデータ（ここも残す。ただし、第一引数はメニューの「名前」であること）
$review1 = new Review('モンステラ', 1, 'とても元気な株が届きました！'); // 1番のsuzukiさん
$review2 = new Review('サボテン', 2, 'サイズ感がちょうどいいです。'); // 2番のtanakaさん
$review3 = new Review('モンステラ', 3, '葉っぱが大きくてびっくり。');    // 3番のsuzuki(女性)さん
$reviews = array($review1, $review2,$review3);

// ※重要：$menus = ... や PlantRepository などの記述があれば削除
?>
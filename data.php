<?php
require_once('plant.php');
require_once('goods.php');
require_once('review.php');
require_once('user.php');

// Plant(名前, 価格, 画像, 置き場所)
$monstera = new Plant('モンステラ', 3500, 'images/monstera.jpg', '屋内用');
$cactus = new Plant('サボテン', 1200, 'images/cactus.jpg', '日向用');

// Goods(名前, 価格, 画像, おすすめ度1-3)
$pot = new Goods('素焼きの鉢', 800, 'images/pot.jpg', 1);
$fertilizer = new Goods('有機肥料', 1500, 'images/fertilizer.jpg', 3);

$menus = array($monstera, $cactus, $pot, $fertilizer);

//ユーザー
$user1 = new User('suzuki','male');
$user2 = new User('tanaka','female');
$user3 = new User('suzuki', 'female');
$user4 = new User('sato', 'male');
$users=array($user1,$user2,$user3,$user4);


// レビューもショップに合わせて変更
$review1 = new Review($monstera->getName(), $user1->getId(),'葉の形がとても綺麗で、部屋が明るくなりました！');
$review2 = new Review($cactus->getName(),$user2->getId(),'サボテンを屋外で育てるには、日当たりの良い場所を選び、水はけの良い土を使用し、季節ごとの管理に注意することが重要です。');
$review3 = new Review($pot->getName(),$user1->getId(),'素焼き鉢は通気性、排水性、吸水性に優れており、根腐れを防ぎ、植物の成長を促進します。');
$review4 = new Review($fertilizer->getName(),$user2->getId(),'有機肥料は、土壌の健康を保ちながら植物の成長を促進し、環境に優しい選択肢です。');
$review5 = new Review($monstera->getName(), $user2->getId(),'モンステラの水やりは「土の表面が白く乾いてから、鉢底から流れるくらいタップリと」が基本です。');
$review6 = new Review($monstera->getName(), $user3->getId(),'モンステラは最高です。');
$review7 = new Review($fertilizer->getName(),$user4->getId(),'この有機肥料はおすすめです');
$reviews = array($review1,$review2,$review3,$review4,$review5,$review6,$review7);


?>
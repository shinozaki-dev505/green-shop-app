<?php 
// data.php（配列）の代わりにリポジトリを読み込む
require_once('MenuRepository.php');

$menuRepository = new MenuRepository();
// 最新順ですべて取得
$menus = $menuRepository->findAll();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Green Plant Shop</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="menu-wrapper container">
  <h1 class="logo">Green Plant Shop</h1>
  <h3>メニュー<?php echo count($menus) ?>品</h3>
  
  <form method="post" action="confirm.php">
    <div class="menu-items">
      <?php foreach ($menus as $menu): ?>
        <div class="menu-item">
          
          <div class="delete-container">
            <a href="delete.php?id=<?php echo $menu->getId() ?>" 
               class="delete-btn-small" 
               onclick="return confirm('本当に削除しますか？')">🗑️</a>
          </div>

          <img src="<?php echo $menu->getImage() ?>" class="menu-item-image">
          
          <h3 class="menu-item-name">
            <a href="show.php?id=<?php echo $menu->getId() ?>">
              <?php echo $menu->getName() ?>
            </a>
          </h3>

          <?php if ($menu instanceof Plant): ?>
            <p class="menu-item-type"><?php echo $menu->getPlace() ?></p>
          <?php else: ?>
            <p class="menu-item-type">園芸用品</p>
          <?php endif ?>
          
          <p class="price">¥<?php echo $menu->getTaxIncludedPrice() ?>（税込）</p>

          <div class="input-area">
            <input type="text" value="0" name="<?php echo $menu->getName() ?>">
            <span>個</span>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    
    <div class="submit-area">
      <input type="submit" value="注文する" class="submit-btn">
    </div>
  </form> 
</div>
</body>
</html>
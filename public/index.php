<?php 
session_start();
require_once __DIR__ . '/../src/MenuRepository.php';

$menuRepository = new MenuRepository();
$menus = $menuRepository->findAll();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Green Plant Shop</title>
  <link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="menu-header container">
  <h2>管理メニュー</h2>
  <?php if(isset($_SESSION['user_id'])): ?>
    <a href="sales/sales.php" class="btn-sales">📋 売上明細を見る</a>
    <a href="sales/ranking.php" class="btn-ranking">🏆 売れ筋ランキング</a>
    <a href="../auth/register.php" class="btn register-btn">新規ユーザー登録</a>

      <?php if($_SESSION['role']==='admin'):?>
        <a href="products/new.php" class="btn-new" >+ 新規商品を登録する</a>
      <?php endif; ?>

    <a href="../auth/logout.php">ログアウト</a>
  <?php else: ?>
    <a href="../auth/login.php">管理者ログイン</a>
  <?php endif; ?>    
</div>

<div class="menu-wrapper container">
  <h1 class="logo">Green Plant Shop</h1>
  
  <?php if (isset($_SESSION['user_id'])): ?>
    <p style="text-align: right; font-size: 0.8em; color: #666;">
        ログイン中：<?php echo htmlspecialchars($_SESSION['user_name'],ENT_QUOTES,'UTF-8'); ?>さん
        (<?php echo $_SESSION['role']==='admin' ? '管理者' : '一般ユーザー';?>)
      </p>
  <?php endif; ?>

  <h3>メニュー<?php echo count($menus) ?>品</h3>
  
  <form method="post" action="products/confirm.php" onsubmit="return confirm('この内容で注文してもよろしいですか？');">
    <div class="menu-items">
      <?php foreach ($menus as $menu): ?>
        <div class="menu-item">
          <?php if(isset($_SESSION['role']) && $_SESSION['role']==='admin'): ?>
            <div class="delete-container">  
              <a href="products/delete.php?id=<?php echo $menu->getId() ?>" 
                class="delete-btn-small" 
                onclick="return confirm('本当に削除しますか？')">🗑️</a>
            </div>
          <?php endif; ?>

          <img src="images/<?php echo $menu->getImage() ?>" class="menu-item-image">
          
          <h3 class="menu-item-name">
            <a href="products/show.php?id=<?php echo $menu->getId() ?>">
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
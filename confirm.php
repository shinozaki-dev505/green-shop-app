<?php require_once('Menu.php') ?>
<?php require_once('MenuRepository.php') ?>

<?php 
// 1. リポジトリを読み込む
require_once('MenuRepository.php');

// 2. インスタンスを作って、DBからデータを取得する
$menuRepository = new MenuRepository();
$menus = $menuRepository->findAll(); // ここで「$menus」という箱にデータを入れています

// 3. (オプション) 注文個数をセットするロジック
foreach ($menus as $menu) {
  $orderCount = $_POST[$menu->getName()];
  $menu->setOrderCount($orderCount);
}
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
  <div class="order-wrapper">
    <h2>注文内容確認</h2>
    <?php $totalPayment = 0 ?>
    
    <?php foreach ($menus as $menu): ?>
      <?php 
        $inputOrderCount = $_POST[$menu->getName()];
        $menu->setOrderCount($inputOrderCount);
        $totalPayment += $menu->getTotalPrice();
      ?>
      <p class="order-amount">
        <?php echo $menu->getName() ?>
        x
        <?php echo $menu->getOrderCount() ?>
        個
      </p>
      <p class="order-price"><?php echo $menu->getTotalPrice() ?>円</p>
    <?php endforeach ?>
    <h3>合計金額: <?php echo $totalPayment ?>円</h3>
  </div>
</body>
</html>
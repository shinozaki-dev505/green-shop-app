<?php 
require_once __DIR__ . '/../../src/Menu.php';
require_once __DIR__ . '/../../src/MenuRepository.php';
require_once __DIR__ . '/../../src/OrderRepository.php';

// 1. データの準備
$menuRepository = new MenuRepository();
$orderRepository = new OrderRepository();
$menus = $menuRepository->findAll();

// 2. DB保存ロジック（注文があった商品のみ保存）
foreach($menus as $menu) {
    $count = $_POST[$menu->getName()];
    if($count > 0) {
        $totalPrice = $menu->getTaxIncludedPrice() * $count;
        $orderRepository->insert(
            $menu->getId(),
            $count,
            $totalPrice
        );
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Green Plant Shop - 注文完了</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/stylesheet.css">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="confirm-container">
        <div class="receipt-card">
            <h1 class="receipt-logo">Green Plant Shop</h1>
            <h2 class="receipt-title">Order Confirmation</h2>
            <p class="receipt-msg">ご注文ありがとうございます！</p>
            
            <div class="item-list">
                <?php $totalPayment = 0; ?>
                <?php foreach ($menus as $menu): ?>
                    <?php 
                        $count = $_POST[$menu->getName()];
                        // 注文個数が0の商品は表示しない
                        if ($count <= 0) continue; 
                        
                        $menu->setOrderCount($count);
                        $totalPayment += $menu->getTotalPrice();
                    ?>
                    <div class="item-row">
                        <span class="item-name"><?php echo $menu->getName() ?></span>
                        <span class="item-qty">× <?php echo $count ?></span>
                        <span class="item-subtotal"><?php echo $menu->getTotalPrice() ?>円</span>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="total-row">
                <span>合計金額（税込）</span>
                <span class="total-price"><?php echo $totalPayment ?>円</span>
            </div>
            
            <div class="action-area">
                <p class="db-msg">※売上データが正常に記録されました。</p>
                <a href="../index.php" class="btn-return">ショップトップに戻る</a>
            </div>
        </div>
    </div>
</body>
</html>
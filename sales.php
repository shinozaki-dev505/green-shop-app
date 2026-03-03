<?php
session_start();
//管理者チェック
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

require_once('OrderRepository.php');
$orderRepository = new OrderRepository();
$sales = $orderRepository->findAllwithName();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>売上明細 - Green Plant Shop</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <div class="container">
            <h2>売上明細一覧</h2>
            <form action="sales.php" method="get" style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <input type="date" name="search_date" 
                    value="<?php echo $_GET['search_date'] ?? '' ?>" 
                    style="padding: 8px; width: 200px; border: 1px solid #ccc; border-radius: 4px;">
                
                <button type="submit" style="padding: 8px 15px; cursor: pointer;">この日の売上を表示</button>
                <a href="sales.php" style="text-decoration: none; color: #666; font-size: 0.9em;">全期間表示</a>
            </form>
            <?php
            // 日付指定があれば絞り込み、なければ全件取得
            $searchDate = $_GET['search_date'] ?? null;
            if ($searchDate) {
                $sales = $orderRepository->findByDate($searchDate);
            } else {
                $sales = $orderRepository->findAllwithName();
            }
            ?>
            <table border="1" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f4f4f4;">
                        <th>注文日時</th>
                        <th>商品名</th>
                        <th>個数</th>
                        <th>合計金額</th>
                        <th>操作</th> </tr>
                    </tr>                         
                </thead>
                <tbody>
                    <?php foreach($sales as $sale):?>
                        <tr>
                            <td><?php echo $sale['ordered_at'] ?></td>
                            <td><?php echo $sale['menu_name'] ?></td>
                            <td><?php echo $sale['quantity'] ?></td>
                            <td>¥<?php echo number_format($sale['total_price']) ?></td>
                            <td>
                                <?php if(isset($_SESSION['role']) && $_SESSION['role']==='admin'): ?>
                                    <form action="delete_order.php" method="post" onsubmit="return confirm('この注文を削除してもよろしいですか？');">
                                        <input type="hidden" name="id" value="<?php echo $sale['id']; ?>">
                                        <button type="submit" style="color: red;">削除</button>
                                    </form>                                
                                <?php else:?>
                                    <span style="color: #ccc;">閲覧のみ</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <?php
                    $totalAmount = $orderRepository->getTotalSaleAmount();
                ?>
                <div class="sales-summary" style="margin-top:20px; font-size:1.2em; font-weight:bold;">
                    総売上額：￥<?php echo number_format($totalAmount)?>
                </div>
                
                <p><a href="index.php">一覧に戻る</a></p>
        </div>
    </body>
</html>
<?php
session_start();
require_once __DIR__ . '/../../src/OrderRepository.php';

$orderRepository = new OrderRepository();
$ranking = $orderRepository->getRanking();

?>
<div class="container">
    <h2>🏆 売れ筋ランキング</h2>
     <p><a href="../index.php">一覧に戻る</a></p>
    <table border="1" style="width:100%; boeder-collapse: collapse;">
        <thead>
            <tr style="background: #e1f5fe;">
                <th>順位</th>
                <th>商品名</th>
                <th>累積販売数</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank=1;
            foreach($ranking as $item):
            ?>
                <tr>
                    <td><?php echo $rank++; ?>位</td>
                    <td><?php echo $item['name'];?></td>
                    <td><?php echo $item['total_quantity'];?></td>
                </tr>
            <?php endforeach; ?>    
        </tbody>
    </table>
</div>
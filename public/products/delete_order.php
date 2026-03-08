<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role']!=='admin') { 
    die("エラー：売上データの削除権限がありません。");    
} // 管理者チェック

require_once __DIR__ . '/../../src/OrderRepository.php';
$orderRepository = new OrderRepository();

if (isset($_POST['id'])) {
    $orderRepository->delete($_POST['id']);
}

header('Location: ../sales/sales.php'); // 削除したら一覧に戻る
exit;
?>
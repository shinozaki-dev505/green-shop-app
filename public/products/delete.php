<?php
session_start();
//管理者でない場合は処理を中断する
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')  {
    die("エラー：削除する権限がありません。");
}

require_once __DIR__ .'/../../src/MenuRepository.php';

// URLの「?id=数字」からIDを受け取る
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $menuRepository = new MenuRepository();
    $menuRepository->delete($id);
}

// 削除後、一覧に戻る
header('Location: ../index.php');
exit;
?>
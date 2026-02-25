<?php
require_once('MenuRepository.php');

// URLの「?id=数字」からIDを受け取る
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $menuRepository = new MenuRepository();
    $menuRepository->delete($id);
}

// 削除後、一覧に戻る
header('Location: index.php');
exit;
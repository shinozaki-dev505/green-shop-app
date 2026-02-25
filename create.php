<?php
require_once('data.php');
require_once('menu.php');

// 1. フォームデータの受け取り
$name  = $_POST['name'];
$price = $_POST['price'];
$type  = $_POST['type'];

// 2. 画像のアップロード準備
$image      = $_FILES['image']['name'];
$image_temp = $_FILES['image']['tmp_name'];

// 3. 画像の移動（成功した時だけDB保存へ進む）
if (move_uploaded_file($image_temp, 'images/' . $image)) {
    // 4. データベースへの保存
    require_once('MenuRepository.php');
    $menuRepository = new MenuRepository();
    $menuRepository->insert($name, $price, $image, $type);
    
    // 5. 成功したら一覧へ
    header('Location: index.php');
    exit;
} else {
    // 失敗した時だけエラーを表示
    die("画像のアップロードに失敗しました。フォルダの権限などを確認してください。");
}
?>
<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: ../auth/login.php');
    exit;
}

require_once __DIR__ . '/../../src/MenuRepository.php';
require_once __DIR__ . '/../../src/data.php';
require_once __DIR__ . '/../../src/Menu.php';
require_once __DIR__ . '/../../src/Plant.php'; 
require_once __DIR__ . '/../../src/Goods.php';

// 1. フォームデータの受け取り
$name  = $_POST['name'];
$price = $_POST['price'];
$type  = $_POST['type'];


// 【追加】種別によって詳細情報を切り替えて取得
if($type == 'plant'){
    $detail = $_POST['detail_plant']; //屋内・屋外
}else {
    $detail = $_POST['detail_goods']; // おすすめ度(1〜3)
}

// 2. 画像のアップロード準備
$image      = $_FILES['image']['name'];
$image_temp = $_FILES['image']['tmp_name'];

// 3. 画像の移動（成功した時だけDB保存へ進む）
$upload_dir ='../images/';
$upload_path = $upload_dir . $image;

// imagesフォルダが存在するか念のため確認（なければ作成）
if(!is_dir($upload_dir)){
    mkdir($upload_dir,0777,true);
}

if (move_uploaded_file($image_temp, $upload_path)) {
    // 4. データベースへの保存
    $menuRepository = new MenuRepository();

    // DBには「ファイル名のみ」を保存（表示側のファイルでパスを付与するため）
    $db_image_path = $image;

    // 【重要】引数に $detail を追加
    $menuRepository->insert($name, $price, $db_image_path, $type, $detail);
    
    // 5. 成功したら一覧へ
    header('Location: ../index.php');
    exit;
} else {
    // 失敗した時だけエラーを表示
    die("画像のアップロードに失敗しました。移動先：".$upload_path);
}
?>
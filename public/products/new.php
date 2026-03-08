<?php
session_start();
if(!isset($_SESSION['user_id'])){
    //ログインしていなければログイン画面へ強制送還
    header('Location: ../../auth/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Green Plant SHop - 新規登録</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/stylesheet.css">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="new-wrapper">
    <h2 class="section-title">新しい商品を登録する</h2>
    
    <form action="store.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('この内容で登録してもよろしいですか？');">
        <div class="form-item">
            <p>名前</p>
            <input type="text" name="name" required>
        </div>

        <div class="form-item">
            <p>価格</p>
            <input type="number" name="price" required>
        </div>

        <div class="form-item">
            <p>画像ファイル名</p>
            <input type="file" name="image" accept="image/*" required>
        </div>

        <div class="form-item">
            <p>商品の種類</p>
            <select name="type" id="type-select" onchange="toggleInputs()">
                <option value="plant">植物</option>
                <option value="goods">園芸用品</option>
            </select>
        </div>

        <div id="plant-inputs" class="form-item">
            <p>置き場所（屋内・屋外）</p>
            <select name="detail_plant">
                <option value="屋内">屋内向き</option>
                <option value="屋外">屋外向き</option>
            </select>
        </div>

        <div id="goods-inputs" class="form-item" style="display:none;">
            <p>おすすめ度（1〜3）</p>
            <select name="detail_goods">
                <option value="1">★☆☆ (初心者向け)</option>
                <option value="2">★★☆ (中級者向け)</option>
                <option value="3">★★★ (上級者向け)</option>
            </select>
        </div>

        <br>
        <input type="submit" value="登録する">
    </form>

    <script>
    function toggleInputs() {
        // 1. 選択された「種類」の現在の値を取得
        const type = document.getElementById('type-select').value;
        
        // 2. 切り替える対象の各エリアを取得
        const plantDiv = document.getElementById('plant-inputs');
        const goodsDiv = document.getElementById('goods-inputs');

        // 3. 値に応じて表示・非表示をスイッチ
        if (type === 'plant') {
            plantDiv.style.display = 'block'; // 表示
            goodsDiv.style.display = 'none';  // 非表示
        } else {
            plantDiv.style.display = 'none';  // 非表示
            goodsDiv.style.display = 'block'; // 表示
        }
    }
    </script>
    
    <a href="../index.php" class="back-link">← 一覧へ戻る</a>
  </div>
</body>
</html>
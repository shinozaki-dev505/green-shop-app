<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Green Plant SHop - 新規登録</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="new-wrapper">
    <h2 class="section-title">新しい商品を登録する</h2>
    
    <form action="create.php" method="post" enctype="multipart/form-data">
      
      <div class="form-item">
        <p>商品名</p>
        <input type="text" name="name" required>
      </div>
      
      <div class="form-item">
        <p>価格（税抜）</p>
        <input type="number" name="price" required>
      </div>
      
      <div class="form-item">
        <p>画像</p>
        <input type="file" name="image" accept="image/*" required>
      </div>
      
      <div class="form-item">
        <p>商品の種類</p>
        <select name="type">
          <option value="plant">植物（室内向き/屋外向き）</option>
          <option value="item">道具（難易度など）</option>
        </select>
      </div>

      <input type="submit" value="登録する" class="submit-btn">
    </form>
    
    <a href="index.php" class="back-link">← 一覧へ戻る</a>
  </div>
</body>
</html>
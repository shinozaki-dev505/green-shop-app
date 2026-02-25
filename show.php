<?php
require_once('MenuRepository.php');
require_once('data.php');

// 1. URLから「id」を受け取る
$id = $_GET['id'];

// 2. リポジトリを使って、DBから1件だけ商品を取得する
$menuRepository = new MenuRepository();
$menu = $menuRepository->findById($id);

// 3. 商品が見つからなかった場合の安全策
if (!$menu) {
    header('Location: index.php');
    exit;
}

// 4. その商品のレビューを取得する
$menuReviews = $menu->getReviews($reviews); // data.phpで定義されている $reviews を使う

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Green Plant Shop</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="review-wrapper">
    <div class="review-menu-item">
      <img src="<?php echo $menu->getImage() ?>" class="menu-item-image">
      <h3 class="menu-item-name"><?php echo $menu->getName() ?></h3>
  
      <?php if ($menu instanceof Plant): ?>
        <p class="menu-item-type"><?php echo $menu->getPlace() ?></p>
      <?php else: ?>
        <?php for ($i = 0; $i < $menu->getDifficulty(); $i++): ?>
          <img src="images/leaf.jpg" class='icon-leaf'>
        <?php endfor ?>
      <?php endif ?>
      <p class="price">¥<?php echo $menu->getTaxIncludedPrice() ?></p>
    </div>
    
    <div class="review-list-wrapper">
      <div class="review-list">
        <div class="review-list-title">
          <img src="images/review.png" class='icon-review'>
          <h4>レビュー一覧</h4>
        </div>
        <?php foreach($menuReviews as $review): ?>
          <?php $user= $review->getUser($users) ?>
          <div class="review-list-item">
            <div class="review-user">
              <?php if($user): // $user が見つかった場合のみ性別判定をする ?>
                  <?php if($user->getGender() == 'male'): ?>
                    <img src="images/male.png" class='icon-user'>
                  <?php else: ?>
                    <img src="images/female.png" class='icon-user'>
                  <?php endif ?>              
                  <p><?php echo $user->getName() ?></p>
                <?php else: // ユーザーが見つからなかった場合 ?>
                  <img src="images/male.png" class='icon-user'>
                  <p>ゲストユーザー</p>
              <?php endif ?>
            </div>
            <p><?php echo $review->getBody() ?></p>
          </div>
        <?php endforeach ?>
      </div>
    </div>
    <div class="delete-section" style="margin: 30px 0; padding: 20px; border-top: 1px solid #eee; text-align: center;">
    <form action="delete.php" method="post" onsubmit="return confirm('【最終確認】\nこの商品を削除してもよろしいですか？\nデータベースのデータと画像ファイルが完全に削除されます。');">
        <input type="hidden" name="id" value="<?php echo $menu->getId() ?>">
        <button type="submit" style="background-color: #e74c3c; color: white; border: none; padding: 12px 24px; border-radius: 5px; cursor: pointer; font-weight: bold;">
            🗑️ この商品を削除する
        </button>
    </form>
</div>
    <a href="index.php">← メニュー一覧へ</a>
  </div>
</body>
</html>
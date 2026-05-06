<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン - Green Plant Shop</title>
    <link rel="stylesheet" href="../public/assets/css/stylesheet.css">
</head>
<body>
    <div class="login-container">
        <h2>Green Plant Shop<br>ログイン</h2>
        <form action="auth.php" method="POST">
            <div class="form-item">
                <label>メールアドレス</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-item">
                <label>パスワード</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">ログイン</button>
        </form>
        <!-- 権限説明のコメント追加 -->
        <div class="auth-info">
            <p><strong>【権限について】</strong></p>
            <ul>
                <li><strong>管理者 (Admin):</strong> 商品の新規登録、削除、売上データの閲覧が可能。</li>
                <li><strong>一般スタッフ (Staff):</strong> 閲覧と注文操作のみに制限。</li>
            </ul>
        </div>
        <p><a href="../public/index.php">メニュー一覧に戻る</a></p>
    </div>
</body>
</html>
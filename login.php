<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログイン - Green Plant Shop</title>
        <link rel="syylesheet" href="style.css">
    </head>
    <body>
        <div class="login-container">
            <h2>管理者ログイン</h2>
            <form action="auth.php" method="POST">
                <div class="form-item">
                    <label>メールアドレス</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-item">
                    <label>パスワード</label>
                    <input type="password" name="password" reqired>
                </div>
                <button type="submit">ログイン</button>
            </form>
            <p><a href="index.php">一覧に戻る</p>
        </div>
    </body>
</html>
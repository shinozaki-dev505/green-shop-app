<!dOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>新規ユーザー登録</title>
    </head>
    <body>
        <h1>スタッフ登録</h1>
        <form action="register_process.php" method="POST">
            <div>
                <label>メールアドレス：</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>パスワード：</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label>権限：</label>
                <select name="role">
                    <option value="user">一般スタッフ</option>
                    <option value="admin">管理者</option>
                </select>
            </div>
            <button type="submit">登録する</button>
            <p><a href="index.php">戻る</a></p>
        </form>    
    </body>

</html>
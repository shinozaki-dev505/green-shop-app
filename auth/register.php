<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>新規ユーザー登録</title>
        <style>
            /* 画面全体の背景 */
            body {
                background-color: #f4f7f6;
                font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif;
                color: #333;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                margin: 0;
            }

            /* タイトルの装飾 */
            h1 {
                color: #2d5a27; /* 植物ショップらしい深い緑 */
                border-bottom: 3px solid #78c2ad;
                padding-bottom: 10px;
                margin-bottom: 30px;
            }

            /* フォームの外枠（カード風） */
            form {
                background: white;
                padding: 40px;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                width: 100%;
                max-width: 400px;
            }

            /* 各入力項目のまとまり */
            div {
                margin-bottom: 20px;
            }

            /* ラベルのスタイル */
            label {
                display: block;
                font-weight: bold;
                margin-bottom: 8px;
                color: #555;
            }

            /* 入力欄とセレクトボックス */
            input[type="email"],
            input[type="password"],
            select {
                width: 100%;
                padding: 12px;
                border: 1px solid #ddd;
                border-radius: 6px;
                box-sizing: border-box; /* 幅を100%に収める */
                font-size: 16px;
            }

            /* 登録ボタン */
            button {
                width: 100%;
                padding: 14px;
                background-color: #78c2ad; /* ショップのテーマカラー */
                color: white;
                border: none;
                border-radius: 6px;
                font-size: 18px;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            button:hover {
                background-color: #5ea691;
            }

            /* 戻るリンク */
            p {
                text-align: center;
                margin-top: 20px;
            }

            a {
                color: #78c2ad;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <h1>スタッフ登録</h1>
        <form action="register_process.php" method="POST">
            <div>
                <label>メールアドレス</label>
                <input type="email" name="email" required placeholder="example@mail.com">
            </div>
            <div>
                <label>パスワード</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label>権限</label>
                <select name="role">
                    <option value="user">一般スタッフ</option>
                    <option value="admin">管理者</option>
                </select>
            </div>
            <button type="submit">登録する</button>
            <p><a href="../public/index.php">メニュー一覧へ戻る</a></p>
        </form>    
    </body>
</html>
<?php
//register_process.php
require_once('../database.php');

$email = $_POST['email'];
$raw_password = $_POST['password']; //入力された生のパスワード
$role = $_POST['role'];

// 1. パスワードをハッシュ化する
$hashed_password = password_hash($raw_password,PASSWORD_DEFAULT);

$db = (new Database())->CreatePDO();

try{
    // 2. データベースに保存（生パスワードではなく、ハッシュ化した方を保存！）
    $stmt= $db->prepare("INSERT INTO users (email,password,role) VALUES (?,?,?)");
    $stmt->execute([$email,$hashed_password,$role]);

    echo "ユーザー登録が完了しました！<br>";
    echo "<a href='login.php'>ログイン画面へ</a>";
}catch(PDOException $e){
    // メールアドレスが重複している場合などのエラー処理
    die("登録に失敗しました: " . $e->getMessage());
}
?>
<?php
// auth.php
session_start();
require_once('database.php');

$email = $_POST['email'];
$password = $_POST['password'];

$db = (new Database())->CreatePDO();

// 1. ユーザーを探す
$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. パスワード確認（※本来は password_verify() 推奨ですが、今の流れに合わせます）
if ($user && $user['password'] === $password) {
    // ログイン成功！セッションにユーザー情報を入れる
    $_SESSION['user_id']   = $user['id'];
    
    // DBに name カラムがあるならそれを使う、なければ email を表示用に
    $_SESSION['user_name'] = $user['name'] ?? $user['email'];
    
    // 【重要】DBの role カラム（admin か user）をセッションに保存！
    $_SESSION['role']= $user['role']; 
    
    header('Location: index.php');
    exit;
} else {
    die("メールアドレスまたはパスワードが正しくありません。<a href='login.php'>戻る</a>");
}
?>
<?php
// auth.php
session_start();

// // --- 【緊急】ハッシュ値を再計算して表示するコード ---
// echo "password123 の正しいハッシュ値はこれです：<br>";
// echo password_hash("password123", PASSWORD_DEFAULT);
// echo "<br>これをコピーして、MariaDBのUPDATE文に使ってください。";
// exit;
// // ------------------------------------------------

require_once __DIR__ . '/../src/Database.php';

$email = $_POST['email'];
$password = $_POST['password'];

// // --- デバッグ用に追加 ---
// echo "入力されたパスワード: [" . $password . "]<br>";
// echo "DBのハッシュ値: [" . $user['password'] . "]<br>";
// if (password_verify($password, $user['password'])) {
//     echo "判定結果: 一致しました！";
// } else {
//     echo "判定結果: 一致しません...";
// }
// exit; // ここで処理を止める


$db = (new Database())->CreatePDO();

// // --- ここからデバッグ ---
// echo "入力されたメール: [" . $email . "]<br>";


// 1. ユーザーを探す
$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// if (!$user) {
//     echo "エラー: このメールアドレスはDBに登録されていません！<br>";
//     // DBにある全メールアドレスを表示して比較してみる
//     $all = $db->query("SELECT email FROM users")->fetchAll(PDO::FETCH_COLUMN);
//     echo "DB登録済みリスト: " . implode(", ", $all);
//     exit;
// }
// // --- ここまでデバッグ ---


// 2. パスワード確認（※本来は password_verify() 推奨ですが、今の流れに合わせます）
if ($user && password_verify($password,$user['password'])) {
    // ログイン成功！セッションにユーザー情報を入れる
    $_SESSION['user_id']   = $user['id'];
    
    // DBに name カラムがあるならそれを使う、なければ email を表示用に
    $_SESSION['user_name'] = $user['name'] ?? $user['email'];
    
    // 【重要】DBの role カラム（admin か user）をセッションに保存！
    $_SESSION['role']= $user['role']; 
    
    header('Location: ../public/index.php');
    exit;
} else {
    die("メールアドレスまたはパスワードが正しくありません。<a href='login.php'>戻る</a>");
}
?>
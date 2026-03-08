<?php
// logout.php
session_start();
session_destroy(); // セッションを空にする
header('Location: ../public/index.php'); // 一覧へ戻る
exit;
<?php
session_start();

require './common/db-connect.php';

$errorMessage = "";

$pdo = new PDO ($connect,USER,PASS);
// ユーザー認証の処理
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = $_POST['user_name'] ?? '';
    $password = $_POST['password'] ?? '';

    // データベースでのユーザー情報の取得
    $sql = $pdo->prepare("SELECT * FROM user WHERE user_name = ?");
    $sql->execute([$userName]);
    $row = $sql->fetch();

    if ($row) {
        // パスワードの検証
        $passwordInput = $password . $row['salt'];
        if (password_verify($passwordInput, $row['hash'])) {
            // 認証成功: ユーザー情報をセッションに保存
            $_SESSION['user_name'] = $userName;

            // i.phpにリダイレクト
            header('Location: userhenkou-input.php');
            exit;
        } else {
            // 認証失敗: エラーメッセージをセッションに保存
            $_SESSION['user-info-error'] = 'ログイン名またはパスワードが違います。';
            header('Location: user-info-login-input.php');
            exit;
        }
    } else {
        $_SESSION['user-info-error'] = 'ユーザーが見つかりません。';
        header('Location: user-info-login-input.php');
        exit;
    }
}
?>

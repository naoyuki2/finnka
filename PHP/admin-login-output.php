<?php
session_start();
require './common/db-connect.php';

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        $usernameInput = $_POST['username'];

        $pdo = new PDO($connect, USER, PASS);
        // ユーザー名のみで検索
        $stmt = $pdo->prepare("SELECT * FROM user WHERE user_name = ? AND admin_flg = 1");
        $stmt->execute([$usernameInput]);
        $result = $stmt->fetch();

        if(!empty($result)){
            $passwordInput = $_POST['password'].$result['salt'];
            if (password_verify($passwordInput,$result['hash'])) {
                $_SESSION['id'] = $result['user_id'];
                header('Location: admin-top.php');
                exit;
            } else {
                $_SESSION['errorMessage'] = "ユーザー名またはパスワードが間違っています。";
                header('Location: admin-login-input.php');
            }
        }else{
            $_SESSION['errorMessage'] = "ユーザー名またはパスワードが間違っています。";
            header('Location: admin-login-input.php');
        }
    } catch (PDOException $e) {
        $_SESSION['errorMessage'] = "データベースエラー: " . $e->getMessage();
        header('Location: admin-login-input.php');
    }
}
?>



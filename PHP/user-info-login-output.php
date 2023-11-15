<?php session_start(); 
    require './common/db-connect.php'; 

    uset($_SESSION['user-info-error']);

    $pdo = new PDO($connect, USER, PASS); 
    $sql = $pdo->prepare('select * from user where user_name=?');
    $sql->execute([$_POST['user_name']]);
    $row = $sql->fetch(); // 一致するユーザーが1つだけであることを仮定
    
    if($row){
        $passwordInput = $_POST['password'].$row['salt'];
        if (password_verify($passwordInput, $row['hash'])) {
            header('Location:user-info-login-input.php');
        }else{
            $_SESSION['user-info-error'] = 'ログイン名またはパスワードが違います。';
            header('Location:user-info-login-input.php');
        }
    }else {
        $_SESSION['user-info-error'] = 'ログイン名またはパスワードが違います。';
        header('Location:user-info-login-input.php');
    }
?>

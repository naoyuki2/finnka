<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require './common/db-connect.php';

$salt = substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, 20);
$password_hash = password_hash($_POST['password'].$salt,PASSWORD_DEFAULT);

$pdo = new PDO ($connect,USER,PASS);
if(isset($_SESSION['user'])){
    $user_id=$_SESSION['user']['user_id'];
    $sql=$pdo->prepare('select * from user where user_id!=? and user_name=?');
    $sql->execute([$user_id,$_POST['user_name']]);
}else{
    $sql=$pdo->prepare('select * from user where user_name=?');
    $sql->execute([$_POST['user_name']]);
}

if(strlen($_POST['password']) > 20 || strlen($_POST['password2']) > 20) {
    $_SESSION['error_message'] = 'パスワードは２０文字以内に設定してください';
    header('Location: new-login-input.php');
    exit;
}else if(empty($sql->fetchAll())){
    if($_POST['password'] !== $_POST['password2']) {
        $_SESSION['error_message'] = 'パスワードが一致しません。';
        header('Location: new-login-input.php');
        exit;
    } else if (empty($_POST['password']) || empty($_POST['password2'])) {
        $_SESSION['error_message'] = 'パスワードを入力してください';
        header('Location: new-login-input.php');
        exit;
    } else {
        $sql=$pdo->prepare('insert into user values(null,?,?,0,?,?)');
        $sql->execute([
        $_POST['user_name'],"../uploads/default_icon.jpg",$password_hash,$salt]);

        $sql=$pdo->prepare('select * from user where user_name = ?');
        $sql->execute([$_POST['user_name']]);
        $user = $sql->fetch();

        $_SESSION['id'] = $user['user_id'];
        header('Location: top.php');
        exit;
    }
}else{
    $_SESSION['error_message'] = 'ログイン名がすでに使用されていますので、変更してください。';
    header('Location: new-login-input.php');
    exit;
}

?>
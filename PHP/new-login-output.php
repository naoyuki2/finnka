<?php session_start(); ?>
<?php require './common/db-connect.php'; ?>
<?php
    $password_hash = password_hash($_POST['password'],PASSWORD_DEFAULT);

    $pdo = new PDO ($connect,USER,PASS);
    if(isset($_SESSION['user'])){
        $user_id=$_SESSION['user']['user_id'];
        $sql=$pdo->prepare('select * from user where user_id!=? and user_name=?');
        $sql->execute([$user_id,$_POST['user_name']]);
    }else{
        $sql=$pdo->prepare('select * from user where user_name=?');
        $sql->execute([$_POST['user_name']]);
    }

        if(empty($sql->fetchAll())){

        if ($_POST['password'] !== $_POST['password2']) {
            echo 'パスワードが一致しません。';
            echo '<form action="new-login-input.php" method="post">';
            echo '<input type="submit" value="戻る">';
            echo '</form>';
        }else{
            $sql=$pdo->prepare('insert into user values(null,?,?,0,0)');
            $sql->execute([
                $_POST['user_name'],$password_hash]);
            echo'お客様情報を登録しました。';
            echo '<form action="top.php" method="post">';
            echo '<input type="submit" value="トップページへ">';
            echo '</form>';
        }
}else{
 echo 'ログイン名が既に使用されていますので、変更してください。';
 echo '<form action="new-login-input.php" method="post">';
 echo '<input type="submit" value="戻る">';
 echo '</form>';
}


?>
</body>
</html>
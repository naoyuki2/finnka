<?php require './common/header.php'; ?>
<?php require './common/db-connect.php'; ?>
<?php
    echo '<p><img alt="image" src="image/',$POST['user_id'],'.jpg"></p>';
    $pdo = new PDO ($connect,USER,PASS);

        $sql=$pdo->prepare('select * from user where user_name=?');
        $sql->execute([$_POST['user_name']]);

    echo '<form action="user-info-login-input.php" method="post">';
    echo '<tr><td><input type="submit" value="ユーザー情報変更"></td><td>';
    echo '</form>';

    echo '<form action="akakesu.php" method="post">';
    echo '<input type="submit" value="アカウント削除"></td><td>';
    echo '</form>';

    echo '<form action="注文履歴照会.php" method="post">';
    echo '<input type="submit" value="注文履歴照会"></td><td>';
    echo '</form>';

    echo '<form action="login.php" method="post">';
    echo '<input type="submit" value="ログアウト"></td></tr>';
    echo '</form>';
?>
<?php require './common/footer.php';?>
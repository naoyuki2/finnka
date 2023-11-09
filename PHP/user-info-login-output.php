<?php session_start(); ?>
<?php require './common/header.php'; ?>
<?php require './common/db-connect.php'; ?>

<?php
unset($_SESSION['user']);
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('select * from user where user_name=?');
$sql->execute([$_POST['user_name']]);
$row = $sql->fetch(); // 一致するユーザーが1つだけであることを仮定

if ($row && password_verify($_POST['password'], $row['password'])) {
    $_SESSION['user'] = [
        'user_id' => $row['user_id'],
        'user_name' => $row['user_name'],
        'password' => $row['password'],
        'icon_color' => 0,
        'delete_flg' => 0
    ];

    echo 'おかえりなさい、', $_SESSION['user']['user_name'], 'さん。';
    echo '<form action="user-info-fenkou.php" method="post">';
    echo '<input type="submit" value="ユーザー変更">';
    echo '</form>';
} else {
    echo 'ログイン名またはパスワードが違います。';
    echo '<form action="user-info-login-input.php" method="post">';
    echo '<input type="submit" value="戻る">';
    echo '</form>';
}

?>

<?php require './common/footer.php'; ?>
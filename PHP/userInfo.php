<?php
require './common/header.php'; 
require './common/db-connect.php';

    $pdo = new PDO ($connect,USER,PASS);

    $sql=$pdo->prepare('select * from user where user_id=?');
    $sql->execute([$_SESSION['id']]);
    $user = $sql->fetch();

    echo '<div class="container">';
        echo '<div class="row">';
            echo '<div class="col-10">';
                echo '<div class="card">';
                    echo '<div class="row g-0">';
                        echo '<div class="col-12 col-lg-4">';
                            echo'<img src=',$user['icon_img'],' class="img-fluid" alt="card-horizontal-image">';
                        echo '</div>';
                        echo '<div class="col-12 col-lg-8">';
                            echo '<div class="card-body">';
                            echo '<form action="user-info-login-input.php" method="post">';
                            echo '<tr><td><input type="submit" class="btn btn-secondary" value="ユーザー情報変更"></td><td>';
                            echo '</form>';
                            echo '<form action="accountDelete1.php" method="post">';
                            echo '<input type="submit" class="btn btn-secondary" value="アカウント削除"></td><td>';
                            echo '</form>';
                            echo '<form action="注文履歴照会.php" method="post">';
                            echo '<input type="submit" class="btn btn-secondary" value="注文履歴照会"></td><td>';
                            echo '</form>';
                            echo '<form action="logout.php" method="post">';
                            echo '<input type="submit" class="btn btn-secondary" value="ログアウト"></td></tr>';
                            echo '</form>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

require './common/footer.php';?>


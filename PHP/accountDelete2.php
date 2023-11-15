<?php
    require './common/header.php';
    require './common/db-connect.php';

    echo '<p>アカウント削除2</p>';
    echo "<h1>あなたにおすすめの絵</h1>";
    echo '<form action="product.php" method="post">';
    echo '<button type="submit">見に行く</button>';
    echo '</form>';
    echo '<form action="login-input.php" method="post">';
    echo '<button type="submit">削除</button>';
    echo '</form>';

    require './common/footer.php';
?>  
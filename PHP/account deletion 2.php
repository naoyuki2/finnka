<?php
    require './common/header.php';
    require './common/db-connect.php';

    echo '<form action="account deletion 3.php" method="post">';
    echo '<p>アカウント削除2</p>';
    echo "<h1>あなたにおすすめの絵</h1>";
    echo '<button type="submit">見に行く</button>';
    echo '<button type="submit">削除</button>';
echo '</form>';

    require './common/footer.php';
?>
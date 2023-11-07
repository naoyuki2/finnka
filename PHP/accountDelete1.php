<?php
    require './common/header.php';
    require './common/db-connect.php';

    echo '<form action="account deletion 2.php" method="post">';
    echo '<p>アカウント削除1</p>';
    echo "<h1>アカウント削除</h1>";
    echo "<p>注意</p>";
    echo "<p>アカウントを削除するとすべての<br>";
    echo "登録データが削除されます";
    echo "<br>";
    echo '<button type="cancel">キャンセル</button>';
    echo '<button type="submit">削除</button>';
    echo '</form>';
    
    require './common/footer.php';
?>
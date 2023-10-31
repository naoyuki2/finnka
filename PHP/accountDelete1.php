<?php
    require './common/header.php';
    require './common/db-connect.php';

    echo "<h1>アカウント削除</h1>";
    echo "<p>注意</p>";
    echo "<p>アカウントを削除するとすべての<br>";
    echo "登録データが削除されます";
    echo "<br>";
    echo '<a href="">キャンセル </a>';
    echo '<a href="">削除</a>';

    require './common/footer.php';
?>
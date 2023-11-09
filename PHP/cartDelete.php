<?php
    require './common/db-connect.php';
    $pdo = new PDO($connect,USER,PASS);

    $sql=$pdo->prepare('delete from cartDetails where cart_detail_id=?');
    $sql->execute([$_POST['cart_detail_id']]);
    header('Location:cartDisplay.php');
?>
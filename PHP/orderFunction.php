<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require './common/db-connect.php';
    $pdo = new PDO($connect,USER,PASS);

    $sql=$pdo->prepare('insert into sales(sell_id,user_id) values(null,?)');
    $sql->execute([$_SESSION['id']]);

    $last_id = $pdo->lastInsertId();

    $stmt = $pdo->prepare("select * from cart where user_id=?");
    $stmt->execute([$_SESSION['id']]);
    $cart = $stmt->fetch();

    $cartDetails = $pdo->prepare("select * from cartDetails where cart_id=?");
    $cartDetails->execute([$cart['cart_id']]);

    foreach($cartDetails as $row){
        
        $stmt = $pdo->prepare("select * from products where product_id=?");
        $stmt->execute([$row['product_id']]);
        $product = $stmt->fetch();
        
        $sql=$pdo->prepare('insert into salseDetails values(null,?,?,?,?)');

        $sql->execute([
            $last_id,
            $row['product_id'],
            $row['quantity'],
            $product['price']
        ]);
    }

    $stmt = $pdo->prepare('DELETE FROM cartDetails');
    $stmt->execute();

    header('Location: orderComp.php');
?>
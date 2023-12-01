<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    require './common/db-connect.php';
    $pdo = new PDO($connect,USER,PASS);

        $sql=$pdo->prepare('select cart_id from cart where user_id = ?');
        $sql->execute([$_SESSION['id']]);
        $cart_id = $sql->fetchColumn();
        if(empty($cart_id)){
            $sql=$pdo->prepare('insert into cart values(null,?)');
            $sql->execute([$_SESSION['id']]);
    
            $sql=$pdo->prepare('select cart_id from cart where user_id = ?');
            $sql->execute([$_SESSION['id']]);
            $cart_id = $sql->fetchColumn();
        }
        $sql=$pdo->prepare('insert into cartDetails values(null,?,?,?,?)');
        $sql->execute([
            $cart_id,
            $_POST['product_id'],
            $_POST['quantity'],
            $_POST['radioFrame']
        ]);
    if($_POST['action'] == 'カートに入れる'){
        header('Location:cartDisplay.php');
    }else{
        header('Location:orderInput.php');
    }
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require './common/db-connect.php';

    try {
        $pdo = new PDO($connect, USER, PASS);
        $stmt=$pdo->prepare('select * from cart where user_id = ?');
        $stmt->execute([$_SESSION['id']]);
        $cart = $stmt->fetch();
        
        if(!empty($cart)){
        $deleteCart = $pdo->prepare('DELETE FROM cartDetails WHERE cart_id = ?');
        $deleteCart->execute([$cart['cart_id']]);
        
        $deleteCart = $pdo->prepare('DELETE FROM cart WHERE user_id = ?');
        $deleteCart->execute([$_SESSION['id']]);
        }
        $deleteUser = $pdo->prepare('DELETE FROM user WHERE user_id = ?');
        $deleteUser->execute([$_SESSION['id']]);

        session_unset();
        session_destroy();

        header('Location: login-input.php');
        exit();
    
    } catch (PDOException $e) {
        echo "データベースエラー: " . $e->getMessage();
        exit();
    }
    
    ?>
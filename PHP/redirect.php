<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(empty($_SESSION['id'])){
    header('Location: login-input.php');
}else{
    $product_id = $_GET['product_id'];
    header('Location: productDetail?product_id='.$product_id.'.php');
}

?>
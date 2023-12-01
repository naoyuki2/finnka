<?php
    require './common/header.php';
?>

    <style>
        .centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh; 
        }
        .payment-completed {
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        .payment-completed h1 {
            color: #ff0000;
        }
        .payment-completed a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
    
    <div class="centered-container">
        <div class="payment-completed">
            <h1>お支払いが完了しました</h1>
            <a href="top.php">TOPに戻る</a>
        </div>
    </div>

    <?php
        require './common/footer.php';
    ?>



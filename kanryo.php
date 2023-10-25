<?php
    require './common/header.php';
    require './common/db-connect.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>支払い完了</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        .message {
            font-size: 24px;  
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            border: none; 
            background-color: #808080;  
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #666666;
        }
    </style>
</head>
<body>

<div class="message">支払いが完了しました。</div>
<a href="#" class="button">トップページへ</a>

<?php
    require './common/footer.php';
?>

</body>
</html>


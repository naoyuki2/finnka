<?php
    require './common/header.php';
    require './common/db-connect.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者オプション画面</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .button-container {
            display: flex;
            flex-direction: column;  
            gap: 60px;               
        }

        .btn {
            width: 200px;            
            padding: 20px 40px;      
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 20px;         
            color: white;
            background-color: grey;  
            text-align: center;      
        }
    </style>
</head>
<body>

<div class="button-container">
    <form action="リンク先" method="post">
        <button type="submit" class="btn">商品登録</button>
    </form>

    <form action="リンク先" method="post">
        <button type="submit" class="btn">ログアウト</button>
    </form>
</div>
<?php
    require './common/footer.php';
?>
</body>
</html>
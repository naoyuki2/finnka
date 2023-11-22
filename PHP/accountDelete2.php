<?php
    require './common/header.php';
    require './common/db-connect.php';

    echo '<p>アカウント削除2</p>';
    echo "<div style='text-align:center'><h1>あなたにおすすめの絵</h1></div>";
    echo '<div class="d-flex justify-content-between m-4">'; 
        echo '<button type="button" onclick="loction.href="product.php"" class="btn btn-success  btn-lg" style="width:30%;padding:5px;font-size:30px;">見に行く</button>';
        echo '<button type="button" onclick="loction.href="login-input.php"" class="btn btn-danger  btn-lg" style="width:30%;padding:5px;font-size:30px;">削除</button>';
    echo '</div>';

    require './common/footer.php';
?>  
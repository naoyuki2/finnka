<?php
    require './common/header.php';
    require './common/db-connect.php';


    echo '<div class="mb-3"></div>'; 
    echo "<div style='text-align:center'><h1>本当に現在ログイン中の<br>アカウントを削除しますか？</h1></div>";
    echo '<div class="mb-3"></div>'; 
    echo "<div style='text-align:center'><h2>あなたにおすすめの絵</h2></div>";
    echo '<div class="d-flex justify-content-between m-4">';
    $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo->query('select * from products ORDER BY RAND() LIMIT 1');
        foreach ($sql as $row) {
            echo '<div class="container d-flex justify-content-center mb-5">';
            echo '<div class="col-6 col-sm-4">';
            echo '<div class="card">';
            echo '<div class="frame">';
            echo '<img
                src=',$row['img_pass'],'
                class="card-img-top"
                alt="card-img-top"
            />';
        
            echo '<a href="productDetail.php?product_id=' . $row['product_id'] . '">';
            echo '<div class="card-body">
                    <h5 class="card-title">',$row['title'],'</h5>
                    <p class="card-text">
                        ￥',$row['price'],'
                    </p>
                  </div>';
            echo '</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

        }
        echo '<div class="col-12 col-lg-12">';
        echo '<div class="container text-center">';
        echo '<div class="row">';

        echo '<div class="col-lg-3"></div>';
        echo '<div class="col-6 col-lg-3">';
        echo '<a href="top.php"><button type="button" class="btn btn-success btn-lg" ">TOPに<br>戻る</button></a>';
        echo '</div>';
        echo '<div class="col-6 col-lg-3">';

        echo '<form method="post" action="accountDelete3.php">';
        echo '<button type="submit" class="btn btn-danger btn-lg">完全に<br>削除</button></a>';
        echo '</form>';

        echo '<div class="col-lg-3"></div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    require './common/footer.php';
?>  
<?php
require './common/header.php';
require './common/db-connect.php';
$pdo = new PDO($connect, USER, PASS);

    $user_id = $_SESSION['id'];

    $stmt=$pdo->prepare('select * from user where user_id = ?');
    $stmt->execute([$user_id]);
    $product = $stmt->fetch();

    $sql=$pdo->prepare('select * from sales where user_id = ?');
    $sql->execute([$user_id]);
    $sales = $sql->fetchAll();

    echo '<div class="container">';
    echo '<div class="row">';
    echo '<h1 class="display-6 text-center bg-light p-2 mt-2 rounded-pill">',$product['user_name'],'さんの注文履歴：</h1>';

    foreach($sales as $row){
        // echo $row['sell_id'];
        $sql=$pdo->prepare('select * from salseDetails where sell_id = ?');
        $sql->execute([$row['sell_id']]);
        $salseDetails = $sql->fetchAll();
        foreach($salseDetails as $salseDetail){
            // echo $salseDetail['product_id'];

            $stmt=$pdo->prepare('select * from products where product_id = ?');
            $stmt->execute([$salseDetail['product_id']]);
            $product = $stmt->fetch();

            // echo $product['title'];

            $stmt=$pdo->prepare('select * from author where author_id = ?');
            $stmt->execute([$product['author_id']]);
            $author = $stmt->fetch();

            // echo $author['author_name'];

            echo '<div class="col-12 col-md-6">';
                echo '<div class="card">';
                    echo '<div class="row g-0">';
                        echo '<div class="col-7 col-sm-8">';
                            echo '<div class="card-body">';
                                echo'<h5 class="card-title">',$product['title'],'</h5>';
                                echo'<p class="card-text">作者：',$author['author_name'],'</p>';
                                echo'<p class="card-text">数量：',$salseDetail['quantity'],'個</p>';
                                echo'<p class="card-text">金額：',$product['price'],'円</p>';
                                echo '<form action="cartDelete.php" method="post">';
                                echo '</form>';
                            echo '</div>';
                        echo '</div>';
                    echo '<div class="col-5 col-sm-4">';
                        echo '<a href="productDetail.php?product_id='.$salseDetail['product_id'].'">';
                                echo'<img src=',$product['img_pass'],' class="img-fluid" alt="card-horizontal-image">';
                        echo '</a>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        }
    }
    echo '</div>';
    echo '</div>';
    require './common/footer.php';
?>
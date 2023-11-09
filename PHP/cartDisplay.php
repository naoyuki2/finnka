<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require './common/header.php';
    require './common/db-connect.php';
    $pdo = new PDO($connect,USER,PASS);
    
    $sql=$pdo->prepare('select * from cart where user_id = ?');
    $sql->execute([$_SESSION['id']]);
    $cart_id = $sql->fetchColumn();//cart_id:10

    $cartDetail=$pdo->prepare('select * from cartDetails where cart_id = ?');
    $cartDetail->execute([$cart_id]);
    echo '<div class="container">';
    echo '<div class="row">';
    foreach($cartDetail as $row){
        $product=$pdo->prepare('select * from products where product_id = ?');
        $product->execute([$row['product_id']]);
        $result = $product->fetch();

        $stmt=$pdo->prepare('select * from author where author_id = ?');
        $stmt->execute([$result['author_id']]);
        $author = $stmt->fetch();

            echo '<div class="col-12 col-md-6">';
                echo '<div class="card">';
                    echo '<div class="row g-0">';
                        echo '<div class="col-7 col-sm-8">';
                            echo '<div class="card-body">';
                                echo'<h5 class="card-title">',$result['title'],'</h5>';
                                    echo'<p class="card-text">作者：',$author['author_name'],'</p>';
                                    echo'<p class="card-text">数量：',$row['quantity'],'個</p>';
                                    echo'<p class="card-text">金額：',$result['price'],'円</p>';
                                    echo '<form action="cartDelete.php" method="post">';
                                        echo '<input type="hidden" name="cart_detail_id" value=',$row['cart_detail_id'],'>';
                                        echo '<button type="submit">削除</button>';
                                    echo '</form>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="col-5 col-sm-4">';
                            echo '<a href="productDetail.php?product_id='.$row['product_id'].'">';
                                echo'<img src=',$result['img_pass'],' class="img-fluid" alt="card-horizontal-image">';
                                echo '</a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    
    require './common/footer.php';
?>
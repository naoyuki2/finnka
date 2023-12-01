<?php
    require './common/header.php';
    require './common/db-connect.php';
    $pdo = new PDO($connect,USER,PASS);
    
    $sql=$pdo->prepare('select * from cart where user_id = ?');
    $sql->execute([$_SESSION['id']]);
    $cart_id = $sql->fetchColumn();//cart_id:10
    $count = 0;
    $totalPrice = 0;
    $cartDetail=$pdo->prepare('select * from cartDetails where cart_id = ?');
    $cartDetail->execute([$cart_id]);
    $cartDetail_result = $cartDetail->fetchAll();
    echo '<div class="container">';
    echo '<div class="row">';

    if(!empty($cartDetail_result)){
        foreach($cartDetail_result as $row){
            $product=$pdo->prepare('select * from products where product_id = ?');
            $product->execute([$row['product_id']]);
            $result = $product->fetch();
            $stmt=$pdo->prepare('select * from author where author_id = ?');
            $stmt->execute([$result['author_id']]);
            $author = $stmt->fetch();
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
            
            $product_sql = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
            $product_sql->execute([$product_id]);
            $product_row = $product_sql->fetch();

            $author_sql = $pdo->prepare('SELECT author_name FROM author WHERE author_id = ?');
            $author_sql->execute([$product_row['author_id']]);
            $author_row = $author_sql->fetch();

            $count += $quantity;
            $totalPrice += $quantity * $product_row['price'];
        }

        echo '<h1 class="display-6 text-center bg-light p-2 mt-2 rounded-pill">小計', $totalPrice, '円
        <span class="float-end">
            <a href="orderInput.php"><button type="button" class="btn btn-success">',$count,'点 購入する</button></a>
        </span></h1>';

        foreach($cartDetail_result as $row){
            $product=$pdo->prepare('select * from products where product_id = ?');
            $product->execute([$row['product_id']]);
            $result = $product->fetch();
            $stmt=$pdo->prepare('select * from author where author_id = ?');
            $stmt->execute([$result['author_id']]);
            $author = $stmt->fetch();
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
            
            $product_sql = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
            $product_sql->execute([$product_id]);
            $product_row = $product_sql->fetch();

            $author_sql = $pdo->prepare('SELECT author_name FROM author WHERE author_id = ?');
            $author_sql->execute([$product_row['author_id']]);
            $author_row = $author_sql->fetch();

            $count += $quantity;
            $totalPrice += $quantity * $product_row['price'];
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
                                        echo '<button type="submit" class="btn btn-danger">削除</button>';
                                    echo '</form>';
                                echo '</div>';
                            echo '</div>';
                            
                            echo '<div class="col-5 col-sm-4 d-flex align-items-center">';
                        echo '<a href="productDetail.php?product_id='.$row['product_id'].'">';
                            echo'<img src=',$result['img_pass'],' class="img-fluid" alt="card-horizontal-image">';
                            echo '</a>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }

      echo '<div class="container text-center">'; 
      echo '<div class="mb-3"></div>'; 

        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="container text-center">';
        echo '<div class="row">';
        echo '<div class="mb-3"></div>';

        echo '</div>';
        echo '</div>';
    }else{
        echo '<div class="container text-center">';
        echo '<div class="mb-5"></div>';
        echo '<h2>カートに商品が入っていないようです</h2>';
        echo '<div class="mb-4"></div>';
        echo "<h3>そんなあなたにおすすめの絵</h3>";
        echo '<div class="mb-3"></div>';

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
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }

    require './common/footer.php';
?>
<?php
    require './common/admin-header.php';
    require './common/db-connect.php';

    $pdo=new PDO($connect, USER, PASS);
    $sqlCategory=$pdo->query('select * from category');
    $sqlAuthor=$pdo->query('select * from author');
    if (isset($_SESSION['updateMessage'])) {
        echo '<p class="updateMessage">' . $_SESSION['updateMessage'] . '</p>';
        unset($_SESSION['updateMessage']); // エラーメッセージを表示したら、セッション変数から削除します
    }
    if (isset($_SESSION['dbMessage'])) {
        echo '<p class="dbMessage">' . $_SESSION['dbMessage'] . '</p>';
        unset($_SESSION['dbMessage']); // エラーメッセージを表示したら、セッション変数から削除します
    }

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
    
        $pdo = new PDO($connect,USER,PASS);

        $sqlCategory=$pdo->query('select * from category');

        $sqlAuthor=$pdo->query('select * from author');

        $stock_sql = $pdo->prepare('SELECT * FROM stock WHERE product_id = ?');
        $stock_sql->execute([$product_id]);
        $stock_row = $stock_sql->fetch();
    
        $product_sql = $pdo->prepare('SELECT * FROM products WHERE product_id = ?');
        $product_sql->execute([$product_id]);
        $product_row = $product_sql->fetch();
    
        $stock_sql = $pdo->prepare('SELECT quantity FROM stock WHERE product_id = ?');
        $stock_sql->execute([$product_id]);
        $stock_row = $stock_sql->fetch();
    
        $category_sql = $pdo->prepare('SELECT category_name FROM category WHERE category_id = ?');
        $category_sql->execute([$product_row['category_id']]);
        $category_row = $category_sql->fetch();
    
        $author_sql = $pdo->prepare('SELECT author_name FROM author WHERE author_id = ?');
        $author_sql->execute([$product_row['author_id']]);
        $author_row = $author_sql->fetch();
    
        if ($product_row && $stock_row > 0) {
            echo '<form action="admin-edit-output.php" method="post" enctype="multipart/form-data">';
            echo '<div class="container">';
                echo '<div class="row">';
                    echo '<div class="col-12">';
                        echo '<div class="card">';
                            echo '<div class="row g-0">';
                                echo '<div class="col-12 col-lg-4">';
                                    echo'<img src=',$product_row['img_pass'],' class="img-fluid" alt="card-horizontal-image">';
                                    echo '<input class="btn btn-secondary w-100 mt-2" type="submit" name="action" value="この内容で変更する">';
                                    echo '<input class="form-control mt-2" type="file" name="product_image" id="product_image">';
                                    echo '</div>';
                                echo '<div class="col-12 col-lg-8">';
                                    echo '<div class="card-body">';
                                        echo '<div class="form-floating mb-3">';
                                            echo '<input name="title" value=',$product_row['title'],' type="text" class="form-control" id="floatingInput" placeholder="タイトル">';
                                            echo '<label for="floatingInput">タイトル</label>';
                                        echo '</div>';

                                        echo '<div class="form-floating mb-3">';
                                            echo '<input value=', $category_row['category_name'],' name="category" list="category-list" class="form-control id="floatingInput" placeholder="カテゴリ">';
                                            echo '<datalist id="category-list">';
                                                    foreach($sqlCategory as $row){
                                                        echo '<option value="',$row['category_name'],'">',$row['category_name'],'</option>';
                                                    };
                                            echo '</datalist>';
                                            echo '<label for="floatingInput">カテゴリ</label>';
                                        echo '</div>';

                                        echo '<div class="form-floating mb-3">';
                                            echo '<input value=', $author_row['author_name'],' name="author" list="author-list" class="form-control id="floatingInput" placeholder="作者">';
                                            echo '<datalist id="author-list">';
                                                    foreach($sqlAuthor as $row){
                                                        echo '<option value="',$row['author_name'],'">',$row['author_name'],'</option>';
                                                    };
                                            echo '</datalist>';
                                            echo '<label for="floatingInput">作者</label>';
                                        echo '</div>';

                                        echo '<div class="form-floating mb-3">';
                                            echo '<input name="thought" value=',$product_row['thought'],' type="text" class="form-control" id="floatingInput" placeholder="作者の思い">';
                                            echo '<label for="floatingInput">作者の思い</label>';
                                        echo '</div>';

                                        echo '<div class="form-floating mb-3">';
                                            echo '<input name="price" value=',$product_row['price'],' type="text" class="form-control" id="floatingInput" placeholder="金額">';
                                            echo '<label for="floatingInput">金額</label>';
                                        echo '</div>';

                                        echo '<div class="form-floating mb-3">';
                                            echo '<input name="stock" value=',$stock_row['quantity'],' type="text" class="form-control" id="floatingInput" placeholder="在庫">';
                                            echo '<label for="floatingInput">在庫</label>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo'<input type="hidden" name="product_id" value=',$product_id,'>';
                    echo '</div>';
                echo '</form>';
        } else {
            echo '商品情報または在庫情報が見つかりません。';
        }
    } else {
        echo '商品IDが指定されていません。';
    }

    require './common/footer.php';?>
<?php
require './common/header.php';
require './common/db-connect.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $pdo = new PDO($connect,USER,PASS);

    $product_sql = $pdo->prepare('SELECT * FROM products WHERE product_id = ?');
    $product_sql->execute([$product_id]);
    $product_row = $product_sql->fetch();

    $stock_sql = $pdo->prepare('SELECT quantity FROM stock WHERE product_id = ?');
    $stock_sql->execute([$product_id]);
    $stock_row = $stock_sql->fetch();


    $author_sql = $pdo->prepare('SELECT author_name FROM author WHERE author_id = ?');
    $author_sql->execute([$product_row['author_id']]);
    $author_row = $author_sql->fetch();

    if ($product_row && $stock_row['quantity'] > 0) {
        echo '<form action="cartInput.php" method="post">';
        echo '<div class="container">';
            echo '<div class="row">';
                echo '<div class="col-12">';
                    echo '<div class="card">';
                        echo '<div class="row g-0">';
                            echo '<div class="col-12 col-lg-4">';
                                echo'<img src=',$product_row['img_pass'],' class="img-fluid" alt="card-horizontal-image">';
                            echo '</div>';
                            echo '<div class="col-12 col-lg-8">';
                                echo '<div class="card-body">';
                                    echo '<p class="card-text fs-3">',$product_row['title'],'</p>';
                                    echo '<p class="card-text fs-3">作者：',$author_row['author_name'],'</p>';
                                    echo '<p class="card-text fs-3">作者の思い：',$product_row['thought'],'</p>';
                                    echo '<p class="card-text fs-3">金額：',$product_row['price'],'円</p>';

                                    echo '<div class="form-floating">';
                                        echo '<select name="quantity" class="form-select fs-5" id="floatingSelect" aria-label="Floating label select example">';
                                        for ($i = 1; $i <= $stock_row['quantity']; $i++) {
                                            echo '<option value="', $i, '">', $i, '</option>';
                                        }
                                        echo '</select>';
                                        echo '<label for="floatingSelect">数量</label>';
                                    echo '</div>';
                                    echo '<div class="btn-group" role="group" aria-label="Basic radio toggle button group">';
                                        echo '<input type="radio" class="btn-check radio" name="btnGroupRadio" id="btnRadio1" autocomplete="off" checked="">';
                                        echo '<label class="btn radio" for="btnRadio1">Radio 1</label>';

                                        echo '<input type="radio" class="btn-check" name="btnGroupRadio" id="btnRadio2" autocomplete="off">';
                                        echo '<label class="btn radio" for="btnRadio2">Radio 2</label>';

                                        echo '<input type="radio" class="btn-check" name="btnGroupRadio" id="btnRadio3" autocomplete="off">';
                                        echo '<label class="btn radio" for="btnRadio3">Radio 3</label>';
                                    echo '</div>';

                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<a href="productPreview.php?product_id='.$product_id.'"><button type="button" class="btn btn-secondary">プレビュー</button></a>';
                echo'<input type="hidden" name="product_id" value=',$product_id,'>';
                echo'<input class="btn btn-secondary" type="submit" name="action" value="カートに入れる">';
                echo'<input class="btn btn-secondary" type="submit" name="action" value="今すぐ購入">';
                echo '</form>';
        echo '</div>';

        // echo '<tr><td>額縁</td><td>
        //     <input type="radio" name="gakubuti" value="natural">
        //     <input type="radio" name="gakubuti" value="darkWood">
        //     <input type="radio" name="gakubuti" value="whiteWood">
        //     <input type="submit" value="プレビュー">
        //     </td></tr>';
        // echo '</table>';
        // echo '<input type="hidden" name="product_id" value=',$product_id,'>';
        // echo '<input type="submit" name="action" value="カートに入れる">';
        // echo '<input type="submit" name="action" value="今すぐ購入">';
        // echo '</form>';
    } else {
        echo '商品情報または在庫情報が見つかりません。';
    }
} else {
    echo '商品IDが指定されていません。';
}

require './common/footer.php';
?>
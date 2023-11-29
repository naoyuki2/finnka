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

    if ($product_row && $stock_row) {
        echo '<form action="cartInput.php" method="post">';
        echo '<div class="container">';
            echo '<div class="row">';
                echo '<div class="col-12">';
                    echo '<div class="card">';
                        echo '<div class="row g-0">';
                            echo '<div class="col-12 col-lg-4 frame-beige">';
                                echo'<img src=',$product_row['img_pass'],' class="img-fluid" alt="card-horizontal-image">';
                            echo '</div>';
                            echo '<div class="col-12 col-lg-8">';
                                echo '<div class="card-body">';
                                    echo '<p class="card-text fs-3">',$product_row['title'],'</p>';
                                    echo '<p class="card-text fs-3">作者：',$author_row['author_name'],'</p>';
                                    echo '<p class="card-text fs-3">作者の思い：',$product_row['thought'],'</p>';
                                    echo '<p class="card-text fs-3">金額：',$product_row['price'],'円</p>';

                                    if ($stock_row['quantity'] > 0) {
                                        echo '<div class="form-floating">';
                                        echo '<select name="quantity" class="form-select fs-5" id="floatingSelect" aria-label="Floating label select example">';
                                        for ($i = 1; $i <= $stock_row['quantity']; $i++) {
                                            echo '<option value="', $i, '">', $i, '</option>';
                                        }
                                        echo '</select>';
                                        echo '<label for="floatingSelect">数量</label>';
                                        echo '</div>';
                                    } else {
                                        echo '<p style="color:red; font-size: 1.2em;">この商品の在庫は現在ございません。</p>';
                                    }
                                    echo '<div class="mb-2"></div>';
                                    echo '<div m-2>';
                                    echo '額縁カラー：';
                                        echo '<div class="btn-group" role="group" aria-label="Basic radio toggle button group">';
                                            echo '<input type="radio" class="btn-check radio black" name="btnGroupRadio" id="btnRadio1" autocomplete="off" checked="">';
                                            echo '<label class="btn radio black" for="btnRadio1">　BLACK　</label>';

                                            echo '<input type="radio" class="btn-check radio beige" name="btnGroupRadio" id="btnRadio2" autocomplete="off" checked="">';
                                            echo '<label class="btn radio beige" for="btnRadio2">　BEIGE　</label>';

                                            echo '<input type="radio" class="btn-check radio white" name="btnGroupRadio" id="btnRadio3" autocomplete="off" checked="">';
                                            echo '<label class="btn radio white" for="btnRadio3">　WHITE　</label>';
                                        echo '</div><br>';
                                        echo '<div class="mb-3"></div>';
                                        echo '<div class="col-12 col-lg-12">';
                                        echo '<div class="row">';
                                        echo '<div class="col-6 col-lg-8">';
                                            echo '<a href="productPreview.php?product_id='.$product_id.'"><button type="button" class="btn btn-secondary"><i class="fa-solid fa-images"></i>　プレビュー</button></a>';
                                            if ($stock_row['quantity'] > 0) {
                                                echo'<input type="hidden" name="product_id" value=',$product_id,'>';
                                                echo '</div>';
                                                echo '<div class="col-3 col-lg-2">';
                                                echo'<input class="btn btn-secondary" type="submit" name="action" value="カートに入れる">';
                                                echo '</div>';
                                                echo '<div class="col-3 col-lg-2">';
                                                echo'<input class="btn btn-danger" type="submit" name="action" value="今すぐ購入">';
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '</form>';
    } else {
        echo '商品情報または在庫情報が見つかりません。';
    }
} else {
    echo '商品IDが指定されていません。';
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var radios = document.querySelectorAll('input[type=radio]');
    radios.forEach(function(radio) {
    radio.addEventListener('click', function() {
        var frames = Array.from(document.querySelectorAll('.frame-beige, .frame-black, .frame-white'));
        frames.forEach(function(frame) {
            if (frame) {
                frame.classList.remove('frame-black', 'frame-beige','frame-white');
                if (radio.id === 'btnRadio1') {
                    frame.classList.add('frame-black');
                } else if (radio.id === 'btnRadio2') {
                    frame.classList.add('frame-beige');
                } else if (radio.id === 'btnRadio3') {
                    frame.classList.add('frame-white');
                }
            }
        });
    });
    });
    });
</script>

<?php
    require './common/footer.php';
?>
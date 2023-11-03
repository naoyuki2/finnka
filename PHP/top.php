<?php
    session_start();
    require './common/header.php';
    require './common/db-connect.php';
    // $id = $_SESSION['id'];
    // echo '<h1>',$id,'</h1>';
?>

<!-- <p>おすすめ商品</p>
<img src="" alt="おすすめ商品">
<button type="submit" name="left"><</button>
<img src="" alt="おすすめ商品">
<button type="submit" name="right">></button>
<img src="" alt="おすすめ商品">
<p>すべての商品</p> -->
<div class="container text-center">
      <div class="row">
<?php
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->query('select * from products');
foreach($sql as $row){
    // echo '<tr>';
    // echo    '<td><a href="詳細画面"><img src="',$row['img_pass'],'" alt="商品"></a></td>';
    // echo '</tr>';
    // echo '<tr>';
    // echo    '<td>',$row['title'],'</td>';
    // echo '</tr>';
    // echo '<tr>';
    // echo    '<td>',$row['price'],'</td>';
    // echo '</tr>';

    echo '<div class="col-12 col-md-6 col-lg-4">';
        echo '<div class="card">';
            echo '<img
                src=',$row['img_pass'],'
                class="card-img-top"
                alt="card-img-top"
            />';
            echo '<div class="card-body">
                <h5 class="card-title">',$row['title'],'</h5>
                <p class="card-text">
                ￥',$row['price'],'
                </p>
            </div>';
        echo '</div>';
    echo '</div>';
}
?>
    </div>
</div>

</table>
<a href="accountDelete2.php">アカウント削除再確認</a>
<a href="accountDelete1.php">アカウント削除確認</a>
<a href="administrator top page.php">管理者トップ</a>
<a href="result.php">画像結果</a>
<a href="upload.php">画像上げ</a>
<a href="user-info.php">ユーザー情報</a>
<a href="productsInsertInput.php">商品登録</a>
<?php
    require './common/footer.php';
?>
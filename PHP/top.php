<?php
    session_start();
    require './common/header.php';
    require './common/db-connect.php';
    if(empty($_SESSION['id'])){
        echo "ユーザーIDが入っていません";
    }else{
        echo $_SESSION['id'];
    }
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
    echo '<div class="col-12 col-md-6 col-lg-4">';
    echo '<div class="card">';
    echo '<div class="frame">';
    echo '<img
    src=',$row['img_pass'],'
    class="card-img-top"
    alt="card-img-top"
    />';
    echo '</div>';
    echo '<a href="productDetail.php?product_id='.$row['product_id'].'">';
    echo '<div class="card-body">
    <h5 class="card-title">',$row['title'],'</h5>
    <p class="card-text">
    ￥',$row['price'],'
    </p>
    </div>';
    echo '</a>';
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
<?php
    require './common/admin-header.php';
    require './common/db-connect.php';
?>

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
    echo '<a href="admin-edit-input.php?product_id='.$row['product_id'].'">';
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

<?php
    require './common/footer.php';
?>
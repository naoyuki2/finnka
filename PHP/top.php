<?php
    session_start();
    require './common/header.php';
    require './common/db-connect.php';
    $id = $_SESSION['id'];
    echo '<h1>',$id,'</h1>';
?>

<p>おすすめ商品</p>
<img src="" alt="おすすめ商品">
<button type="submit" name="left"><</button>
<img src="" alt="おすすめ商品">
<button type="submit" name="right">></button>
<img src="" alt="おすすめ商品">
<p>すべての商品</p>
<table>
<?php
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->query('select * from products');
foreach($sql as $row){
    echo '<tr>';
    echo    '<td><a href="詳細画面"><img src="',$row['img_pass'],'" alt="商品"></a></td>';
    echo '</tr>';
    echo '<tr>';
    echo    '<td>',$row['title'],'</td>';
    echo '</tr>';
    echo '<tr>';
    echo    '<td>',$row['price'],'</td>';
    echo '</tr>';
}
?>
</table>
<?php
    require './common/footer.php';
?>
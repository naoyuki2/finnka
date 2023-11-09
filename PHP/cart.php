<?php require './common/header.php';?>
<?php require './common/db-connect.php'; ?>
<?php
$pdo=new PDO($connect, USER, PASS);
$sql=$pdo->query('INSERT INTO 'cart'('cart_id', 'user_id') VALUES ([value-1],[value-2])');
if (!empty($_SESSION['products'])){
echo '<table>';
echo '<tr><th>タイトル</th><th>作者</th>';
echo '<th>個数</th><th>値段</th></tr>';
$total=0;
foreach ($_SESSION['products'] as $id=>$product){
echo '<tr>';
echo '<td>',$id,'</td>';
echo '<td><a href="detail.php?id=',$id,'">',
$product['title'], '</a></td>';
echo '<td>', $product['author_name'], '</td>';
echo '<td>', $product['count'], '</td>';
$subtotal=$product['price']*$product['count'];
$total+=$subtotal;
echo '<td>',$subtotal,'</td>';
echo '<td><a href="cart-delete.php?id=',$id,'">削除</a></td>';
echo '</tr>';
}
echo '<tr><td>合計</td><td></td><td></td><td></td><td>',$total,
     '</td><td></td></tr>';
echo '</table>';
} else {
echo 'カートに商品がありません。';
}
?>
<?php require './common/footer.php';?>
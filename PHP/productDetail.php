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
        echo '<img src=', $product_row['img_pass'],' alt="商品画像">';
        echo '<p>', $product_row['title'], '</p>';
        echo '<table>';
        echo '<tr><td></td><td><form action="top.php"><input type="submit" value="戻る"></form></td></tr>';
        echo '<tr><td>作者</td><td><input type="text" value="', $author_row['author_name'], '" readonly></td></tr>';
        echo '<tr><td>作者の思い</td><td><input type="text" value="', $product_row['thought'], '" readonly></td></tr>';
        echo '<tr><td>金額</td><td><input type="text" value="', $product_row['price'], '" readonly></td></tr>';
        echo '<tr><td>数量</td><td><select name="quantity">';
        for ($i = 1; $i <= $stock_row['quantity']; $i++) {
            echo '<option value="', $i, '">', $i, '</option>';
        }
        echo '</select></td></tr>';
        echo '<tr><td>額縁</td><td>
            <input type="radio" name="gakubuti" value="natural">
            <input type="radio" name="gakubuti" value="darkWood">
            <input type="radio" name="gakubuti" value="whiteWood">
            <form action=""><input type="submit" value="プレビュー"></form>
            </td></tr>';
        echo '</table>';
        echo '<form action=""><input type="submit" value="カートに入れる"></form>';
        echo '<form action=""><input type="submit" value="今すぐ購入"></form>';
    } else {
        echo '商品情報または在庫情報が見つかりません。';
    }
} else {
    echo '商品IDが指定されていません。';
}

require './common/footer.php';
?>
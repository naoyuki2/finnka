<?php
session_start();
$user_id = $_SESSION['id'];
require './common/header.php';
require './common/db-connect.php';

echo '<p>注文情報</p>';

$pdo = new PDO($connect, USER, PASS);
$cart_id = $pdo->prepare("select cart_id from cart where user_id=?");
$cart_id->execute([$user_id]);
$cart_rows = $cart_id->fetchAll(PDO::FETCH_ASSOC);

$count = 0;
$totalPrice = 0;

foreach ($cart_rows as $cart_row) {

  $cartDetails_sql = $pdo->prepare("SELECT product_id, quantity FROM cartDetails WHERE cart_id=?");
  $cartDetails_sql->execute([$cart_row['cart_id']]);

  while ($row = $cartDetails_sql->fetch()) {
      $product_id = $row['product_id'];
      $quantity = $row['quantity'];

      $product_sql = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
      $product_sql->execute([$product_id]);
      $product_row = $product_sql->fetch();

      $author_sql = $pdo->prepare('SELECT author_name FROM author WHERE author_id = ?');
      $author_sql->execute([$product_row['author_id']]);
      $author_row = $author_sql->fetch();

      echo '<ul>';
        echo '<li><img src=', $product_row['img_pass'],' alt="商品画像"></li>';
        echo '<li>タイトル:', $product_row['title'],'</li>';
        echo '<li>作者:', $author_row['author_name'],'</li>';
        echo '<li>数量:', $quantity,'</li>';
        echo '<li>金額:', $product_row['price'], '円</li>';
      echo '</ul>';

      $count += $quantity;
      $totalPrice += $quantity * $product_row['price'];
  }
}
echo $count, '点';
echo '合計金額', $totalPrice, '円';
?>

  <p>配送先住所</p>
  <ul>
    <li>郵便番号<input type="text" value="<?php echo $_POST['postcode']?>"></li>
    <li>都道府県<input type="text" value="<?php echo $_POST['pref']?>"></li>
    <li>市区町村<input type="text" value="<?php echo $_POST['city']?>"></li>
    <li>町域・番地<input type="text" value="<?php echo $_POST['town']?>"></li>
    <li>建物名など<input type="text" value="<?php echo $_POST['building']?>"></li>
  </ul>

  <p>お支払方法</p>
  <?php
  if($_POST['payment'] == "credit"){
    echo '<P>クレジットカード決済</p>';
  }else{
    echo '<p>コンビニ決済</p>';
  }
  ?>
</form>

<a href="cartDisplay.php">戻る</a><a href="orderFunction.php">お支払いに進む</a>

<?php
require './common/footer.php';
?>
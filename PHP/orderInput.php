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

<form action="orderConfirm.php" method="post" name="contact">
  <p>配送先住所</p>
  <ul>
    <li>
      郵便番号<input name="postcode" type="text" placeholder="郵便番号">
      <button id="searchButton" type="button">検索</button>
    </li>
    <li>
      <select name="pref" id="prefectureSelect">
      <option value="" selected>都道府県</option>
      <option value="北海道">北海道</option>
      <option value="青森県">青森県</option>
      <option value="岩手県">岩手県</option>
      <option value="宮城県">宮城県</option>
      <option value="秋田県">秋田県</option>
      <option value="山形県">山形県</option>
      <option value="福島県">福島県</option>
      <option value="茨城県">茨城県</option>
      <option value="栃木県">栃木県</option>
      <option value="群馬県">群馬県</option>
      <option value="埼玉県">埼玉県</option>
      <option value="千葉県">千葉県</option>
      <option value="東京都">東京都</option>
      <option value="神奈川県">神奈川県</option>
      <option value="新潟県">新潟県</option>
      <option value="富山県">富山県</option>
      <option value="石川県">石川県</option>
      <option value="福井県">福井県</option>
      <option value="山梨県">山梨県</option>
      <option value="長野県">長野県</option>
      <option value="岐阜県">岐阜県</option>
      <option value="静岡県">静岡県</option>
      <option value="愛知県">愛知県</option>
      <option value="三重県">三重県</option>
      <option value="滋賀県">滋賀県</option>
      <option value="京都府">京都府</option>
      <option value="大阪府">大阪府</option>
      <option value="兵庫県">兵庫県</option>
      <option value="奈良県">奈良県</option>
      <option value="和歌山県">和歌山県</option>
      <option value="鳥取県">鳥取県</option>
      <option value="島根県">島根県</option>
      <option value="岡山県">岡山県</option>
      <option value="広島県">広島県</option>
      <option value="山口県">山口県</option>
      <option value="徳島県">徳島県</option>
      <option value="香川県">香川県</option>
      <option value="愛媛県">愛媛県</option>
      <option value="高知県">高知県</option>
      <option value="福岡県">福岡県</option>
      <option value="佐賀県">佐賀県</option>
      <option value="長崎県">長崎県</option>
      <option value="熊本県">熊本県</option>
      <option value="大分県">大分県</option>
      <option value="宮崎県">宮崎県</option>
      <option value="鹿児島県">鹿児島県</option>
      <option value="沖縄県">沖縄県</option>
</select>
    </li>
    <li>市区町村<input name="city" type="text" placeholder="市区町村"></li>
    <li>町域・番地<input name="town" type="text" placeholder="町域・番地"></li>
    <li>建物名など<input name="building" type="text" placeholder="建物名など"></li>
  </ul>

  <p>お支払方法</p>
  <input type="radio" name="payment" id="credit">クレジットカード決済
  <input type="radio" name="payment" id="conveni">コンビニ決済
  <input type="submit" name="kakutei" value="注文確定">
</form>

<a href="cartDisplay.php">戻る</a>

<script>
const contactForm = document.forms.contact;
const searchButton = document.getElementById('searchButton');
const prefectureSelect = document.getElementById('prefectureSelect');

searchButton.addEventListener('click', () => {
  const postcode = contactForm.postcode.value;
  fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${postcode}`)
    .then(response => response.json())
    .then(data => {
      prefectureSelect.value = data.results[0].address1;
      contactForm.city.value = data.results[0].address2;
      contactForm.town.value = data.results[0].address3;
    })
    .catch(error => console.log(error))
});
</script>

<?php
require './common/footer.php';
?>

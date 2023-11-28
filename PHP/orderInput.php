<?php
  session_start();
  $user_id = $_SESSION['id'];
 
  require './common/header.php';
  require './common/db-connect.php';
?>
 
<div class="container">
  <div class="info">
    <h1 class="info-text col-12 col-md-6 text-dark">注文情報</h1>
  </div>
    <div class="row my-5 m-md-5">
      <?php
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
      ?>
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="row g-0">
            <div class="col-7 col-sm-8">
              <div class="card-body">
                <h5 class="card-title"><?php echo $product_row['title'];?></h5>
                <p class="card-text">作者：<?php echo $author_row['author_name'];?></p>
                <p class="card-text">数量：<?php echo $quantity;?>個</p>
                <p class="card-text">金額：<?php echo $product_row['price'];?>円</p>
              </div>
            </div>
            <div class="col-5 col-sm-4">
              <img src="<?php echo $product_row['img_pass'];?>" class="img-fluid" alt="orderInput-image">
            </div>
          </div>
        </div>
      </div>
      <?php
          $count += $quantity;
            $totalPrice += $quantity * $product_row['price'];
          }
        }
      ?>
    </div>
  <div class="ditail">
    <div class="row w-50 mx-auto">
      <div class="col-2 col-md-1"></div>
      <div class="col-8 col-md-3"><h5 class="ditail-text text-light"><?php echo $count;?>点</div></h5>
      <div class="col-2 col-md-1"></div>
      <div class="col-12 col-md-6"><h5 class="ditail-text text-light">合計<?php echo $totalPrice;?>円</h5></div>
      <div class="col-12 col-md-1"></div>
    </div>
  </div>
  <div class="info">
    <h1 class="info-text col-12 col-md-6 text-dark">配送先住所</h1>
  </div>
  <form method="post" action="orderConfirm.php" name="contact">
    <div class="live-form col-12 col-md-6">
      <div class="container">
        <div class="row">
          <div class="mb-3">
            <div class="form-group">
              <label for="post" style="display:block">
                郵便番号
              </label>
              <input type="text" name="postal1" size="3">-<input type="text" name="postal2" size="4"
              onKeyUp="AjaxZip3.zip2addr('postal1', 'postal2', 'address', 'address');">
              <button id="searchButton" type="button">
                  検索
              </button>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-group">
              都道府県<select name="pref" id="prefectureSelect">
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
            </div>
          </div>
          <div class="mb-3">
            <div class="form-group">
              市区町村<input type="text" class="form-control" name="city">
            </div>
          </div>
          <div class="mb-3">
            <div class="form-group">
              町域・番地<input type="text" class="form-control" name="town">
            </div>
          </div>
          <div class="mb-3">
            <div class="form-group">
              建物名など<input type="text" class="form-control" name="building">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="info">
      <h1 class="info-text col-12 col-md-6 text-dark">お支払方法</h1>
    </div>
    <div class="payment col-12 col-md-6">
      <div class="container">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment" id="credit">
            クレジットカード決済
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment" id="conveni">
            コンビニ決済
        </div>
      </div>
    </div>
    <div class="buttons mx-2">
      <a href="cartDisplay.php" class="b btn btn-primary">戻る</a>
      <button type="submit" class="b btn btn-success">確認画面へ</button>
    </div>
  </form>
</div>
 
<style>
 
  .info {
    margin-top: 5rem;
    text-align: center;
  }
 
  .info-text {
    border-radius: 5px;
    margin: auto;
    padding: 10px;
    background-color: #dddddd98;
  }
 
  .ditail {
    margin-top: 3rem;
  }
 
  .ditail-text {
    background-color: #66666699;
    text-align: center;
    padding: 0.5rem;
    border-radius: 5px;
    border: 1px solid #fff;
    margin: 0.5rem;
  }
 
  .live-form {
    background-color: white;
    border-radius: 5px;
    padding: 2rem;
    margin: 3rem auto 0 auto;
  }
 
  .payment {
    background-color: white;
    padding: 2rem;
    margin: 3rem auto 0 auto;
    border-radius: 5px
  }
 
  .buttons {
    margin: 5rem auto 5rem auto;
    text-align: center;
  }
 
  .b{
    margin: 3rem;
  }
 
  .buttons
</style>
 
<script>
    const contactForm = document.forms.contact;
    const searchButton = document.getElementById('searchButton');
    const prefectureSelect = document.getElementById('prefectureSelect');
 
    searchButton.addEventListener('click', () => {
        const postcode1 = contactForm.postal1.value;
        const postcode2 = contactForm.postal2.value;
        const postcode = `${postcode1}-${postcode2}`;
 
        fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${postcode}`)
            .then(response => response.json())
            .then(data => {
                prefectureSelect.value = data.results[0].address1;
                contactForm.city.value = data.results[0].address2;
                contactForm.town.value = data.results[0].address3;
            })
            .catch(error => console.log(error))
    });
 
    contactForm.addEventListener('submit', (event) => {
      event.preventDefault();
 
      const postal1 = contactForm.postal1.value;
      const postal2 = contactForm.postal2.value;
      const pref = contactForm.pref.value;
      const city = contactForm.city.value;
      const town = contactForm.town.value;
      const payment = document.querySelector('input[name="payment"]:checked');
 
      if (postal1 === '') {
        alert('郵便番号の一部が入力されていません。');
      } else if (postal2 === '') {
        alert('郵便番号の一部が入力されていません。');
      } else if (pref === '') {
        alert('都道府県が選択されていません。');
      } else if (city === '') {
        alert('市区町村が入力されていません。');
      } else if (town === '') {
        alert('町域・番地が入力されていません。');
      } else if (payment === null) {
        alert('お支払い方法が選択されていません。');
      } else {
        contactForm.submit();
      }
    });
</script>
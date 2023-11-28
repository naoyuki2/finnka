<?php
session_start();
$user_id = $_SESSION['id'];
require './common/header.php';
require './common/db-connect.php';
 
  $pdo = new PDO($connect, USER, PASS);
  $cart_id = $pdo->prepare("select cart_id from cart where user_id=?");
  $cart_id->execute([$user_id]);
  $cart_rows = $cart_id->fetchAll(PDO::FETCH_ASSOC);
 
  $count = 0;
  $totalPrice = 0;
?>
<div class="container">
  <div class="info">
    <h1 class="info-text col-12 col-md-6 text-dark">注文情報</h1>
  </div>
  <div class="row my-5 m-md-5">
    <?php
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
            <img src="<?php echo $product_row['img_pass'];?>" class="img-fluid" alt="orderConfirm-image">
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
      <div class="col-8 col-md-4"><h5 class="ditail-text text-light"><?php echo $count;?>点</div></h5>
      <div class="col-2 col-md-1"></div>
      <div class="col-12 col-md-5"><h5 class="ditail-text text-light">合計<?php echo $totalPrice;?>円</h5></div>
    </div>
  </div>
  <div class="info">
    <h1 class="info-text col-12 col-md-6 text-dark">配送先住所</h1>
  </div>
  <div class="live-form col-12 col-md-6">
    <div class="container">
      <div class="row">
        <div class="mb-3">
          <div class="input-group">
            <label for="post" style="display:block">
              郵便番号
            </label>
          </div>
          <input type="text" value="<?php echo $_POST['postal1']?>" size="3" readonly>
          -<input type="text" value="<?php echo $_POST['postal2']?>" size="4" readonly>
        </div>
        <div class="mb-3">
          <div class="input-group">
            <label for="post" style="display:block">
              都道府県
            </label>
          </div>
          <input type="text" class="form-control bg-white" value="<?php echo $_POST['pref']?>" readonly>
        </div>
        <div class="mb-3">
          <div class="input-group">
            <label for="post" style="display:block">
              市区町村
            </label>
          </div>
          <input type="text" class="form-control bg-white" value="<?php echo $_POST['city']?>" readonly>
        </div>
        <div class="mb-3">
          <div class="input-group">
            <label for="post" style="display:block">
              町域・番地
            </label>
          </div>
          <input type="text" class="form-control bg-white" value="<?php echo $_POST['town']?>" readonly>
        </div>
        <div class="mb-3">
          <div class="input-group">
            <label for="post" style="display:block">
              建物名など
            </label>
          </div>
          <input type="text"  class="form-control bg-white" value="<?php echo $_POST['building']?>" readonly>
        </div>
      </div>
    </div>
  </div>
  <div class="info">
    <h1 class="info-text col-12 col-md-6 text-dark">お支払方法</h1>
  </div>
  <div class="payment col-12 col-md-6">
    <div class="container">
      <?php if($_POST['payment'] == "credit"){ ?>
        <P>クレジットカード決済</p>
      <?php }else{ ?>
        <p>コンビニ決済</p>
      <?php }?>
    </div>
  </div>
  <div class="buttons mx-2">
    <a href="orderInput.php" class="b btn btn-primary">戻る</a>
    <a href="orderFunction.php" class="b btn btn-success">お支払いに進む</a>
  </div>
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
</style>
 
<?php
require './common/footer.php';
?>
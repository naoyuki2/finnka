<?php
require './common/header.php'; 
require './common/db-connect.php';

    $pdo = new PDO ($connect,USER,PASS);

    $sql=$pdo->prepare('select * from user where user_id=?');
    $sql->execute([$_SESSION['id']]);
    $user = $sql->fetch();
?>
<div class="container text-center">
  <div class="row">

    <div class="col-12 col-lg-4">

        <?php
    echo '<img src=',$user['icon_img'],' class="img-fluid" alt="card-horizontal-image">';
    ?>

      <div class="mb-5"></div>
    </div>

    <div class="col-12 col-lg-8">
      <div class="container">
        <div class="row">

          <div class="col-6 col-lg-10 mb-4 mb-lg-3">
            <a href="user-info-login-input.php">
              <button type="submit" class="btn btn-outline-dark userinfoButton bg-light">
                <i class="fa-solid fa-user-pen"></i><br>個人情報変更
              </button>
            </a>
          </div>

            <div class="col-6 col-lg-10 mb-4 mb-lg-3">
            <a href="orderHistory.php">
              <button type="submit" class="btn btn-outline-dark userinfoButton bg-light">
                <i class="fa-solid fa-bag-shopping"></i><br>注文履歴照会
              </button>
            </a>
          </div>

          <div class="col-6 col-lg-10 mb-4 mb-lg-3">
            <a href="accountDelete1.php">
              <button type="submit" class="btn btn-outline-dark userinfoButton bg-light">
                <i class="fas fa-user-slash"></i><br>アカウント削除
              </button>
            </a>
          </div>

          

          <div class="col-6 col-lg-10 mb-4 mb-lg-3">
            <a href="logout.php">
              <button type="submit" class="btn btn-outline-dark userinfoButton bg-light">
                <i class="fa-solid fa-arrow-right-from-bracket"></i><br>ログアウト
              </button>
            </a>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<style>
  .userinfoButton {
    width: 70%;
    padding: 10px;
  }

  .userinfoButton i {
    font-size: 1.8em;
  }
</style>

<?php require './common/footer.php';?>

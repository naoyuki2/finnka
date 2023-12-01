<?php
    require './common/header.php'; 
    require './common/db-connect.php'; 
    $product_id = $_GET['product_id'];


    $pdo = new PDO($connect,USER,PASS);
    $stmt=$pdo->prepare('select * from products where product_id = ?');
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();
?>



<div class="container">
    <div class="row">
        <span class="col-1"></span>
        <div class="col-10">
            <div class="card">
            <div class="card-body">
            <div class="card-header text-muted">
                    <?php 
                    echo '額縁カラー：';
                        echo '<div class="btn-group" role="group" aria-label="Basic radio toggle button group">';
                            echo '<input type="radio" class="btn-check radio black" name="btnGroupRadio" id="btnRadio1" autocomplete="off" checked="">';
                            echo '<label class="btn radio black" for="btnRadio1">BLACK</label>';
                            echo '<input type="radio" class="btn-check radio beige" name="btnGroupRadio" id="btnRadio2" autocomplete="off" checked="">';
                            echo '<label class="btn radio beige" for="btnRadio2">BEIGE</label>';
                            echo '<input type="radio" class="btn-check radio white" name="btnGroupRadio" id="btnRadio3" autocomplete="off" checked="">';
                            echo '<label class="btn radio white" for="btnRadio3">WHITE</label>';
                        echo '</div>';
                        echo '<a href=productDetail.php?product_id='.$product_id.'"><button class="btn btn-secondary">戻る</button></a>';
                    echo '</div>';
                    ?>
                </div>
                    <div class="preview frame-beige" id="p" style="position: absolute;">
                        <?php echo '<img class="image img-fluid" src=',$product['img_pass'],'>';?>
                    </div>
                    <div id="carouselWithIndicators" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselWithIndicators" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselWithIndicators" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselWithIndicators" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="../uploads/room1.jpg" class="d-block w-100" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                        <img src="../uploads/room2.jpg" class="d-block w-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                        <img src="../uploads/room3.jpg" class="d-block w-100" alt="Slide 3">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselWithIndicators" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselWithIndicators" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
        <span class="col-1"></span>
    </div>
</div>

<script>
    
    document.addEventListener('DOMContentLoaded', function() {
 var radios = document.querySelectorAll('input[type=radio]');
 radios.forEach(function(radio) {
  radio.addEventListener('click', function() {
      var frames = Array.from(document.querySelectorAll('.frame-beige, .frame-black, .frame-white'));
      frames.forEach(function(frame) {
          if (frame) {
              frame.classList.remove('frame-black', 'frame-beige','frame-white');
              if (radio.id === 'btnRadio1') {
                frame.classList.add('frame-black');
              } else if (radio.id === 'btnRadio2') {
                frame.classList.add('frame-beige');
              } else if (radio.id === 'btnRadio3') {
                frame.classList.add('frame-white');
              }
          }
      });
  });
 });
});
</script>

<style>
    .preview {
        display: inline-block;
        z-index: 2;
        width: 40%;
        height: 40%;
        margin-top: 14%;
        margin-left: 46%;
    }
    .image {
        width: 100%;
        height: 100%;
    }
    .preview img {
        z-index: 1;
    }
</style>
<?php require './common/footer.php';?>
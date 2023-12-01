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
                    <div class="preview-frame" id="p" style="position: absolute;">
                        <?php echo '<img class="image" src=',$product['img_pass'],'>';?>
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
                <div class="card-footer text-muted">
                    <form action="preview2.php" method="post" id="frameSelectionForm">
                        額縁
                        <input type="radio" name="student" value="#cfb85b">
                        <input type="radio" name="student" value="#201d21">
                        <input type="radio" name="student" value="#9e2020">
                    </form>
                    <?php echo '<a href=productDetail.php?product_id='.$product_id.'"><button>戻る</button></a>';?>
                </div>
            </div>
        </div>
        <span class="col-1"></span>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const frameSelectionForm = document.getElementById('frameSelectionForm');
        const imageContainer = document.getElementById('p');

        frameSelectionForm.addEventListener('change', function(event) {
            if (event.target.name === 'student') {
                const frameColor = event.target.value;
                imageContainer.style.border = `10px solid ${frameColor}`;
            }
        });
    });
</script>

<style>
    .preview-frame {
        margin-left:45%;
        margin-top:15px;
        border-top: 10px solid #b37d4d;
        border-right: 10px solid #b37d4d;
        border-bottom: 10px solid #d2ae7e;
        border-left: 10px solid #d2ae7e;
        box-shadow: inset 0 0 10px #000;
        display: inline-block;
        z-index: 2;
        width: 40%; /* この行を追加 */
        height: 40%; /* この行を追加 */
    }
    .image {
        width: 100%; /* この行を変更 */
        height: 100%; /* この行を変更 */
    }
    .preview-frame img {
        z-index: 1;
    }
</style>
<?php require './common/footer.php';?>
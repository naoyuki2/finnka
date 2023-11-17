<?php
 require './common/header.php'; 
 require './common/db-connect.php'; 
 $product_id = $_GET['product_id'];


    $pdo = new PDO($connect,USER,PASS);
    $stmt=$pdo->prepare('select * from products where product_id = ?');
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();
?>

<?php echo '<a href=productDetail.php?product_id='.$product_id.'"><button>戻る</button></a>';?>

<form action="preview2.php" method="post" id="imageForm">
    <input type="button" value="<" onclick="changeImage(-1)">
    <input type="button" value=">" onclick="changeImage(+1)">
</form>

<div class="container text-center">
    <div class="row">
        <div class="col-12">
            <?php echo '<div style="position: relative;">'; ?>
                <p id="imageContainer" style="position: absolute; top: 0; left: 0;">
                    <img class="img-fluid" alt="image" src="image/sample1.jpg">
                </p>

                <p id="p" style="position: absolute; top: 30; border: 10px solid transparent;">
                    <?php echo '<img alt="image" src=',$product['img_pass'],' width="200" height="250">';?>
                </p>
            <?php echo '</div>'; ?>
        </div>
    </div>
</div>

echo '<div class="col-12 col-md-6 col-lg-4">';
    echo '<div class="card">';
    echo '<div class="frame">';
    echo '<img
    src=',$row['img_pass'],'
    class="card-img-top"
    alt="card-img-top"
    />';
    echo '</div>';
    echo '<a href="productDetail.php?product_id='.$row['product_id'].'">';
    echo '<div class="card-body">
    <h5 class="card-title">',$row['title'],'</h5>
    <p class="card-text">
    ￥',$row['price'],'
    </p>
    </div>';
    echo '</a>';
    echo '</div>';
    echo '</div>';

<form action="preview2.php" method="post" enctype="multipart/form-data" id="changeImageForm">
    <input type="file" name="image" id="imageInput" onchange="previewImage()" style="display: none;">
    <label for="imageInput" style="cursor: pointer;">画像を選択</label>
</form>


<form action="preview2.php" method="post" id="frameSelectionForm">
    額縁
    <input type="radio" name="student" value="#cfb85b">
    <input type="radio" name="student" value="#201d21">
    <input type="radio" name="student" value="#9e2020">
</form>

<script>
    const images = ["../uploads/room1.jpg", "../uploads/room1.jpg", "../uploads/room1.jpg"];
    
    let currentIndex = 0;

    function changeImage(delta) {
        currentIndex += delta;

        if (currentIndex < 0) {
            currentIndex = images.length - 1;
        } else if (currentIndex >= images.length) {
            currentIndex = 0;
        }

        const imageContainer = document.getElementById("imageContainer");
        imageContainer.innerHTML = `<img alt="image" src="${images[currentIndex]}" width="600" height="450">`;
    }
    
    function previewImage() {
        const fileInput = document.getElementById('imageInput');
        const imageContainer = document.getElementById('imageContainer');
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            imageContainer.innerHTML = `<img alt="image" src="${e.target.result}" width="600" height="450">`;
        };

        reader.readAsDataURL(file);
    }

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

    document.addEventListener("DOMContentLoaded", function() {
        changeImage(0);
    });
</script>
</body>
</html>
<?php require './common/footer.php';?>
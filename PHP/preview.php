<?php require './common/header.php'; ?>
<?php require './common/db-connect.php'; ?>


<form action="productDetail.php" method="post">
    <input type="submit" value="戻る">
</form>

<form action="preview2.php" method="post" id="imageForm">
    <input type="button" value="<" onclick="changeImage(-1)">
    <input type="button" value=">" onclick="changeImage(+1)">
</form>

<p id="imageContainer">
    <img alt="image" src="image/sample1.jpg" width="600" height="450">
</p>

<p id="p" style="width: 220px; height: 270px; border: 10px solid transparent; display: inline-block;">
<img alt="image" src="image/商品.jpg" width="200" height="250">
</p>

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
    const images = ["image/sample1.jpg", "image/sample2.jpg", "image/sample3.jpg"];
    
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
</script>
<?php require './common/footer.php';?>
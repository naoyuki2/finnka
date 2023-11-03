<?php
    require './common/header.php';
    require './common/db-connect.php';?>

    <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="product_image" id="product_image">
    <input type="submit" value="Upload Image" name="submit">
    </form>

    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ファイルがアップロードされていることを確認
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $uploaded_file = $_FILES['product_image'];

        // ファイルの拡張子を確認
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = pathinfo($uploaded_file['name'], PATHINFO_EXTENSION);
        if (in_array($file_extension, $allowed_extensions)) {
            // 保存先のパスを指定
            $destination = '../uploads/' . $uploaded_file['name'];

            // ファイルを指定した場所に移動
            if (!file_exists('../uploads')) {
                mkdir('uploads', 0777, true);
            }            
            if (move_uploaded_file($uploaded_file['tmp_name'], $destination)) {
                echo "File uploaded successfully.";
                echo "<img src='".$destination."' />";
                echo "<p>$destination</p>";
            } else {
                echo "Failed to upload file.";
            }
        } else {
            echo "Invalid file extension.";
        }
    } else {
        echo "No file uploaded.";
    }
}
?>

<?php require './common/footer.php';?>
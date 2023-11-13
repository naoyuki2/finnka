<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 require './common/header.php';
 require './common/db-connect.php';?>

<?php
    $pdo=new PDO($connect, USER, PASS);
    $sqlCategory=$pdo->query('select * from category');
    $sqlAuthor=$pdo->query('select * from author');
    if (isset($_SESSION['insertMessage'])) {
        echo '<p class="insertMessage">' . $_SESSION['insertMessage'] . '</p>';
        unset($_SESSION['insertMessage']); // エラーメッセージを表示したら、セッション変数から削除します
    }
    if (isset($_SESSION['dbMessage'])) {
        echo '<p class="dbMessage">' . $_SESSION['dbMessage'] . '</p>';
        unset($_SESSION['dbMessage']); // エラーメッセージを表示したら、セッション変数から削除します
    }
?>

<form action="productsInsertOutput.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col">
                <input class="form-control" type="file" name="product_image" id="product_image">
                <div class="input-group input-group-lg ms-auto">
                    <span class="input-group-text" id="input-group-lg-example ">タイトル</span>
                    <input name="title" type="text" class="form-control" aria-label="Large input group" aria-describedby="input-group-lg">
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="input-group-lg-example">カテゴリ</span>
                    <input name="category" list="category-list" class="form-control form-control-lg" aria-label="Large select">
                    <datalist id="category-list">
                        <?php
                            foreach($sqlCategory as $row){
                                echo "<option value=",$row['category_name'],">",$row['category_name'],"</option>";
                            };
                        ?>
                    </datalist>
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="input-group-lg-example">作者</span>
                    <input name="author" list="author-list" class="form-control form-control-lg" aria-label="Large select">
                    <datalist id="author-list">
                        <?php
                            foreach($sqlAuthor as $row){
                                echo "<option value=",$row['author_name'],">",$row['author_name'],"</option>";
                            };
                        ?>
                    </datalist>
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="input-group-lg-example">作者の思い</span>
                    <input name="thought" type="text" class="form-control" aria-label="Large input group" aria-describedby="input-group-lg">
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="input-group-lg-example">金額</span>
                    <input name="price" type="text" class="form-control" aria-label="Large input group" aria-describedby="input-group-lg">
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="input-group-lg-example">在庫</span>
                    <input name="stock" type="number" class="form-control" aria-label="Large input group" aria-describedby="input-group-lg">
                </div>
                <input type="submit" class="btn btn-primary" value="商品を登録する" name="submit">
            </div>
        </div>
    </div>

</form>

<?php require './common/footer.php';?>

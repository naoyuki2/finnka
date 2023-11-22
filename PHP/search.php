<?php
require './common/header.php';
require './common/db-connect.php';

$pdo = new PDO($connect, USER, PASS);
$dbCategory = $pdo->query('select * from category');
$dbAuthor = $pdo->query('select * from author');
?>
<div class="mb-4"></div>
<form action="result.php" method="post">
    <div class="container text-center">
        <div class="row">
            <div class="col-12 col-md-12">

                <div class="input-group">

                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text">タイトル　<i class="fa-solid fa-magnifying-glass"></i></span>
                        <?php
                        echo '<input value="', (empty($_POST['title']) ? "" : $_POST['title']), '" name="title" type="text" class="form-control" aria-label="Large input group" aria-describedby="input-group-lg" placeholder="すべてのタイトル...">';
                        ?>
                    </div>


                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="input-group-lg-example">カテゴリ　<i class="fa-solid fa-magnifying-glass"></i></span>
                        <select name="category" class="form-select form-select-lg" aria-label="Large select">
                            <option value=""></option>
                            <?php
                            foreach ($dbCategory as $row) {
                                $selected = ($_POST['category'] == $row['category_id']) ? 'selected' : '';
                                echo '<option value ="' . $row['category_id'] . '" ' . $selected . '>', $row['category_name'], '</option>';
                            }
                            ?>
                        </select>
                    </div>


                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="input-group-lg-example">作者名　<i class="fa-solid fa-magnifying-glass"></i></span>
                        <select name="author" class="form-select form-select-lg" aria-label="Large select">
                            <option value=""></option>
                            <?php
                            foreach ($dbAuthor as $row) {
                                $selected = ($_POST['author'] == $row['author_id']) ? 'selected' : '';
                                echo '<option value ="' . $row['author_id'] . '" ' . $selected . '>', $row['author_name'], '</option>';
                            }
                            ?>
                        </select>
                    </div>


                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="input-group-lg-example">金額　　<i class="fa-solid fa-magnifying-glass"></i></span>
                        <?php
                        echo '<input value="', (empty($_POST['price']) ? "" : $_POST['price']), '" name="price" type="text" class="form-control" aria-label="Large input group" aria-describedby="input-group-lg" placeholder="1000...10000...">';
                        ?>
                        <span class="input-group-text">円以下</span>
                    </div>


                    <div class="container text-center">
                        <div class="mb-4"></div>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-magnifying-glass"></i>　検索　</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
require './common/footer.php';
?>

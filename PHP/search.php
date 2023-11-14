<?php
    require './common/header.php';
    require './common/db-connect.php';

    $pdo=new PDO($connect, USER, PASS);
    $dbCategory=$pdo->query('select * from category');
    $dbAuthor=$pdo->query('select * from author');
    ?>

    <form action="result.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text" id="input-group-lg-example">タイトル</span>
                        <?php
                            echo '<input value="',(empty($_POST['title']) ? "" : $_POST['title']),'" name="title" type="text" class="form-control" aria-label="Large input group" aria-describedby="input-group-lg">';
                        ?>
                    </div>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text" id="input-group-lg-example">カテゴリ</span>
                        <select name= "category" class="form-select form-select-lg" aria-label="Large select">
                        <option value=""></option>
                        <?php
                        foreach($dbCategory as $row){
                            $selected = ($_POST['category'] == $row['category_id']) ? 'selected' : '';
                            echo '<option value ="' . $row['category_id'] . '" ' . $selected . '>',$row['category_name'],'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text" id="input-group-lg-example">作者名</span>
                        <select name= "author" class="form-select form-select-lg" aria-label="Large select">
                        <option value=""></option>
                        <?php
                        foreach($dbAuthor as $row){
                            $selected = ($_POST['author'] == $row['author_id']) ? 'selected' : '';
                            echo '<option value ="' . $row['author_id'] . '" ' . $selected . '>',$row['author_name'],'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text" id="input-group-lg-example">金額</span>
                        <?php
                            echo '<input value="',(empty($_POST['price']) ? "" : $_POST['price']),'" name="price" type="text" class="form-control" aria-label="Large input group" aria-describedby="input-group-lg">';
                        ?>
                   </div>
                   <div class="order d-flex justify-content-center">
                        <button type="submit" class="order_button btn btn-outline-secondary w-100">検索する</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php
    require './common/footer.php';
?>
<?php require './common/header.php';?>
<?php require './common/db-connect.php';?>
    
    <form action="search.php" method="post">
        <input type="hidden" name="title" value="<?php echo $_POST['title']; ?>">
        <input type="hidden" name="category" value="<?php echo $_POST['category']; ?>">
        <input type="hidden" name="author" value="<?php echo $_POST['author']; ?>">
        <input type="hidden" name="price" value="<?php echo $_POST['price']; ?>">
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <div class="input-group input-group-lg">
                            <span class="form-control" aria-label="Large input group" aria-describedby="input-group-lg">
                            <?php
                                echo '<span>',$_POST['title'],'、',$_POST['category'],'、',$_POST['author'],'、',$_POST['price'],'</span>';
                            ?>
                            </span>
                            <button type="submit" class="input-group-text" id="input-group-lg-example">再検索画面へ</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    
    <?php
    $pdo=new PDO($connect,USER,PASS);
    if(empty($_POST['title']) && empty($_POST['category']) && empty($_POST['author']) && empty($_POST['price'])){
        $sql=$pdo->query('select * from products');
    }else{
        $params = [];
        $query = 'SELECT * FROM products WHERE 1=1';
        
        if (!empty($_POST['title'])) {
            $query .= ' AND title LIKE ?';
            $params[] = '%'.$_POST['title'].'%';
        }
        
        if (!empty($_POST['category'])) {
            $query .= ' AND category_id = ?';
            $params[] = $_POST['category'];
        }
        
        if (!empty($_POST['author'])) {
            $query .= ' AND author_id = ?';
            $params[] = $_POST['author'];
        }
        
        if (!empty($_POST['price'])) {
            $query .= ' AND price <= ?';
            $params[] = $_POST['price'];
        }
        
            $sql = $pdo->prepare($query);
            $sql->execute($params);
    }
    ?>
    <div class="container text-center">
      <div class="row">
    <?php
    if(isset($sql)){
        $results = $sql->fetchAll();
        $count = count($results);
        foreach($results as $row){
            echo '<div class="col-12 col-md-6 col-lg-4">';
                echo '<div class="card">';
                    echo '<img
                        src=',$row['img_pass'],'
                        class="card-img-top"
                        alt="card-img-top"
                    />';
                    echo '<div class="card-body">
                        <h5 class="card-title">',$row['title'],'</h5>
                        <p class="card-text">
                        ￥',$row['price'],'
                        </p>
                    </div>';
                echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    echo '</div>';
    echo '<p>検索結果は', $count, '件です。</p>';
    }else{
        echo '<p></p>';
    }
    // ?>
<?php require './common/footer.php';?>
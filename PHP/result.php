<?php require './common/header.php';?>
<?php require './common/db-connect.php';?>
    
    <form action="test.php" method="post">
    <input type="hidden" name="title" value="<?php echo $_POST['title']; ?>">
    <input type="hidden" name="category" value="<?php echo $_POST['category']; ?>">
    <input type="hidden" name="author" value="<?php echo $_POST['author']; ?>">
    <input type="hidden" name="price" value="<?php echo $_POST['price']; ?>">
    <?php
    echo '<div>';
    echo '<span>検索条件：',$_POST['title'],'、',$_POST['category'],'、',$_POST['author'],'、',$_POST['price'],'</span>';
    echo '<button type="submit">再検索</button>';
    echo '</div>';
    ?>
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
    <?php
    if(isset($sql)){
        $results = $sql->fetchAll();
        $count = count($results);
        foreach($results as $row){
            echo '<div>';
            echo '<a href="product_detail.php?id='.$row['product_id'].'">';
            echo '<img src=',$row['img_pass'],'alt="art">';
            echo '<br>';
            echo '<p>',$row['title'],'</p>';
            echo '<p>',$row['price'],'円</p>';    
            echo '</a>';
            echo '</div>';
        }
        echo '<p>検索結果は', $count, '件です。</p>';
    }else{
        echo '<p></p>';
    }
    // ?>
<?php require './common/footer.php';?>
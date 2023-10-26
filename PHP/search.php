<?php
    require './common/header.php';
    require './common/db-connect.php';

    echo '<p>商品検索画面</p>';
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->query('select * from category');
    
        echo '<input type="submit" value="  戻る  "><br>';
        echo "タイトル", '<input type="text" name="name"><br>';
        echo 'カテゴリー ','<select name= "category">';
    foreach($sql as $row){
        
                       echo '<option value =',$row['category_id'],' >',$row['category_name'],'</option>';
    }
echo "</select>","<br>";
    $sql=$pdo->query('select * from author');
    echo  "作者名",'<select name= "author">';
    foreach($sql as $row){

                        echo '<option value = ',$row['author_id'], '>',$row['author_name'],'</option>';
                         }
                         echo "<select><br>";
                         
        
            echo "価格",'<div class="slider-container">';
            echo  '<input type="range" min="0" max="5000" value="0" step="1" class="slider" id="priceRange">';
            echo  '<p class="range-label">',"価格:",'<span id="priceValue">','</span>','円','</p>';
                    echo '</div>';
    
    

            echo '<input type="submit" value="検索">';

            require './common/footer.php';

    
?>


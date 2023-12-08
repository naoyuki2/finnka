<link rel="stylesheet" href="../CSS/accountDelete1.css">
<?php
    require './common/header.php';
    require './common/db-connect.php';

    
    echo "<div style='text-align:center'><h1>アカウント削除</h1>";
    echo "<p>注意</p>";
    echo "<p>アカウントを削除するとすべての<br>";
    echo "登録データが削除されます";
    echo "<br>";
    

    
    echo '<div class="button-width" style="display:inline-flex">
<form action="userInfo.php" method="post"><button type="cancel"class="btn btn-success  btn-lg me-5">キャンセル</button></form>
<form  action="accountDelete2.php" method="post"><button type="submit"class="btn btn-danger btn-lg mh-5">削除</button></form>
</div>';  

    require './common/footer.php';
?>
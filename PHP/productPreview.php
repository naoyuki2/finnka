<!-- 商品詳細画面(productDetail.php)から遷移してくる画面。 -->
<?php
    require './common/header.php';
    
    // productDetail.phpでpostでimg_passが送られるためそれを受け取る
    if(isset($_POST['img_pass'])){
        $img_pass = $_POST['img_pass'];
        echo $img_pass;
        // 下記を見た目を気にせずにとりあえず動くようにする
        // 難しめのところはパスでもＯＫ
        // １．戻るボタン(productDetail.phpに戻るaタグ)
        // ２ー１．商品画像を表示する(productDetailから受け取った$img_passで画像を表示する)
        // ２－２．商品画像に額縁を付ける(おそらくＣＳＳでどうにかする)
        // ３．背景(難しめ)(部屋の背景をネットからダウンロードしてきて商品画像の背面に配置する)
        // ４．画像を変更ボタン(難しめ)(背景画像をユーザーにアップロードさせる)
        // ５．右と左の＜＞(難しめ)(背景の画像が変更される)
        // ６．額縁色変更(難しめ)(ラジオボタンで商品画像の額縁の色を変更する)
    } else {
        echo '製品IDが指定されていません。';
    }

    require './common/footer.php';
?>
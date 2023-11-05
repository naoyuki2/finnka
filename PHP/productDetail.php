<!-- トップページや検索結果画面で表示された商品をクリックされてこのページに遷移してくる。 -->
<?php
    require './common/header.php';
    require './common/db-connect.php';
    
    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        echo $product_id;
        // 下記を見た目を気にせずにとりあえず動くようにする
        // １．商品画像(productsテーブルから$product_idで検索してimg_passを取得)
        // ２．タイトル(productsテーブルからtitleを取得)
        // ３．作者(productsテーブルからauthor_idを取得し、それをもとにauthorテーブルからauthor_nameを取得)
        // ４．作者の思い(productsテーブルからthoughtを取得)
        // ５．金額(productsテーブルからpriceを取得)
        // ６．数量(セレクトボックス、初期値に１を設定)
        // ７．額縁の色３種類(ラジオボタン)
        // ８．プレビューボタン(プレビュー画面に遷移、button=typeをsubmitにして商品画像のパスを送るname='img_pass')
        // ９．カートに入れるボタン(カート追加処理起動＆カート表示画面に遷移)
        // １０．今すぐ購入ボタン(注文情報入力画面に遷移)
        // １１．戻るボタン(top.phpまたはresult.phpに遷移、おそらくsessionを利用する)
    } else {
        echo '製品IDが指定されていません。';
    }

    require './common/footer.php';
?>
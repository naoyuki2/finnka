<!-- 商品詳細画面、ヘッダーのカートアイコンから遷移してくる画面 -->
<?php
    require './common/header.php';
    require './common/db-connect.php';
    
    １．カート内のアートなどのHTMLを記述。
    ２．$_SESSION['id']でuse_idを取り出す。
    ３．user_idでcartテーブルを検索し、cart_idを取り出す。
    ４．cart_idからcartDetailテーブルを検索し、product_id(商品ID)とquantity(数量)を取り出す。
    ５．product_id,とquantityを使って商品テーブルを検索しx注文情報(タイトル、作者、数量、金額)を出力する。
    ６．数量を変数で数えて□点を出力。
    ７．数量×金額を計算し、合計して出力。
    ８．×ボタンでdelete処理を実行。
    ９．注文するボタンで注文情報入力画面(orderInput.php)に遷移する。

    require './common/footer.php';
?>
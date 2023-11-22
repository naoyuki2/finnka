<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $uploaded_file = $_FILES['product_image'];
    if(!empty($uploaded_file['name'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // ファイルがアップロードされていることを確認
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
            $uploaded_file = $_FILES['product_image'];

            // ファイルの拡張子を確認
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
            $file_extension = pathinfo($uploaded_file['name'], PATHINFO_EXTENSION);
            if (in_array($file_extension, $allowed_extensions)) {
                // 保存先のパスを指定
                $destination = '../uploads/' . $uploaded_file['name'];

                // ファイルを指定した場所に移動
                if (!file_exists('../uploads')) {
                    mkdir('uploads', 0777, true);
                }            
                if (move_uploaded_file($uploaded_file['tmp_name'], $destination)) {
                    $_SESSION['updateMessage'] = "File uploaded successfully.";
                    header('Location: admin-edit-input.php?product_id='.$_POST['product_id'].'');
                } else {
                    $_SESSION['updateMessage'] = "Failed to upload file.";
                    header('Location: admin-edit-input.php?product_id='.$_POST['product_id'].'');
                }
            } else {
                $_SESSION['updateMessage'] = "Invalid file extension.";
                header('Location: admin-edit-input.php?product_id='.$_POST['product_id'].'');
            }
        } else {
            $_SESSION['updateMessage'] = "No file uploaded.";
            header('Location: admin-edit-input.php?product_id='.$_POST['product_id'].'');
        }
    }
    }else{
        $destination = "";
    }


    require './common/db-connect.php';

    $pdo=new PDO($connect, USER, PASS);

    // カテゴリの存在チェック
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM category WHERE category_name = ?");
    $stmt->execute([$_POST['category']]);
    $count = $stmt->fetchColumn();
    if ($count == 0) {
        // カテゴリが存在しない場合、新しいカテゴリを追加
        $stmt = $pdo->prepare("INSERT INTO category (category_name) VALUES (?)");
        $stmt->execute([$_POST['category']]);
    }

    // 著者の存在チェック
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM author WHERE author_name = ?");
    $stmt->execute([$_POST['author']]);
    $count = $stmt->fetchColumn();
    if ($count == 0) {
        // 著者が存在しない場合、新しい著者を追加
        $stmt = $pdo->prepare("INSERT INTO author (author_name) VALUES (?)");
        $stmt->execute([$_POST['author']]);
    }

    //カテゴリのidを取得
    $stmt = $pdo->prepare("SELECT category_id FROM category WHERE category_name = ?");
    $stmt->execute([$_POST['category']]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC)['category_id'];

    //著者のidを取得
    $stmt = $pdo->prepare("SELECT author_id FROM author WHERE author_name = ?");
    $stmt->execute([$_POST['author']]);
    $author = $stmt->fetch(PDO::FETCH_ASSOC)['author_id'];

    //img_passを取得
    if($destination == ""){
        $stmt = $pdo->prepare("SELECT img_pass FROM products WHERE product_id = ?");
        $stmt->execute([$_POST['product_id']]);
        $destination = $stmt->fetch(PDO::FETCH_ASSOC)['img_pass'];
    }

    if(empty($_POST['title']) || empty($category) || empty($author) || empty($_POST['thought']) || empty($_POST['price']) || empty($destination)){
        $_SESSION['updateMessage'] = "未入力の項目があります";
        header('Location: admin-edit-input.php?product_id='.$_POST['product_id'].'');
    }

    $sql=$pdo->prepare('update products set title = ? ,category_id = ? ,author_id = ? ,thought = ? ,price = ? ,img_pass = ? where product_id = ?');
    $sql->execute([
        $_POST['title'],
        $category,
        $author,
        $_POST['thought'],
        $_POST['price'],
        $destination,
        $_POST['product_id']
    ]);

    $stmt=$pdo->prepare('select * from products where title = ?');
    $stmt->execute([$_POST['title']]);
    $product_id = $stmt->fetch();

    $sql=$pdo->prepare('update stock set quantity = ? where product_id = ?');
    $sql->execute([
        $_POST['stock'],
        $product_id['product_id']
    ]);

    $_SESSION['dbMessage'] = "DB inserted successfully.";
    header('Location: admin-edit-input.php?product_id='.$_POST['product_id'].'');
    exit;
?>

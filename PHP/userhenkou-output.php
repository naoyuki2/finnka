<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require './common/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user_name'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['password_confirmation'] ?? '';
    $errors = [];
    $pdo = new PDO ($connect,USER,PASS);
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE user_name = :username");
    $stmt->execute(['username' => $username]);
    $count = $stmt->fetchColumn();

    // バリデーション
    if ($count > 0) {
        $errors['user_name'] = 'そのユーザーネームは使われています。';
    }

    if (strlen($username) > 20) {
        $errors['user_name'] = 'ユーザーネームは20文字以内にしてください。'; 
    }
    if (strlen($password) < 8 || strlen($password) > 20) {
        $errors['password'] = 'パスワードは８文字以上20文字以内で設定してください。'; 
    } elseif (!preg_match('/^[a-zA-Z0-9]*$/', $password)) {
        $errors['password'] = 'パスワードは半角英数字で設定してください。';
    }
    if ($password !== $confirmPassword) {
        $errors['password_confirmation'] = '入力されたパスワードが一致しません。'; 
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: userhenkou-input.php');
        exit;
    }

    $salt = substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, 20);
    $passwordHash = password_hash($password . $salt, PASSWORD_DEFAULT);
    $destination = null;

     // プロファイル画像のアップロード処理
     $destination = '../uploads/default_icon.jpg'; // デフォルトのアイコンパス
     if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
         $uploaded_file = $_FILES['profile_image'];
         $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
         $file_extension = pathinfo($uploaded_file['name'], PATHINFO_EXTENSION);
 
         if (in_array($file_extension, $allowed_extensions)) {
             $destination = '../uploads/' . $uploaded_file['name'];
 
             if (!file_exists('../uploads')) {
                 mkdir('../uploads', 0777, true);
             }
 
             if (!move_uploaded_file($uploaded_file['tmp_name'], $destination)) {
                 die('ファイルのアップロードに失敗しました。');
             }
         } else {
             die('無効なファイル拡張子です。');
         }
     }

    try {
        $query = "UPDATE user SET user_name = :new_user_name, hash = :hash, salt = :salt, icon_img = :icon_img WHERE user_name = :old_user_name";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
        'new_user_name' => $username,
        'hash' => $passwordHash,
        'salt' => $salt,
        'icon_img' => $destination, // 画像のパス
        'old_user_name' => $_SESSION['user_name'] // セッションに保存された古いユーザー名
    ]);

        // データベース更新に成功した場合、適切なページにリダイレクト
        if ($stmt->rowCount() > 0) {
            $_SESSION['user_name'] = $username; // セッションに新しいユーザー名を保存
            header('Location: top.php');
            exit;
        } else {
            echo "更新できませんでした。";
        }
    } catch (PDOException $e) {
        echo "データベースエラー: " . $e->getMessage();
    }
}
?>


    
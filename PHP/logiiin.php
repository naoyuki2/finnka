<?php
require './common/header.php';
require './common/db-connect.php';

echo '<p>ログイン画面</p>';

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    $server = 'mysql218.phy.lolipop.lan';
    $dbname = 'LAA1516883-finnka';
    $user = 'LAA1516883';
    $pass = 'Pass2326';

    try {
        $pdo = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $user, $pass);
        // ユーザー名のみで検索
        $stmt = $pdo->prepare("SELECT * FROM user WHERE user_name = ?");
        $stmt->execute([$usernameInput]);
        $result = $stmt->fetch();

        // password_verify関数を使用してハッシュ化されたパスワードと入力されたパスワードを比較
        if ($result && password_verify($passwordInput, $result['password'])) {
            header('Location: target_page.php');
            exit;
        } else {
            $errorMessage = "ユーザーネームまたはパスワードが正しくありません。";
        }
    } catch (PDOException $e) {
        $errorMessage = "データベースエラー: " . $e->getMessage();
    }
}

require './common/footer.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
        }

        .btn {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .show-password-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>ログイン</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">ユーザーネーム</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="form-group show-password-label">
            <label>パスワードを表示する</label>
            <input type="checkbox" id="showPassword" onchange="togglePasswordVisibility()">
        </div>
        <button type="submit" name="login" class="btn">ログイン</button>
    </form>
    <p class="error-message"><?= $errorMessage ?></p>
    <p><a href="リンク先">アカウントをお持ちではない方</a></p>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var checkbox = document.getElementById("showPassword");

        if (checkbox.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>

</body>
</html>

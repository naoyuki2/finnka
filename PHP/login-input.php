<?php
session_start();
require './common/login-header.php';
require './common/db-connect.php';
$errorMessage = "";
if (isset($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']);  // エラーメッセージをクリア
}
?>

<div class="login-container">
    <h2>ログイン</h2>
    <form action="login-output.php" method="post">
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
    <?php if ($errorMessage): ?>
    <p class="error-message"><?= $errorMessage ?></p>
    <?php endif; ?>
    <p><a href="new-login-input.php">アカウントをお持ちではない方</a></p>
</div>

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

<?php
require './common/footer.php';
?>

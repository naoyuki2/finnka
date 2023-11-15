<?php
session_start();
require './common/login-header.php';



$user_name=$password1=$password2='';
$error = '';
if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user']['user_name'];
    $password1 = $_SESSION['user']['password'];
}
echo '<div class="login-container">';
    if (isset($_SESSION['error_message'])) {
        echo '<p class="error-message">' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']); // エラーメッセージを表示したら、セッション変数から削除します
    }

    echo '<form action="login-input.php" method="post">';
    echo '<input type="submit" value="戻る">';
    echo '</form>';

    echo '<form action="new-login-output.php" method="post">';

        echo '<div class="form-group">';
            echo '<label for="username">ユーザーネーム</label>';
            echo '<input class="form-control" type="text" name="user_name" value="', $user_name, '">';
        echo '</div>';

        echo '<div class="form-group">';
            echo '<label for="password">パスワード</label>';
            echo '<input class="form-control" id="pass" type="password" name="password" value="', $password1, '">';
        echo '</div>';

        echo '<div class="form-group show-password-label">';
            echo '<label>パスワードを表示する</label>';
            echo '<input type="checkbox" id="show_password">';
        echo '</div>';

        echo '<div class="form-group">';
            echo '<label for="password">パスワード確認</label>';
            echo '<input class="form-control" id="pass2" type="password" name="password2" value="', $password2, '">';
        echo '</div>';

        echo '<div class="form-group show-password-label">';
            echo '<label>パスワードを表示する</label>';
            echo '<input type="checkbox" id="show_password2">';
        echo '</div>';


        echo '<input type="submit" value="登録">';
        echo '</div>';
    echo '</form>';
echo '</div>';
?>


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
document.addEventListener("DOMContentLoaded", function() {
    const showPasswordCheckbox = document.getElementById("show_password");
    const passwordInput = document.getElementById("pass");

    const showPasswordCheckbox2 = document.getElementById("show_password2");
    const passwordInput2 = document.getElementById("pass2");

    showPasswordCheckbox.addEventListener("change", function() {
        if (showPasswordCheckbox.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });

    showPasswordCheckbox2.addEventListener("change", function() {
        if (showPasswordCheckbox2.checked) {
            passwordInput2.type = "text";
        } else {
            passwordInput2.type = "password";
        }
    });
});
</script>

<?php require './common/footer.php';?>
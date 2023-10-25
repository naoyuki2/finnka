<?php session_start(); ?>

<?php
$user_name=$password1=$password2='';
$error = '';
if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user']['user_name'];
    $password1 = $_SESSION['user']['password'];
}

echo '<form action="login.php" method="post">';
echo '<input type="submit" value="戻る">';
echo '</form>';

    echo '<form action="new-login-output.php" method="post">';
    echo '<table>';

    echo '<tr><td>ユーザーネーム</td><td>';
    echo '<input type="text" name="user_name" value="', $user_name, '">';
    echo '</td></tr>';

    echo '<tr><td>パスワード</td><td>';
    echo '<input id="pass" type="password" name="password" value="', $password1, '"><br>';
    echo '<input id="show_password" type="checkbox">パスワードを表示する';
    echo '</td></tr>';

    echo '<tr><td>パスワード確認</td><td>';
    echo '<input id="pass2" type="password" name="password2" value="', $password2, '"><br>';
    echo '<input id="show_password2" type="checkbox">パスワードを表示する';
    echo '</td></tr>';

    echo '</table>';
    echo '<input type="submit" value="登録">';
    echo '</form>';
?>

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
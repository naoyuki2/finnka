<?php require './common/header.php'; ?>

<form action="user-info-login-output.php" method="post">
    <table>
        <tr>
            <td>ユーザーネーム</td>
            <td><input type="text" name="user_name"></td>
        </tr>
        <tr>
            <td>現在のパスワード</td>
            <td>
                <input id="pass" type="password" name="password"><br>
                <input id="show_password" type="checkbox">パスワードを表示する
            </td>
        </tr>
    </table>
    <input type="submit" value="認証">
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const showPasswordCheckbox = document.getElementById("show_password");
    const passwordInput = document.getElementById("pass");

    showPasswordCheckbox.addEventListener("change", function() {
        if (showPasswordCheckbox.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
});
</script>

<?php require './common/footer.php'; ?>

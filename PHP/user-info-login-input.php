<?php
 require './common/header.php'; 

    if(empty($_SESSION['user-info-error'])){
        $errorMessage = "";
    }else{
        $errorMessage = $_SESSION['user-info-error'];
        unset($_SESSION['user-info-error']);
    }
?>

            


    


<div class="login-container">
    <h2>本人確認</h2>
<form action="user-info-login-output.php" method="post">
    <div class="form-group">
    
        
            <label for="username">ユーザーネーム</label>
            <input type="text" name="user_name" class="form-control" required>
        
        </div>
        <div class="form-group">
            <label for="password">現在のパスワード</label>
            
                <input id="pass" type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group show-password-label">
            <label>パスワードを表示する</label>
                <input id="show_password" type="checkbox" onchange="togglePasswordVisibility()">
            </div>
        
    
    <button type="submit" value="認証" class="btn">認証</button>
</form>
<br>
    <?php if ($errorMessage): ?>
    <p class="error-message"><?= $errorMessage ?></p>
    <?php endif; ?>

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

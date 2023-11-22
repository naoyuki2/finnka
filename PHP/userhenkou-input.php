<?php
require './common/header.php';
require './common/db-connect.php';

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']); // エラーメッセージをセッションから削除
?>

    <style>
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* お好みでサイズを調整してください */
            margin: auto;
        }

        #profile-picture {
            width: 200px; /* 画像の大きさに合わせます */
            height: 200px; /* 画像の大きさに合わせます */
            background-color: #efefef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 20px auto 30px;
            border: 1px solid #dcdcdc;
        }

        #profile-picture img {
            display: block; /* 画像を中央に配置します */
            width: 100%;
            height: auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 6px 0 16px;
            display: block;
            border: 1px solid #dcdcdc;
            border-radius: 4px;
            box-sizing: border-box; /* パディングを含めた幅で表示させます */
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
        }

        .button:hover {
            background-color: #45a049;
        }

        .change-icon {
            cursor: pointer;
            text-align: center;
            display: block;
            background-color: #f0f0f0;
            color: #555;
            padding: 6px 12px;
            border-radius: 4px;
            margin-top: -30px; /* アイコン変更ボタンを上に持っていきます */
            margin-bottom: 20px;
            text-decoration: none;
        }

        .error {
        color: red;
        font-size: 12px; 
    }
    </style>
<?php
    $pdo=new PDO($connect,USER,PASS);
    $stmt=$pdo->prepare('select * from user where user_id = ?');
    $stmt->execute([$_SESSION['id']]);
    $user = $stmt->fetch();
?>

<div class="form-container">
    <div id="profile-picture">
        <!-- DBから現在の画像を取得、またはsession -->
        <?php echo'<img src='.$user['icon_img'].' alt='.$user['icon_img'].'id="profile-img-tag"/>';?>
    </div>

    <form action="userhenkou-output.php" method="post" enctype="multipart/form-data">
        <label for="profile-image" class="change-icon">アイコンを変更</label>
        <input type="file" id="profile-image" name="profile_image" style="display: none;">

        <div class="form-group">
            <label for="user_name">新しいユーザー名</label>
            <input type="text" id="user_name" name="user_name" class="form-control" required value="<?php echo htmlspecialchars($_POST['user_name'] ?? '', ENT_QUOTES); ?>">
            <?php if (isset($errors['user_name'])): ?>
                <div class="error"><?php echo htmlspecialchars($errors['user_name']); ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">新しいパスワード</label>
            <input type="password" id="password" name="password" class="form-control" required>
            <div class="form-group show-password-label">
            <input type="checkbox" id="show_password">パスワードを表示する
            </div>
            <?php if (isset($errors['password'])): ?>
                <div class="error"><?php echo htmlspecialchars($errors['password']); ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            <div class="form-group show-password-label">
            <input type="checkbox" id="show_password2">パスワードを表示する
            </div>
            <?php if (isset($errors['password_confirmation'])): ?>
                <div class="error"><?php echo htmlspecialchars($errors['password_confirmation']); ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="button">変更する</button>
    </form>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                document.getElementById('profile-img-tag').setAttribute('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    document.getElementById('profile-image').addEventListener('change', function() {
        readURL(this);
    });

    document.addEventListener("DOMContentLoaded", function() {
    const showPasswordCheckbox = document.getElementById("show_password");
    const passwordInput = document.getElementById("password");

    const showPasswordCheckbox2 = document.getElementById("show_password2");
    const passwordInput2 = document.getElementById("password_confirmation");

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

<?php require './common/footer.php'; ?>
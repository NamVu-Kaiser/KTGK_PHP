<?php
require_once("entities/user.class.php");

// Kiểm tra xem đã nhận dữ liệu từ biểu mẫu đăng nhập chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Tạo một đối tượng User và gọi phương thức login
    $user = new User();
    $user->login($username, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post">
        <h2>Đăng nhập</h2>
        <?php if(isset($loginError)) { echo "<p style='color: red;'>$loginError</p>"; } ?>
        <div>
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <input type="submit" value="Đăng nhập">
        </div>
    </form>
</body>
</html>

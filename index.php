<?php
session_start();
require_once("entities/user.class.php");

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$user = new User();
$username = $_SESSION["username"];
$userRole = $user->getUserRole($username);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $userFullName = $user->getUserFullName($username);
    if ($userFullName) {
        echo "<p>Xin chào, $userFullName!</p>";
    }
    ?>
    <div class="logout-button">
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
    <h1>THÔNG TIN NHÂN VIÊN</h1>
    <?php if($userRole == 'Admin'): ?>
    <a href="add_employee.php">THÊM NHÂN VIÊN</a>
    <?php endif; ?>
    <table class="w3-table-all w3-large">
        <tr>
            <th>Mã nhân viên</th>
            <th>Tên nhân viên</th>
            <th>Giới tính</th>
            <th>Nơi sinh</th>
            <th>Tên phòng</th>
            <th>Lương</th>
            <?php if($userRole == 'Admin'): ?>
            <th>Action</th>
            <th>Action</th>
            <?php endif; ?>
        </tr>
        <?php
            require_once("entities/employee.class.php");

            // Fetch employee data from the database
            $employees = Employee::list_employee();

            // Loop through each employee and display their information in a row
            foreach ($employees as $employee) {
                echo "<tr>";
                echo "<td>{$employee['manv']}</td>";
                echo "<td>{$employee['tennv']}</td>";
                echo "<td>";
                if ($employee['phai'] == 'Nam') {
                    echo "<img src='images/man.png' alt='Man'>";
                } elseif ($employee['phai'] == 'Nữ') {
                    echo "<img src='images/woman.png' alt='Woman'>";
                } else {
                    echo "Unknown";
                }
                echo "</td>";
                echo "<td>{$employee['noisinh']}</td>";
                echo "<td>{$employee['tenphong']}</td>"; // Display department name here
                echo "<td>{$employee['luong']}</td>";
                // Action Sửa
                if($userRole == 'Admin') {
                    echo "<td><a href='edit_employee.php?id={$employee['manv']}'>Sửa</a></td>";
                    // Action Xóa
                    echo "<td><a href='delete_employee.php?id={$employee['manv']}' onclick=\"return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?');\">Xóa</a></td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>

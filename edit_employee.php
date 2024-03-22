<?php
require_once("config/db.class.php");
require_once("entities/employee.class.php");

// Kiểm tra xem đã nhận mã nhân viên từ URL chưa
if(isset($_GET["id"])) {
    $manv = $_GET["id"];
    
    // Truy vấn dữ liệu nhân viên dựa trên mã nhân viên
    $employee = Employee::get_employee_by_id($manv);

    // Kiểm tra xem nhân viên có tồn tại không
    if($employee) {
        $tennv = $employee['tennv'];
        $phai = $employee['phai'];
        $noisinh = $employee['noisinh'];
        $maphong = $employee['maphong'];
        $luong = $employee['luong'];
    } else {
        // Redirect hoặc thông báo lỗi nếu không tìm thấy nhân viên
        // Ví dụ:
        // header("Location: index.php");
        // exit;
        echo "Không tìm thấy nhân viên";
        exit;
    }
} else {
    // Nếu không nhận được mã nhân viên, redirect hoặc thông báo lỗi
    // Ví dụ:
    // header("Location: index.php");
    // exit;
    echo "Mã nhân viên không được cung cấp";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Form for editing an existing employee -->
    <div class="form-container">
    <form method="post">
        <!-- Hidden input to store the employee ID -->
        <input type="hidden" id="txtEditEmployeeID" name="txtEditEmployeeID" value="<?php echo $manv; ?>" />

        <div class="row">
            <label for="txtName">Tên nhân viên</label>
            <input type="text" id="txtName" name="txtName" value="<?php echo $tennv; ?>" />
        </div>
        <div class="row">
            <label for="txtGender">Giới tính</label>
            <select id="txtGender" name="txtGender">
                <option value="Nam" <?php echo $phai == 'Nam' ? "selected" : ""; ?>>Nam</option>
                <option value="Nữ" <?php echo $phai == 'Nữ' ? "selected" : ""; ?>>Nữ</option>
            </select>
        </div>
        <div class="row">
            <label for="txtPlaceOfBirth">Nơi sinh</label>
            <input type="text" id="txtPlaceOfBirth" name="txtPlaceOfBirth" value="<?php echo $noisinh; ?>" />
        </div>
        <div class="row">
            <label for="txtDepartmentID">Tên phòng</label>
            <select id="txtDepartmentID" name="txtDepartmentID">
                <?php
                    $departments = Department::list_departments();
                    foreach($departments as $department) {
                        $selected = ($maphong == $department["maphong"]) ? "selected" : "";
                        echo "<option value='".$department["maphong"]."' ".$selected.">".$department["tenphong"]."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="row">
            <label for="txtSalary">Lương</label>
            <input type="text" id="txtSalary" name="txtSalary" value="<?php echo $luong; ?>" />
        </div>
        <div class="row">
            <div class="submit">
                <input type="submit" name="btnedit" value="Chỉnh sửa nhân viên">
            </div>
        </div>
    </form>
</div>


    <div class="back-button">
        <button onclick="window.history.back()">Quay lại</button>
    </div>
</body>
</html>

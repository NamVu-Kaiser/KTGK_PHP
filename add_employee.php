<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- PHP code for handling form submission and displaying success message -->
    <?php
        require_once("entities/employee.class.php");
        require_once("entities/department.class.php");

        if(isset($_POST["btnsubmit"])) {
            $manv = $_POST["txtEmployeeID"];
            $tennv = $_POST["txtName"];
            $phai = $_POST["txtGender"];
            $noisinh = $_POST["txtPlaceOfBirth"];
            $maphong = $_POST["txtDepartmentID"];
            $luong = $_POST["txtSalary"];
            
            $newEmployee = new Employee($manv,$tennv, $phai, $noisinh, $maphong, $luong);
            $result = $newEmployee->save();

            if(!$result) {
                header("Location: add_employee.php?failure");
                exit; // Stop further execution
            } else {
                // Redirect to the index page
                header("Location: index.php?inserted");
                exit; // Stop further execution
            }
        }

        if(isset($_GET["inserted"])) {
            echo "<h2>Thêm nhân viên thành công</h2>";
        }
    ?>

    <!-- Form for adding a new employee -->
    <div class="form-container">
    <form method="post">
        <div class="row">
            <label for="txtEmployeeID">Mã nhân viên</label>
            <input type="text" id="txtEmployeeID" name="txtEmployeeID" value="<?php echo isset($_POST["txtEmployeeID"]) ? $_POST["txtEmployeeID"] : ""; ?>" />
        </div>
        <div class="row">
            <label for="txtName">Tên nhân viên</label>
            <input type="text" id="txtName" name="txtName" value="<?php echo isset($_POST["txtName"]) ? $_POST["txtName"] : ""; ?>" />
        </div>
        <div class="row">
            <label for="txtGender">Giới tính</label>
            <select id="txtGender" name="txtGender">
                <option value="Nam" <?php echo isset($_POST["txtGender"]) && $_POST["txtGender"] == "Nam" ? "selected" : ""; ?>>Nam</option>
                <option value="Nữ" <?php echo isset($_POST["txtGender"]) && $_POST["txtGender"] == "Nữ" ? "selected" : ""; ?>>Nữ</option>
            </select>
        </div>
        <div class="row">
            <label for="txtPlaceOfBirth">Nơi sinh</label>
            <input type="text" id="txtPlaceOfBirth" name="txtPlaceOfBirth" value="<?php echo isset($_POST["txtPlaceOfBirth"]) ? $_POST["txtPlaceOfBirth"] : ""; ?>" />
        </div>
        <div class="row">
            <label for="txtDepartmentID">Tên phòng</label> <!-- Changed label to "Tên phòng" -->
            <select id="txtDepartmentID" name="txtDepartmentID">
                <?php
                    $departments = Department::list_departments();
                    foreach($departments as $department) {
                        echo "<option value='".$department["maphong"]."'>".$department["tenphong"]."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="row">
            <label for="txtSalary">Lương</label>
            <input type="text" id="txtSalary" name="txtSalary" value="<?php echo isset($_POST["txtSalary"]) ? $_POST["txtSalary"] : ""; ?>" />
        </div>
        <div class="row">
            <div class="submit">
                <input type="submit" name="btnsubmit" value="Thêm nhân viên">
            </div>
        </div>
    </form>
</div>


    <div class="back-button">
        <button onclick="window.history.back()">Quay lại</button>
    </div>
</body>
</html>

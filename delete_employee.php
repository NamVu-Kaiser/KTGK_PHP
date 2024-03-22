<?php
require_once("entities/employee.class.php");

if(isset($_GET["id"])) {
    $manv = $_GET["id"];
    $result = Employee::delete_employee($manv);
    
    if($result) {
        // Xử lý thành công, có thể chuyển hướng hoặc hiển thị thông báo thành công
        header("Location: index.php");
        exit();
    } else {
        // Xử lý thất bại, có thể hiển thị thông báo lỗi
        echo "Xóa nhân viên không thành công.";
    }
}
?>

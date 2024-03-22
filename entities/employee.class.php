<?php
require_once("config/db.class.php");

class Employee{
    public $manv;
    public $tennv;
    public $phai;
    public $noisinh;
    public $maphong;
    public $luong;

    public function __construct($id_employee, $name_employee, $gender, $place_birth, $department_id, $salary){
        $this->manv = $id_employee;
        $this->tennv = $name_employee;
        $this->phai= $gender;
        $this->noisinh= $place_birth;
        $this->maphong= $department_id;
        $this->luong= $salary;
    }

    public function save(){
        $db = new Db();
        $sql = "INSERT INTO NHANVIEN (manv, tennv, phai, noisinh, maphong, luong) VALUES ('$this->manv', '$this->tennv', '$this->phai', '$this->noisinh', '$this->maphong', '$this->luong')";
        $result = $db->query_execute($sql);
        return $result;
    }
    
    public static function list_employee(){
        $db=new Db();
        $sql="SELECT n.*, p.tenphong AS tenphong FROM NHANVIEN n JOIN PHONGBAN p ON n.maphong = p.maphong";
        $result = $db->select_to_array($sql);
        return $result;
    }
    public static function get_employee_by_id($manv) {
        $db = new Db();
        $sql = "SELECT n.*, p.tenphong AS tenphong 
                FROM NHANVIEN n 
                JOIN PHONGBAN p 
                ON n.maphong = p.maphong 
                WHERE manv = '$manv'";
        $result = $db->select_to_array($sql);
        // Trả về dòng dữ liệu đầu tiên nếu có, nếu không trả về false
        return isset($result[0]) ? $result[0] : false;
    }
    
    
    public function update(){
        $db = new Db();
        $sql = "UPDATE NHANVIEN SET tennv = '$this->tennv', phai = '$this->phai', noisinh = '$this->noisinh', maphong = '$this->maphong', luong = '$this->luong' WHERE manv = '$this->manv'";
        $result = $db->query_execute($sql);
        return $result;
    }
    public static function delete_employee($manv)
    {
        $db = new Db();
        $sql = "DELETE FROM nhanvien WHERE manv = $manv";
        return $db->query_execute($sql);
    }
}
?>

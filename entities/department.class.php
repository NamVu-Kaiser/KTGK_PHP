<?php
require_once("config/db.class.php");

class Department{
    public $maphong;
    public $tenphong;

    public function __construct($department_id, $department_name){
        $this->maphong = $department_id;
        $this->tenphong = $department_name;
    }

    public static function list_departments(){
        $db = new Db();
        $sql = "SELECT * FROM PHONGBAN";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
?>

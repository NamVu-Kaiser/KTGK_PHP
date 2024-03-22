<?php
require_once 'config/db.class.php';

class User {
    protected $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function login($username, $password) {
        $username = $this->db->connect()->real_escape_string($username);
        $password = $this->db->connect()->real_escape_string($password);

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $this->db->select_to_array($query);

        if ($result && count($result) > 0) {
            // Đăng nhập thành công
            session_start();
            $_SESSION['username'] = $result[0]['username'];
            header('Location: index.php');
            exit();
        } else {
            // Đăng nhập thất bại
            echo "Tên đăng nhập hoặc mật khẩu không đúng.";
        }
    }
    public function getUserRole($username) {
        $username = $this->db->connect()->real_escape_string($username);
    
        $query = "SELECT role FROM users WHERE username = '$username'";
        $result = $this->db->select_to_array($query);
    
        if ($result && count($result) > 0) {
            return $result[0]['role'];
        } else {
            return null;
        }
    }
    public function getUserFullName($username) {
        $username = $this->db->connect()->real_escape_string($username);
    
        $query = "SELECT fullname FROM users WHERE username = '$username'";
        $result = $this->db->select_to_array($query);
    
        if ($result && count($result) > 0) {
            return $result[0]['fullname'];
        } else {
            return null;
        }
    }
}
?>

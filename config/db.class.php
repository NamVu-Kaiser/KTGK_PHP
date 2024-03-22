<?php // IDEA:
class Db
{
    protected static $connection;

    public function connect()
    {
        if (!isset(self::$connection)) {
            $config = parse_ini_file("config.ini");
            self::$connection = new mysqli("localhost", $config["username"], $config["password"], $config["databasename"]);
        }
        if (self::$connection == false) {
            return false;
        }
        return self::$connection;
    }

    public function query_execute($queryString)
    {
        $connection = $this->connect();
        $result = $connection->query($queryString);
        return $result;
    }

    public function select_to_array($queryString)
    {
        $rows = array();
        $result = $this->query_execute($queryString);
        if ($result == false) {
            return false;
        }
        while ($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }
        // Đóng kết nối sau khi hoàn thành tất cả các thao tác
        $this->close_connection();
        return $rows;
    }

    // Thêm phương thức để đóng kết nối
    public function close_connection()
    {
        if (isset(self::$connection)) {
            self::$connection->close();
            // Đặt kết nối về null để tránh tái sử dụng kết nối đã đóng
            self::$connection = null;
        }
    }
}

?>

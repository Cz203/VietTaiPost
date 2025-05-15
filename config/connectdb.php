<?php
class ConnectDB
{
    private $host = 'localhost';
    private $dbname = 'qlgh';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            return $this->conn;
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }
}
?>

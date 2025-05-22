<?php
require_once 'config.php';
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

    
    public function connectDB1()
    {
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

        if (mysqli_connect_errno()) {
            die("kết nối thất bại:" . mysqli_connect_error());
        }
        mysqli_set_charset($conn, "utf8");
        return $conn;
    }

    function closeDB($conn)
    {
        mysqli_close($conn);
    }

}
?>

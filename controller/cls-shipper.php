<?php
include(__DIR__ . '/../config/connectdb.php');

class clsShipper extends ConnectDB
{
    //dang nhap
     public function login($so_dien_thoai, $mat_khau) {
        $conn = $this->connect();

        $sql = "SELECT * FROM shipper WHERE so_dien_thoai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$so_dien_thoai]);

        if ($stmt->rowCount() === 1) {
            $shipper = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($shipper['mat_khau'] === $mat_khau) {
                return $shipper;
            }
        }

        return false;
    }
}
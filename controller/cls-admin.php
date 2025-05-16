<?php
include(__DIR__ . '/../config/connectdb.php');

class clsAdmin extends ConnectDB
{
    public function themBuuCuc($ten, $dia_chi, $xa_huyen_tinh, $vi_do, $kinh_do, $sdt)
    {
        $conn = $this->connect();
        $sql = "INSERT INTO buu_cuc (ten_buu_cuc, dia_chi, xa_huyen_tinh, vi_do, kinh_do, so_dien_thoai) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ten, $dia_chi, $xa_huyen_tinh, $vi_do, $kinh_do, $sdt]);
    } 

    public function getTatCaBuuCuc()
    {
        $conn = $this->connect(); // PDO
        $stmt = $conn->prepare("SELECT * FROM buu_cuc");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
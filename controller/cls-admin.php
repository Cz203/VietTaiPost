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
        if($stmt->execute([$ten, $dia_chi, $xa_huyen_tinh, $vi_do, $kinh_do, $sdt]))
        {
            return true;
        } else {
            return false; 
        }
    } 

    public function getTatCaBuuCuc()
    {
        $conn = $this->connect(); // PDO
        $stmt = $conn->prepare("SELECT * FROM buu_cuc");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function xoaBuuCuc($id)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("DELETE FROM buu_cuc WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function suaBuuCuc($id, $tenBuuCuc, $soDienThoai)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("UPDATE buu_cuc SET ten_buu_cuc = :ten, so_dien_thoai = :sdt WHERE id = :id");
        return $stmt->execute([
            'ten' => $tenBuuCuc,
            'sdt' => $soDienThoai,
            'id'  => $id
        ]);
    }

    public function timBuuCuc($keyword) 
    {
       $conn = $this->connect();
        $keyword = "%$keyword%";
        $sql = "SELECT * FROM buu_cuc WHERE ten_buu_cuc LIKE :kw OR dia_chi LIKE :kw OR xa_huyen_tinh LIKE :kw";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['kw' => $keyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>
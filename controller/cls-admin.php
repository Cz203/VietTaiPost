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

    //shipper
    public function getTatCaShipper() 
    {
        $conn = $this->connect();
        $sql = "SELECT s.*, b.ten_buu_cuc FROM shipper s
            LEFT JOIN buu_cuc b ON s.id_buu_cuc = b.id";
        return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function timShipper($keyword) 
    {
        $conn = $this->connect();
        $sql = "SELECT s.*, b.ten_buu_cuc FROM shipper s
            LEFT JOIN buu_cuc b ON s.id_buu_cuc = b.id
            WHERE s.ho_ten LIKE :kw OR b.ten_buu_cuc LIKE :kw";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['kw' => '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //don hang

    public function layTatCaDonHang() {
        $conn = $this->connect();
        $sql = "SELECT * FROM don_hang"; 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function layDonTheoTrangThai($trang_thai) {
        $conn = $this->connect();
        $sql = "SELECT * FROM don_hang WHERE trang_thai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$trang_thai]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function capNhatTrangThaiDon($ma_don, $trang_thai_moi) {
        $conn = $this->connect();
        $sql = "UPDATE don_hang SET trang_thai = ? WHERE ma_don_hang = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$trang_thai_moi, $ma_don]);
    }
}

?>
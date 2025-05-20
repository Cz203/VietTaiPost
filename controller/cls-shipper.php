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

    //vi tri buu cuc 
     public function buuCuc($id_buu_cuc) {   
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM buu_cuc where id = ? ");
        $stmt->execute([$id_buu_cuc]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //don hang
     public function layTatCaDonHang() {
        $conn = $this->connect();
        $sql = "SELECT * FROM don_hang where trang_thai = 'chờ shipper tới lấy'"; 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function layTatCaDonHangVeBuuCuc() {
        $conn = $this->connect();
        $sql = "SELECT * FROM don_hang where trang_thai = 'đã lấy hàng'"; 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function layVanDonTheoMaDon($ma_don_hang) 
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT vd.*, s.ho_ten AS ten_shipper, s.so_dien_thoai AS sdt_shipper
                                FROM van_don vd
                                LEFT JOIN shipper s ON vd.id_shipper = s.id
                                WHERE vd.ma_don_hang = ?
                                ORDER BY vd.thoi_gian_cap_nhat DESC LIMIT 1");
        $stmt->execute([$ma_don_hang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function layDonTheoTrangThai($trang_thai) {
        $conn = $this->connect();
        $sql = "SELECT * FROM don_hang WHERE trang_thai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$trang_thai]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // sidebar
    public function demDonHangCanLay($id_shipper) {
        $conn = $this->connect();
        $sql = "SELECT COUNT(*) as so_don 
                FROM don_hang dh
                JOIN van_don vd ON dh.ma_don_hang = vd.ma_don_hang
                WHERE dh.trang_thai = 'chờ shipper tới lấy'
                AND vd.trang_thai = 'đợi lấy hàng'
                AND vd.id_shipper = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_shipper]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['so_don'] ?? 0;
    }

    //thao tác đơn hàng
    public function capNhatTrangThaiDon($ma_don, $trang_thai_moi, $id_shipper, $id_buu_cuc, $ghi_chu_lich_su) 
    {
        $conn = $this->connect();

        if($trang_thai_moi == 'đang giao')
        {
            $sqlUpdateDon = "UPDATE don_hang SET trang_thai = ? WHERE ma_don_hang = ?";
            $stmt = $conn->prepare($sqlUpdateDon);
            $stmt->execute([$trang_thai_moi, $ma_don]);

            $sql = "SELECT ten_buu_cuc FROM buu_cuc WHERE id = ?";
            $stmtbc = $conn->prepare($sql);
            $stmtbc->execute([$id_buu_cuc]);
            $row = $stmtbc->fetch(PDO::FETCH_ASSOC);
            $ten_buu_cuc = $row ? $row['ten_buu_cuc'] : 'Không rõ bưu cục';

            $sqlInsertVanDon = "INSERT INTO van_don (ma_don_hang, id_shipper, id_buu_cuc, trang_thai, lich_su, thoi_gian_cap_nhat, ghi_chu)
                                VALUES (?, ?, ?, ?, ?, NOW(), ?)";
            $lich_su = date('Y-m-d H:i:s') . ' - ' . $ghi_chu_lich_su.$ten_buu_cuc;

            $stmt2 = $conn->prepare($sqlInsertVanDon);
            $stmt2->execute([$ma_don, $id_shipper, $id_buu_cuc, $trang_thai_moi, $lich_su, null]);
        }
        else 
        {
            $sqlUpdateDon = "UPDATE don_hang SET trang_thai = ? WHERE ma_don_hang = ?";
            $stmt = $conn->prepare($sqlUpdateDon);
            $stmt->execute([$trang_thai_moi, $ma_don]);

            $sqlInsertVanDon = "INSERT INTO van_don (ma_don_hang, id_shipper, id_buu_cuc, trang_thai, lich_su, thoi_gian_cap_nhat, ghi_chu)
                                VALUES (?, ?, ?, ?, ?, NOW(), ?)";
            $lich_su = date('Y-m-d H:i:s') . ' - ' . $ghi_chu_lich_su;

            $stmt2 = $conn->prepare($sqlInsertVanDon);
            $stmt2->execute([$ma_don, $id_shipper, $id_buu_cuc, $trang_thai_moi, $lich_su, null]);
        }
        
    }


}
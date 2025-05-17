<?php
include(__DIR__ . '/../config/connectdb.php');

class clsKhachhang extends ConnectDB
{
    //tao don
    public function themDonHang($data)
    {
        $conn = $this->connect(); 

        $sql = "INSERT INTO don_hang (
            ma_don_hang, ten_don_hang, so_luong, trong_luong, ten_nguoi_gui, sdt_nguoi_gui, ma_khach_hang,
            ten_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_gui, dia_chi_nguoi_gui_mac_dinh,
             lat_nguoi_gui, lng_nguoi_gui, dia_chi_nguoi_nhan, dia_chi_nguoi_nhan_mac_dinh,
            lat_nguoi_nhan, lng_nguoi_nhan, thu_ho, trang_thai, phi_van_chuyen, nguoi_tra_phi, thoi_gian_hen_lay,
            ngay_giao_du_kien, ghi_chu
        ) VALUES (
            :ma_don_hang, :ten_don_hang, :so_luong, :trong_luong, :ten_nguoi_gui, :sdt_nguoi_gui, :ma_khach_hang,
            :ten_nguoi_nhan, :sdt_nguoi_nhan, :dia_chi_nguoi_gui, :dia_chi_nguoi_gui_mac_dinh,
             :lat_nguoi_gui, :lng_nguoi_gui, :dia_chi_nguoi_nhan, :dia_chi_nguoi_nhan_mac_dinh,
            :lat_nguoi_nhan, :lng_nguoi_nhan, :thu_ho, :trang_thai, :phi_van_chuyen, :nguoi_tra_phi, :thoi_gian_hen_lay,
            :ngay_giao_du_kien, :ghi_chu
        )";

        try {
            $stmt = $conn->prepare($sql);

            // Gán giá trị
            $stmt->execute([
                ':ma_don_hang' => $data['ma_don_hang'],
                ':ten_don_hang' => $data['ten_don_hang'],
                ':so_luong' => (int)$data['so_luong'],
                ':trong_luong' => (int)$data['trong_luong'],
                ':ten_nguoi_gui' => $data['ten_nguoi_gui'],
                ':sdt_nguoi_gui' => $data['sdt_nguoi_gui'],
                ':ma_khach_hang' => (int)$data['ma_khach_hang'],
                ':ten_nguoi_nhan' => $data['ten_nguoi_nhan'],
                ':sdt_nguoi_nhan' => $data['sdt_nguoi_nhan'],
                ':dia_chi_nguoi_gui' => $data['dia_chi_nguoi_gui'],
                ':dia_chi_nguoi_gui_mac_dinh'=> $data['dia_chi_nguoi_gui_mac_dinh'],
                ':lat_nguoi_gui' => $data['lat_nguoi_gui'],
                ':lng_nguoi_gui' => $data['lng_nguoi_gui'],
                ':dia_chi_nguoi_nhan' => $data['dia_chi_nguoi_nhan'],
                ':dia_chi_nguoi_nhan_mac_dinh'=> $data['dia_chi_nguoi_nhan_mac_dinh'],
                ':lat_nguoi_nhan' => $data['lat_nguoi_nhan'],
                ':lng_nguoi_nhan' => $data['lng_nguoi_nhan'],
                ':thu_ho' => isset($data['thu_ho']) ? (int)$data['thu_ho'] : 0,
                ':trang_thai' => 'chờ xử lý',
                ':phi_van_chuyen' => isset($data['phi_van_chuyen']) ? (int)$data['phi_van_chuyen'] : 0,
                ':nguoi_tra_phi' => $data['nguoi_tra_phi'],
                ':thoi_gian_hen_lay' => $data['thoi_gian_hen_lay'],
                ':ngay_giao_du_kien' => $data['ngay_giao_du_kien'],
                ':ghi_chu' => $data['ghi_chu']
            ]);

            return true;

        } catch (PDOException $e) {
            error_log("Lỗi thêm đơn hàng: " . $e->getMessage());
            return false;
        }
    }

    //buu cuc
    public function getTatCaBuuCuc()
    {
        $conn = $this->connect(); // PDO
        $stmt = $conn->prepare("SELECT * FROM buu_cuc");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBuuCucTheoTimKiem($search)
    {
        $conn = $this->connect();
        $search = "%$search%";
        $sql = "SELECT * FROM buu_cuc WHERE dia_chi LIKE ? OR xa_huyen_tinh LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$search, $search]);  
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //don hanghang
    public function layDonHangKhachHang($ma_khach_hang) 
    {
        $conn = $this->connect(); 
        $sql = "SELECT * FROM don_hang WHERE ma_khach_hang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ma_khach_hang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function layVanDonTheoMaDon($ma_don_hang) 
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT vd.*, s.ho_ten AS ten_shipper, s.so_dien_thoai AS sdt_shipper
                                FROM van_don vd
                                LEFT JOIN shipper s ON vd.id_shipper = s.id
                                WHERE vd.ma_don_hang = ?
                                ORDER BY vd.thoi_gian_cap_nhat ASC");
        $stmt->execute([$ma_don_hang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>

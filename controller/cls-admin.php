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
        if ($stmt->execute([$ten, $dia_chi, $xa_huyen_tinh, $vi_do, $kinh_do, $sdt])) {
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

    public function layTatCaDonHang()
    {
        $conn = $this->connect();
        $sql = "SELECT * FROM don_hang";
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
                                ORDER BY vd.thoi_gian_cap_nhat ASC");
        $stmt->execute([$ma_don_hang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function layDonTheoTrangThai($trang_thai)
    {
        $conn = $this->connect();
        $sql = "SELECT * FROM don_hang WHERE trang_thai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$trang_thai]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function capNhatTrangThaiDon($ma_don, $trang_thai_moi)
    {
        $conn = $this->connect();

        // Nếu là duyệt đơn, thì cần insert vào bảng vận đơn
        if ($trang_thai_moi === 'duyệt') {
            $stmt = $conn->prepare("SELECT * FROM don_hang WHERE ma_don_hang = ?");
            $stmt->execute([$ma_don]);
            $don = $stmt->fetch();

            if (!$don) return false;

            // Lấy vị trí người gửi
            $lat = $don['lat_nguoi_gui'];
            $lng = $don['lng_nguoi_gui'];

            // Tìm shipper gần nhất
            $stmt = $conn->prepare("SELECT id, id_buu_cuc, SQRT(POW(vi_do - ?, 2) + POW(kinh_do - ?, 2)) AS distance
                                FROM shipper
                                ORDER BY distance ASC LIMIT 1");
            $stmt->execute([$lat, $lng]);
            $shipper = $stmt->fetch();

            if (!$shipper) return false;

            $id_shipper = $shipper['id'];

            // Giả sử admin đang đăng nhập có id_buu_cuc = 1
            $id_buu_cuc = $shipper['id_buu_cuc'];

            // Lịch sử vận đơn
            $now = date("H:i d/m/Y");
            $lich_su = "$now: Đơn hàng đã được duyệt, chờ shipper tới lấy";

            // Tạo vận đơn
            $stmt = $conn->prepare("INSERT INTO van_don (ma_don_hang, id_shipper, id_buu_cuc, trang_thai, lich_su, thoi_gian_cap_nhat)
                                VALUES (?, ?, ?, 'đợi lấy hàng', ?, NOW())");
            $stmt->execute([$ma_don, $id_shipper, $id_buu_cuc, $lich_su]);

            // Cập nhật trạng thái đơn hàng
            $stmt = $conn->prepare("UPDATE don_hang SET trang_thai = 'chờ shipper tới lấy' WHERE ma_don_hang = ?");
            return $stmt->execute([$ma_don]);
        } else {
            // Trường hợp khác: chỉ cập nhật trạng thái đơn hàng
            $stmt = $conn->prepare("UPDATE don_hang SET trang_thai = ? WHERE ma_don_hang = ?");
            return $stmt->execute([$trang_thai_moi, $ma_don]);
        }
    }

    public function themShipper($ho_ten, $so_dien_thoai, $mat_khau, $id_buu_cuc, $cccd_truoc, $cccd_sau, $bang_lai_xe, $giay_dk_xe)
    {
        try {
            $conn = $this->connect();

            // Kiểm tra số điện thoại đã tồn tại chưa
            $stmt = $conn->prepare("SELECT id FROM shipper WHERE so_dien_thoai = ?");
            $stmt->execute([$so_dien_thoai]);
            if ($stmt->rowCount() > 0) {
                return false; // Số điện thoại đã tồn tại
            }

            // Mã hóa mật khẩu
            $mat_khau_hash = password_hash($mat_khau, PASSWORD_DEFAULT);

            // Thêm shipper mới
            $sql = "INSERT INTO shipper (ho_ten, so_dien_thoai, mat_khau, id_buu_cuc, trang_thai, cccd_truoc, cccd_sau, bang_lai_xe, giay_dk_xe) 
                    VALUES (?, ?, ?, ?, 'Không hoạt động', ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([
                $ho_ten,
                $so_dien_thoai,
                $mat_khau_hash,
                $id_buu_cuc,
                $cccd_truoc,
                $cccd_sau,
                $bang_lai_xe,
                $giay_dk_xe
            ]);

            return $result;
        } catch (PDOException $e) {
            // Log lỗi nếu cần
            error_log("Lỗi thêm shipper: " . $e->getMessage());
            return false;
        }
    }

    public function getShipperDetail($id)
    {
        $conn = $this->connect();

        $sql = "SELECT s.*, b.ten_buu_cuc 
                FROM shipper s 
                LEFT JOIN buu_cuc b ON s.id_buu_cuc = b.id 
                WHERE s.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

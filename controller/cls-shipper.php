<?php
include(__DIR__ . '/../config/connectdb.php');

class clsShipper extends ConnectDB
{
    //dang nhap
    public function login($so_dien_thoai, $mat_khau)
    {
        $conn = $this->connect();

        $sql = "SELECT * FROM shipper WHERE so_dien_thoai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$so_dien_thoai]);

        if ($stmt->rowCount() === 1) {
            $shipper = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($mat_khau, $shipper['mat_khau'])) {
                // Cập nhật last_login
                $updateSql = "UPDATE shipper SET last_login = NOW() WHERE id = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->execute([$shipper['id']]);

                // Lưu toàn bộ thông tin shipper vào session
                $_SESSION['shipper'] = $shipper;


                // Debug session
                echo "<pre>";
                print_r($_SESSION);
                echo "</pre>";

                return $shipper;
            }
        }

        return false;
    }

    //lây mail kh
    public function layEmailKhachHangTheoMaDon($ma_don)
    {
        $conn = $this->connect();

        $sql = "SELECT kh.email
                FROM don_hang dh
                JOIN khachhang kh ON dh.ma_khach_hang = kh.id_khachhang
                WHERE dh.ma_don_hang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ma_don]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['email'];
        }
        return null;
    }
    //vi tri buu cuc 
    public function buuCuc($id_buu_cuc)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM buu_cuc where id = ? ");
        $stmt->execute([$id_buu_cuc]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //đơn hàng được phân công cho shipper
    public function layTatCaDonHang($id_shipper)
    {
        // $conn = $this->connect();
        // $sql = "SELECT * FROM don_hang where trang_thai = 'chờ shipper tới lấy' ";
        // $stmt = $conn->prepare($sql);
        // $stmt->execute();
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT dh.*
            FROM don_hang dh
            INNER JOIN van_don vd ON dh.ma_don_hang = vd.ma_don_hang
            WHERE dh.trang_thai = 'chờ shipper tới lấy'
            AND vd.id_shipper = ? ORDER BY vd.thoi_gian_cap_nhat DESC 
        ");
        $stmt->execute([$id_shipper]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function layTatCaDonHangVeBuuCuc($id_shipper)
    {
        $conn = $this->connect();
        // $sql = "SELECT * FROM don_hang where trang_thai = 'đã lấy hàng'";
        $stmt = $conn->prepare("SELECT dh.*
            FROM don_hang dh
            INNER JOIN (
                SELECT vd1.*
                FROM van_don vd1
                INNER JOIN (    
                    SELECT ma_don_hang, MAX(thoi_gian_cap_nhat) AS latest_time
                    FROM van_don
                    GROUP BY ma_don_hang
                ) latest_vd ON vd1.ma_don_hang = latest_vd.ma_don_hang AND vd1.thoi_gian_cap_nhat = latest_vd.latest_time
            ) vd ON dh.ma_don_hang = vd.ma_don_hang
            WHERE dh.trang_thai = 'đã lấy hàng'
            AND vd.id_shipper = ?
            ORDER BY vd.thoi_gian_cap_nhat DESC
        ");

        $stmt->execute([$id_shipper]);
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

    public function layDonTheoTrangThai($trang_thai)
    {
        $conn = $this->connect();
        $sql = "SELECT * FROM don_hang WHERE trang_thai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$trang_thai]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // sidebar
    public function demDonHangCanLay($id_shipper)
    {
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
        try {
            $conn = $this->connect();

            if ($trang_thai_moi == 'Lấy đơn hàng') {
                $sqlInsertVanDon = "INSERT INTO van_don (ma_don_hang, id_shipper, id_buu_cuc, trang_thai, lich_su, thoi_gian_cap_nhat, ghi_chu)
                                    VALUES (?, ?, ?, ?, ?, NOW(), ?)";
                $lich_su = date("H:i d/m/Y") . ': ' . $ghi_chu_lich_su;
                $trang_thai = 'đang đi giao';
                $ghi_chu = 'đang đi giao';

                $stmt2 = $conn->prepare($sqlInsertVanDon);
                $stmt2->execute([$ma_don, $id_shipper, $id_buu_cuc, $trang_thai, $lich_su, $ghi_chu]);
                return;
            }

            if ($trang_thai_moi == 'trả về bưu cục') {
                $sqlBuuCuc = "SELECT ten_buu_cuc FROM buu_cuc WHERE id = ?";
                $stmtBuuCuc = $conn->prepare($sqlBuuCuc);
                $stmtBuuCuc->execute([$id_buu_cuc]);
                $row = $stmtBuuCuc->fetch(PDO::FETCH_ASSOC);
                $ten_buu_cuc = $row ? $row['ten_buu_cuc'] : 'Không rõ bưu cục';

                $ghi_chu_lich_su = "Đơn hàng của bạn đã đến ";
                $lich_su = date("H:i d/m/Y") . ': ' . $ghi_chu_lich_su . $ten_buu_cuc;

                $trang_thai_moi = 'ở bưu cục';
                $sqlInsertVanDon = "INSERT INTO van_don (ma_don_hang, id_shipper, id_buu_cuc, trang_thai, lich_su, thoi_gian_cap_nhat, ghi_chu)
                                    VALUES (?, ?, ?, ?, ?, NOW(), ?)";

                $trang_thai = 'ở bưu cục';
                $ghi_chu = 'có thể giao';

                $stmt2 = $conn->prepare($sqlInsertVanDon);
                $stmt2->execute([$ma_don, null, $id_buu_cuc, $trang_thai, $lich_su, $ghi_chu]);
                return;
            }

            if ($trang_thai_moi == 'giao thành công') {
                $sqlUpdateDon = "UPDATE don_hang SET trang_thai = 'đã giao' WHERE ma_don_hang = ?";
                $stmt = $conn->prepare($sqlUpdateDon);
                $stmt->execute([$ma_don]);

                $ghi_chu_lich_su = "Đơn hàng của bạn đã được giao thành công";
                $lich_su = date("H:i d/m/Y") . ': ' . $ghi_chu_lich_su;

                $sqlInsertVanDon = "INSERT INTO van_don (ma_don_hang, id_shipper, id_buu_cuc, trang_thai, lich_su, thoi_gian_cap_nhat, ghi_chu)
                                    VALUES (?, ?, ?, ?, ?, NOW(), ?)";
                $ghi_chu = 'đã giao hàng';
                $stmt2 = $conn->prepare($sqlInsertVanDon);
                $stmt2->execute([$ma_don, $id_shipper, $id_buu_cuc, $trang_thai_moi, $lich_su, $ghi_chu]);

                return;
            }

            if ($trang_thai_moi == 'đang giao') {
                $sql = "SELECT ten_buu_cuc, xa_huyen_tinh FROM buu_cuc WHERE id = ?";
                $stmtbc = $conn->prepare($sql);
                $stmtbc->execute([$id_buu_cuc]);
                $row = $stmtbc->fetch(PDO::FETCH_ASSOC);
                $ten_buu_cuc = $row ? $row['ten_buu_cuc'] : 'Không rõ bưu cục';
                $xa_huyen_tinh_buu_cuc = $row ? $row['xa_huyen_tinh'] : '';

                $sqlGetDiaChi = "SELECT dia_chi_nguoi_nhan_mac_dinh FROM don_hang WHERE ma_don_hang = ?";
                $stmt3 = $conn->prepare($sqlGetDiaChi);
                $stmt3->execute([$ma_don]);
                $rowDon = $stmt3->fetch(PDO::FETCH_ASSOC);
                $dia_chi_nguoi_nhan = $rowDon ? $rowDon['dia_chi_nguoi_nhan_mac_dinh'] : '';

                function lay_quan_tinh($dia_chi)
                {
                    $parts = array_map('trim', explode(',', $dia_chi));
                    $count = count($parts);
                    return $count >= 2 ? implode(', ', array_slice($parts, -2)) : '';
                }

                $quan_tinh_buu_cuc = lay_quan_tinh($xa_huyen_tinh_buu_cuc);
                $quan_tinh_dia_chi = lay_quan_tinh($dia_chi_nguoi_nhan);

                $sqlUpdateDon = "UPDATE don_hang SET trang_thai = ? WHERE ma_don_hang = ?";
                $stmt = $conn->prepare($sqlUpdateDon);
                $stmt->execute([$trang_thai_moi, $ma_don]);

                if ($quan_tinh_buu_cuc && $quan_tinh_dia_chi && $quan_tinh_buu_cuc == $quan_tinh_dia_chi) {
                    $ghi_chu = "có thể giao";
                } else {
                    $ghi_chu = "đợi vận chuyển qua bưu cục khác";
                }

                $sqlInsertVanDon = "INSERT INTO van_don (ma_don_hang, id_shipper, id_buu_cuc, trang_thai, lich_su, thoi_gian_cap_nhat, ghi_chu)
                                    VALUES (?, ?, ?, ?, ?, NOW(), ?)";
                $lich_su = date("H:i d/m/Y") . ': ' . $ghi_chu_lich_su . $ten_buu_cuc;
                $trang_thai = 'ở bưu cục';
                $stmt2 = $conn->prepare($sqlInsertVanDon);
                $stmt2->execute([$ma_don, $id_shipper, $id_buu_cuc, $trang_thai, $lich_su, $ghi_chu]);
            } else {
                $sqlUpdateDon = "UPDATE don_hang SET trang_thai = ? WHERE ma_don_hang = ?";
                $stmt = $conn->prepare($sqlUpdateDon);
                $stmt->execute([$trang_thai_moi, $ma_don]);

                $sqlInsertVanDon = "INSERT INTO van_don (ma_don_hang, id_shipper, id_buu_cuc, trang_thai, lich_su, thoi_gian_cap_nhat, ghi_chu)
                                    VALUES (?, ?, ?, ?, ?, NOW(), ?)";
                $lich_su = date("H:i d/m/Y") . ': ' . $ghi_chu_lich_su;

                $stmt2 = $conn->prepare($sqlInsertVanDon);
                $stmt2->execute([$ma_don, $id_shipper, $id_buu_cuc, $trang_thai_moi, $lich_su, null]);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    //shipper lay hang di giao
    public function layTatCaDonHangTrongBuuCuu($id_buu_cuc)
    {
        $conn = $this->connect();
        $sql = "SELECT dh.*, vd.trang_thai, vd.ghi_chu, vd.thoi_gian_cap_nhat
                FROM don_hang dh
                INNER JOIN (
                    SELECT vd1.*
                    FROM van_don vd1
                    INNER JOIN (
                        SELECT ma_don_hang, MAX(thoi_gian_cap_nhat) AS latest_time
                        FROM van_don
                        GROUP BY ma_don_hang
                    ) latest_vd 
                    ON vd1.ma_don_hang = latest_vd.ma_don_hang AND vd1.thoi_gian_cap_nhat = latest_vd.latest_time
                ) vd 
                ON dh.ma_don_hang = vd.ma_don_hang
                WHERE dh.trang_thai = 'đang giao'
                AND vd.id_buu_cuc = ? AND vd.ghi_chu = 'có thể giao'
                ORDER BY vd.thoi_gian_cap_nhat DESC;
                ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_buu_cuc]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function layTatCaDonHangCuaBan($id_shipper)
    {
        $conn = $this->connect();
        $sql = "SELECT dh.*, vd.trang_thai, vd.ghi_chu, vd.thoi_gian_cap_nhat
                FROM don_hang dh
                INNER JOIN (
                    SELECT vd1.*
                    FROM van_don vd1
                    INNER JOIN (
                        SELECT ma_don_hang, MAX(thoi_gian_cap_nhat) AS latest_time
                        FROM van_don
                        GROUP BY ma_don_hang
                    ) latest_vd 
                    ON vd1.ma_don_hang = latest_vd.ma_don_hang AND vd1.thoi_gian_cap_nhat = latest_vd.latest_time
                ) vd 
                ON dh.ma_don_hang = vd.ma_don_hang
                WHERE dh.trang_thai = 'đang giao'
                AND vd.id_shipper = ? AND vd.ghi_chu = 'đang đi giao'
                ORDER BY vd.thoi_gian_cap_nhat DESC;
                ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_shipper]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function demDonDaGiaoThanhCongTrongThang($id_shipper) {
    $conn = $this->connect();
    $sql = "SELECT COUNT(DISTINCT dh.ma_don_hang) as so_don
            FROM don_hang dh
            INNER JOIN van_don vd ON dh.ma_don_hang = vd.ma_don_hang
            WHERE dh.trang_thai = 'đã giao'
            AND vd.id_shipper = ?
            AND MONTH(vd.thoi_gian_cap_nhat) = MONTH(CURRENT_DATE())
            AND YEAR(vd.thoi_gian_cap_nhat) = YEAR(CURRENT_DATE())";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_shipper]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['so_don'] ?? 0;
    }
    
    public function demDonCanGiao($id_shipper) {
    $conn = $this->connect();
    $sql = "SELECT COUNT(DISTINCT dh.ma_don_hang) as so_don
            FROM don_hang dh
            INNER JOIN van_don vd ON dh.ma_don_hang = vd.ma_don_hang
            WHERE dh.trang_thai = 'đang giao'
            AND vd.id_shipper = ?
            AND vd.ghi_chu = 'đang đi giao'";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_shipper]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['so_don'] ?? 0;
    }


}
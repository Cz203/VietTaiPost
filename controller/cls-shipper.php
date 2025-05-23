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
                $_SESSION['id'] = $shipper['id'];
                return $shipper;
            }
        }

        return false;
    }

    //vi tri buu cuc 
    public function buuCuc($id_buu_cuc)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM buu_cuc where id = ? ");
        $stmt->execute([$id_buu_cuc]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //don hang
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
            AND vd.id_shipper = ? ORDER BY vd.thoi_gian_cap_nhat DESC LIMIT 1
        ");
        $stmt->execute([$id_shipper]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function layTatCaDonHangVeBuuCuc($id_shipper)
    {
        $conn = $this->connect();
        // $sql = "SELECT * FROM don_hang where trang_thai = 'đã lấy hàng'";
        $stmt = $conn->prepare(" SELECT dh.*
            FROM don_hang dh
            INNER JOIN van_don vd ON dh.ma_don_hang = vd.ma_don_hang
            WHERE dh.trang_thai = 'đã lấy hàng'
            AND vd.id_shipper = ?  ORDER BY vd.thoi_gian_cap_nhat DESC LIMIT 1
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

            // Bắt đầu transaction
            $conn->beginTransaction();

            // Cập nhật trạng thái đơn hàng
            $sqlUpdateDon = "UPDATE don_hang SET trang_thai = ? WHERE ma_don_hang = ?";
            $stmt = $conn->prepare($sqlUpdateDon);
            $stmt->execute([$trang_thai_moi, $ma_don]);

            // Lấy thông tin bưu cục nếu cần
            $ten_buu_cuc = '';
            if ($id_buu_cuc) {
                $sql = "SELECT ten_buu_cuc FROM buu_cuc WHERE id = ?";
                $stmtbc = $conn->prepare($sql);
                $stmtbc->execute([$id_buu_cuc]);
                $row = $stmtbc->fetch(PDO::FETCH_ASSOC);
                $ten_buu_cuc = $row ? $row['ten_buu_cuc'] : 'Không rõ bưu cục';
            }

            // Tạo lịch sử vận đơn
            $lich_su = date('Y-m-d H:i:s') . ' - ' . $ghi_chu_lich_su;
            if ($ten_buu_cuc) {
                $lich_su .= ' tại ' . $ten_buu_cuc;
            }

            // Thêm vận đơn mới
            $sqlInsertVanDon = "INSERT INTO van_don (ma_don_hang, id_shipper, id_buu_cuc, trang_thai, lich_su, thoi_gian_cap_nhat, ghi_chu)
                                VALUES (?, ?, ?, ?, ?, NOW(), ?)";
            $stmt2 = $conn->prepare($sqlInsertVanDon);
            $stmt2->execute([$ma_don, $id_shipper, $id_buu_cuc, $trang_thai_moi, $lich_su, null]);

            // Commit transaction
            $conn->commit();

            return [
                'success' => true,
                'message' => 'Cập nhật trạng thái đơn hàng thành công'
            ];
        } catch (PDOException $e) {
            // Rollback transaction nếu có lỗi
            if ($conn->inTransaction()) {
                $conn->rollBack();
            }
            return [
                'success' => false,
                'message' => 'Lỗi khi cập nhật trạng thái đơn hàng: ' . $e->getMessage()
            ];
        }
    }

    public function toggleTrangThaiHoatDong($id, $trang_thai)
    {
        try {
            $conn = $this->connect();

            // Chuyển đổi trạng thái từ 0/1 thành text
            $trang_thai_text = $trang_thai ? 'Đang hoạt động' : 'Không hoạt động';

            // Kiểm tra xem shipper có tồn tại không
            $check_sql = "SELECT id FROM shipper WHERE id = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->execute([$id]);

            if ($check_stmt->rowCount() === 0) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy shipper'
                ];
            }

            // Cập nhật trạng thái
            $sql = "UPDATE shipper SET trang_thai = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$trang_thai_text, $id]);

            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Cập nhật trạng thái thành công',
                    'trang_thai' => $trang_thai_text
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Không thể cập nhật trạng thái'
                ];
            }
        } catch (PDOException $e) {
            error_log("Lỗi cập nhật trạng thái shipper: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Lỗi khi cập nhật trạng thái: ' . $e->getMessage()
            ];
        }
    }

    public function getTrangThaiHoatDong($id)
    {
        try {
            $conn = $this->connect();
            $sql = "SELECT trang_thai FROM shipper WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy shipper'
                ];
            }

            return [
                'success' => true,
                'trang_thai' => $result['trang_thai']
            ];
        } catch (PDOException $e) {
            error_log("Lỗi lấy trạng thái shipper: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Lỗi khi lấy trạng thái: ' . $e->getMessage()
            ];
        }
    }
}
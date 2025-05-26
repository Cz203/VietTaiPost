<?php
require_once '../controller/cls-admin.php';
header('Content-Type: application/json');

try {
    $admin = new clsAdmin();
    $shippers = $admin->getTatCaShipper();

    // Đảm bảo dữ liệu trả về có đầy đủ thông tin cần thiết
    $formattedShippers = array_map(function ($shipper) {
        return [
            'id' => $shipper['id'],
            'ho_ten' => $shipper['ho_ten'],
            'so_dien_thoai' => $shipper['so_dien_thoai'],
            'ten_buu_cuc' => $shipper['ten_buu_cuc'] ?? 'Chưa có bưu cục',
            'trang_thai' => $shipper['trang_thai'],
            'vi_do' => $shipper['vi_do'],
            'kinh_do' => $shipper['kinh_do']
        ];
    }, $shippers);

    echo json_encode([
        'success' => true,
        'shippers' => $formattedShippers,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Lỗi khi lấy dữ liệu shipper: ' . $e->getMessage()
    ]);
}
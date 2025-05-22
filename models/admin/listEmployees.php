<?php
require_once __DIR__ . '/../../controller/cls-admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = new clsAdmin();

    // Lấy thông tin từ form
    $ho_ten = $_POST['ho_ten'] ?? '';
    $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
    $mat_khau = $_POST['mat_khau'] ?? '';
    $id_buu_cuc = $_POST['id_buu_cuc'] ?? 1;

    // Xử lý upload file
    $upload_dir = __DIR__ . '/../../uploads/shipper/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Hàm xử lý upload file
    function handleFileUpload($file, $upload_dir)
    {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $temp_name = $file['tmp_name'];
            $file_name = time() . '_' . basename($file['name']);
            $target_path = $upload_dir . $file_name;

            if (move_uploaded_file($temp_name, $target_path)) {
                return 'uploads/shipper/' . $file_name;
            }
        }
        return null;
    }

    // Upload các file
    $cccd_truoc = handleFileUpload($_FILES['cccd_truoc'], $upload_dir);
    $cccd_sau = handleFileUpload($_FILES['cccd_sau'], $upload_dir);
    $bang_lai_xe = handleFileUpload($_FILES['bang_lai_xe'], $upload_dir);
    $giay_dk_xe = handleFileUpload($_FILES['giay_dk_xe'], $upload_dir);

    // Kiểm tra nếu có lỗi upload file
    if (!$cccd_truoc || !$cccd_sau || !$bang_lai_xe || !$giay_dk_xe) {
        header('Location: /viettaipost/admin/quan-li-shipper.php?error=upload');
        exit;
    }

    // Thêm shipper mới
    $result = $admin->themShipper(
        $ho_ten,
        $so_dien_thoai,
        $mat_khau,
        $id_buu_cuc,
        $cccd_truoc,
        $cccd_sau,
        $bang_lai_xe,
        $giay_dk_xe
    );

    if ($result) {
        header('Location: /viettaipost/admin/quan-li-shipper.php?success=add');
    } else {
        header('Location: /viettaipost/admin/quan-li-shipper.php?error=exists');
    }
    exit;
}
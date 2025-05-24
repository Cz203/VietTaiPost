<?php
include_once 'cls-admin.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'toggleShipperStatus':
            if (isset($_POST['shipper_id']) && isset($_POST['status'])) {
                $shipper_id = $_POST['shipper_id'];
                $status = $_POST['status'];
                $admin = new clsAdmin();
                $result = $admin->capNhatTrangThaiShipper($shipper_id, $status);
                echo json_encode(['success' => $result]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
            }
            break;

            // Add other cases here
    }
}
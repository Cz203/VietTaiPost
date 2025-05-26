<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function kiemTraDangNhapAdmin() {
    if (!isset($_SESSION['admin'])) {
        header('Location: ../admin/');
        exit;
    }
}

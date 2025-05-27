<?php
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($toEmail, $toName, $subject, $bodyHtml, $bodyAlt = '')
{
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = ''; //điền mail vô
        $mail->Password = ''; // điền mã app vô
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Thông tin người gửi và người nhận
        $mail->setFrom('', 'Viettaipost'); //điền mail vô ''
        $mail->addAddress($toEmail, $toName);

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $bodyHtml;
        $mail->AltBody = $bodyAlt ?: strip_tags($bodyHtml);  // nếu không có thì lấy bản thu gọn từ HTML

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Ghi log nếu cần
        error_log("Lỗi gửi email: " . $mail->ErrorInfo);
        return false;
    }
}
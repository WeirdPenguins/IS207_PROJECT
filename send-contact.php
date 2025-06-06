<?php
session_start();
require 'vendor/autoload.php'; 
require 'config/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $fullname = htmlspecialchars(trim($_POST['fullname'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validate inputs
    if (!$fullname || !$email || !$message) {
        $_SESSION['contact_error'] = 'Vui lòng điền đầy đủ các trường bắt buộc.';
        header('Location: ' . ROOT_URL . '/contact.php');
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['contact_error'] = 'Email không hợp lệ.';
        header('Location: ' . ROOT_URL . '/contact.php');
        exit;
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vinhd220@gmail.com';
        $mail->Password = 'nnku gcil ppet rutl';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

  
        $mail->setFrom($email, $fullname); 
        $mail->addReplyTo($email, $fullname);
        $mail->addAddress('vinhd220@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Contact from ' . $fullname;
        $mail->Body = "
            <h3>Thông tin liên hệ</h3>
            <p><strong>Họ và tên:</strong> " . htmlspecialchars($fullname) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Điện thoại:</strong> " . htmlspecialchars($phone ?: 'Không cung cấp') . "</p>
            <p><strong>Nội dung:</strong> " . nl2br(htmlspecialchars($message)) . "</p>
        ";

        $mail->send();
        $_SESSION['contact_success'] = 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.';
    } catch (Exception $e) {
        $_SESSION['contact_error'] = 'Gửi email thất bại. Vui lòng thử lại sau. Lỗi: ' . $mail->ErrorInfo;
    }
} else {
    $_SESSION['contact_error'] = 'Yêu cầu không hợp lệ.';
}

header('Location: ' . ROOT_URL . '/contact.php');
exit;
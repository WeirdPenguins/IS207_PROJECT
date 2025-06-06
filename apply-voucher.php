
<?php
session_start();
include 'config/config.php';
include 'config/database.php';

header('Content-Type: application/json');

$username = isset($_SESSION['Username']) ? addslashes($_SESSION['Username']) : '';
$voucher_code = isset($_POST['voucher_code']) ? trim($_POST['voucher_code']) : '';

$response = [
    'success' => false,
    'message' => 'Có lỗi xảy ra!',
    'discount' => 0
];

if ($username && $voucher_code) {
    $sql = "SELECT * FROM vouchers WHERE VoucherName = '$voucher_code' AND UsedStatus = 1 AND StartTime <= NOW() AND EndTime >= NOW()";
    $voucher = Database::GetData($sql, ['row' => 0]);
    if ($voucher) {
        $voucher_discount = intval($voucher['Discount']);
        $_SESSION['voucher_code'] = $voucher_code;
        $_SESSION['voucher_discount'] = $voucher_discount;
        $response['success'] = true;
        $response['message'] = "Áp dụng thành công! Giảm {$voucher_discount}%";
        $response['discount'] = $voucher_discount;
    } else {
        unset($_SESSION['voucher_discount']);
        unset($_SESSION['voucher_code']);
        $response['message'] = "Mã voucher không hợp lệ hoặc đã hết hạn.";
    }
} else {
    $response['message'] = "Bạn chưa đăng nhập hoặc chưa nhập mã voucher.";
}

echo json_encode($response);
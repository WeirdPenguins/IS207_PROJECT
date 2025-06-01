<?php
include 'header.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['Username'])) {
    header('Location: login.php');
    exit;
}

// Lấy thông tin giỏ hàng theo sản phẩm được chọn
$username = addslashes($_SESSION['Username']);
$selectedList = null;
if (isset($_GET['selected']) && $_GET['selected'] !== '') {
    $selected = array_map('addslashes', explode(',', $_GET['selected']));
    $selectedList = "'" . implode("','", $selected) . "'";
    $sql = "SELECT * FROM Carts, Books WHERE Books.ISBN = Carts.ISBN AND Username = '$username' AND Carts.ISBN IN ($selectedList)";
} else {
    $sql = "SELECT * FROM Carts, Books WHERE Books.ISBN = Carts.ISBN AND Username = '$username'";
}
$carts = Database::GetData($sql);

$voucher_discount = isset($_SESSION['voucher_discount']) ? intval($_SESSION['voucher_discount']) : 0;

// Tính tổng tiền và giảm giá chỉ cho sản phẩm đã chọn
$totalMoney = 0;
if ($carts) {
    foreach ($carts as $cart) {
        $totalMoney += $cart['Price'] * $cart['Amount'];
    }
}
$discountMoney = 0;
if ($voucher_discount > 0 && $totalMoney > 0) {
    $discountMoney = round($totalMoney * $voucher_discount / 100);
    $totalMoney -= $discountMoney;
}

// Xử lý khi người dùng nhấn nút "Thanh toán"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bank_transfer'])) {

    function CreateOrderID() {
        $str = 'Rebook';
        for ($i = 1; $i < 8; $i++) {
            $str .= rand(0, 9);
        }
        return $str;
    }
    $orderID = CreateOrderID();
    // Lưu ý: $totalMoney đã là số tiền đã giảm
    $sql = "INSERT INTO Orders VALUES ('$orderID', $totalMoney, $totalMoney, 0, NULL, NOW(3), '$username')";
    Database::NonQuery($sql);

    foreach ($carts as $cart) {
        $sql = "INSERT INTO Order_Details VALUES (null, '" . addslashes($cart['ISBN']) . "', '$orderID', " . intval($cart['Amount']) . ")";
        Database::NonQuery($sql);
    }

    // Xóa các sản phẩm đã thanh toán khỏi giỏ hàng
    if ($selectedList) {
        $sql = "DELETE FROM Carts WHERE Username = '$username' AND ISBN IN ($selectedList)";
    } else {
        $sql = "DELETE FROM Carts WHERE Username = '$username'";
    }
    Database::NonQuery($sql);

    // Hiển thị hướng dẫn chuyển khoản
    echo "<div class='alert alert-success'>
        Đơn hàng của bạn đã được tạo!<br>
        Vui lòng chuyển khoản <b>" . number_format($totalMoney) . " đ</b> tới tài khoản ngân hàng sau:<br>
        <b>Ngân hàng:</b> Vietcombank<br>
        <b>Số tài khoản:</b> 0123456789<br>
        <b>Chủ tài khoản:</b> NGUYEN VAN A<br>
        <b>Nội dung chuyển khoản:</b> THANHTOAN $orderID<br>
        Sau khi chuyển khoản, đơn hàng sẽ được xác nhận!
    </div>";
    include 'footer.php';
    exit;
}
?>

<div class="container">
    <h2>Thanh toán đơn hàng</h2>
    <?php if (!$carts) { ?>
        <div class="alert alert-warning">Giỏ hàng của bạn đang trống!</div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sách</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carts as $cart) { ?>
                <tr>
                    <td><?=htmlspecialchars($cart['BookTitle'])?></td>
                    <td><?=number_format($cart['Price'])?> đ</td>
                    <td><?=$cart['Amount']?></td>
                    <td><?=number_format($cart['Price'] * $cart['Amount'])?> đ</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div style="font-size:18px;">
            <?php if ($voucher_discount > 0 && $discountMoney > 0): ?>
                <div><b>Giảm giá voucher (<?=$voucher_discount?>%):</b> -<?=number_format($discountMoney)?> đ</div>
            <?php endif; ?>
            <div style="font-size:18px;font-weight:bold;">Tổng tiền: <?=number_format($totalMoney)?> đ</div>
        </div>
        <form method="post">
            <button type="submit" name="bank_transfer" class="btn btn-success btn-lg mt-3">Thanh toán VNPAY</button>
            <button type="button" class="btn btn-secondary btn-lg mt-3" style="margin-left:10px;" onclick="window.location.href='shop.php'">Tiếp tục mua hàng</button>
        </form>
    <?php } ?>
</div>
<?php include 'footer.php'; ?>
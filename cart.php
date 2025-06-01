
<?php
 include 'header.php';
 
 if (!isset($_POST['voucher_code']) && !isset($_POST['apply_voucher']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    unset($_SESSION['voucher_code']);
    unset($_SESSION['voucher_discount']);
}

if (!isset($_SESSION['Username'])) {
    header('Location: login.php');
    exit;
}
?> 
<link rel="stylesheet" href="<?=ROOT_URL?>/assets/css/mystyle.css">

<?php
$hasCart = false;
$totalMoney = 0;

// Thêm sản phẩm vào giỏ hàng
if (isset($_GET['id'])) {
    $isbn = addslashes($_GET['id']);
    $username = addslashes($_SESSION['Username']);
    $qty = isset($_GET['qty']) ? max(1, intval($_GET['qty'])) : 1;
    // Kiểm tra đã có trong giỏ chưa
    $sql = "SELECT Amount FROM Carts WHERE ISBN = '$isbn' AND Username = '$username'";
    $row = Database::GetData($sql, ['row' => 0]);
    if ($row) {
        $sql = "UPDATE Carts SET Amount = Amount + $qty, UpdatedAt = NOW(3) WHERE ISBN = '$isbn' AND Username = '$username'";
    } else {
        $sql = "INSERT INTO Carts VALUES ('$isbn', '$username', $qty, NOW(3))";
    }
    Database::NonQuery($sql);

}

// Cập nhật số lượng sản phẩm
if (isset($_POST['update_qty'])) {
    $isbn = addslashes($_POST['isbn']);
    $username = addslashes($_SESSION['Username']);
    $action = $_POST['update_qty'];
    $amount = intval($_POST['amount']);
    if ($action == 'plus') $amount++;
    if ($action == 'minus') $amount--;
    if ($amount < 1) $amount = 1;
    $sql = "UPDATE Carts SET Amount = $amount, UpdatedAt = NOW(3) WHERE ISBN = '$isbn' AND Username = '$username'";
    Database::NonQuery($sql);
}

// Xoá sản phẩm trong giỏ hàng
if (isset($_GET['del-cart-id'])) {
    $isbn = addslashes($_GET['del-cart-id']);
    $username = addslashes($_SESSION['Username']);
    $sql = "DELETE FROM Carts WHERE ISBN = '$isbn' AND Username = '$username'";
    Database::NonQuery($sql);
}
// Lấy thông tin voucher từ session
$voucher_discount = isset($_SESSION['voucher_discount']) ? intval($_SESSION['voucher_discount']) : 0;
$discountMoney = 0;
$voucher_message = '';
$username = addslashes($_SESSION['Username']);

// Lấy giỏ hàng
$sql = "SELECT * FROM Carts, Books WHERE Books.ISBN = Carts.ISBN AND Username = '$username'";
$carts = Database::GetData($sql);
if ($carts) {
    $hasCart = true;
    foreach ($carts as $cart) {
        $totalMoney += $cart['Price'] * $cart['Amount'];
    }
}

// Tính giảm giá voucher
if ($voucher_discount > 0) {
    $discountMoney = round($totalMoney * $voucher_discount / 100);
    $totalMoney -= $discountMoney;
}
?>

<div class="cart-title-area">
    <div>
        <i class="fas fa-shopping-cart"></i>
        <span>Giỏ hàng của bạn</span>
    </div>
</div>

<div class="container cart-container">
    <div class="cart-left">
        <?php if (!$hasCart) { ?>
            <div class="cart-empty">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <div class="cart-empty-title">Giỏ hàng rỗng!</div>
                </div>
            </div>
        <?php } else { ?>
        <form method="post" action="#" id="cart-form">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Ảnh</th>
                        <th>Tên sách</th>
                        <th>Giá</th>
                        <th width="125">Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Xoá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carts as $cart) { ?>
                    <tr class="cart_item">
                        <td><input type="checkbox" class="cart-checkbox" name="selected[]" value="<?=$cart['ISBN']?>" data-price="<?=$cart['Price']?>" data-amount="<?=$cart['Amount']?>"></td>
                        <td><img class="cart-img" src="<?=ROOT_URL . $cart['Thumbnail']?>"></td>
                        <td class="cart-title"><?=$cart['BookTitle']?></td>
                        <td>
                            <span class="cart-price-sale"><?=number_format($cart['Price'])?> đ</span><br>
                        </td>
                        <td>
                            <div class="cart-qty">
                                <form method="POST" style="display:inline-flex;">
                                    <input name="isbn" value="<?=$cart['ISBN']?>" type="hidden">
                                    <input name="amount" type="hidden" value="<?=$cart['Amount']?>">
                                    <button type="submit" name="update_qty" value="minus" class="cart-qty-btn">-</button>
                                    <input type="text" class="cart-qty-input" value="<?=$cart['Amount']?>" readonly style="width:40px;text-align:center;">
                                    <button type="submit" name="update_qty" value="plus" class="cart-qty-btn">+</button>
                                </form>
                            </div>
                        </td>
                        <td><span class="cart-price-sale"><?=number_format($cart['Price'] * $cart['Amount'])?> đ</span></td>
                        <td>
                            <a href="?del-cart-id=<?=$cart['ISBN']?>" class="cart-remove-btn" title="Xoá sản phẩm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
        <?php } ?>
    </div>
    <div class="cart-right">
        <form id="voucher-form" style="margin-bottom: 16px;" onsubmit="return false;">
            <div class="cart-summary-label">Mã giảm giá (Voucher)</div>
            <div style="display:flex;gap:8px;">
                <input type="text" name="voucher_code" id="voucher_code" class="form-control" placeholder="Nhập mã voucher" value="<?=isset($_SESSION['voucher_code']) ? htmlspecialchars($_SESSION['voucher_code']) : ''?>">
                <button type="submit" id="apply-voucher-btn" class="btn btn-info">Áp dụng</button>
            </div>
            <div id="voucher-message" style="color:#d0021b;font-size:13px;margin-top:4px;">
                <?php if (!empty($voucher_message)) echo htmlspecialchars($voucher_message); ?>
            </div>
        </form>
        <div>
            <div class="cart-summary-label">Thành tiền</div>
            <div class="cart-summary-value" id="cart-total"><?=number_format($totalMoney)?> đ</div>
            <div id="voucher-discount-area">
                <?php if ($voucher_discount > 0) { ?>
                    <div class="cart-summary-label" style="color:green;">Giảm giá (<?=$voucher_discount?>%)</div>
                    <div class="cart-summary-value" style="color:green;">-<?=number_format($discountMoney)?> đ</div>
                <?php } ?>
            </div>
            <div class="cart-summary-label">Tổng Số Tiền (gồm VAT)</div>
            <div class="cart-summary-value" id="cart-total-final" style="font-size:22px; color:#d0021b;">
                <?=number_format($totalMoney)?> đ
            </div>
            <button type="button" class="cart-checkout-btn" <?=(!$hasCart || $totalMoney==0)?'disabled':'';?> id="checkout-btn">THANH TOÁN</button>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/4e5b2b7e4b.js" crossorigin="anonymous"></script>
<script src="assets/js/cart.js"></script>
<?php include 'footer.php'; ?>
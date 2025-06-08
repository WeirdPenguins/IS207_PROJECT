<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config/database.php';
    
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => ''];
    
    if (!isset($_SESSION['Username'])) {
        $response['message'] = 'Vui lòng đăng nhập để thực hiện thao tác này!';
        echo json_encode($response);
        exit;
    }

    $username = addslashes($_SESSION['Username']);
    
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update_qty':
                if (isset($_POST['isbn']) && isset($_POST['amount'])) {
                    $isbn = addslashes($_POST['isbn']);
                    $amount = max(1, intval($_POST['amount']));
                    
                    $sql = "UPDATE Carts SET Amount = $amount, UpdatedAt = NOW(3) WHERE ISBN = '$isbn' AND Username = '$username'";
                    if (Database::NonQuery($sql)) {
                        $response['success'] = true;
                        $response['message'] = 'Cập nhật số lượng thành công!';
                    } else {
                        $response['message'] = 'Có lỗi xảy ra khi cập nhật số lượng!';
                    }
                } else {
                    $response['message'] = 'Thiếu thông tin cần thiết!';
                }
                break;
                
            case 'delete':
                if (isset($_POST['isbn'])) {
                    $isbn = addslashes($_POST['isbn']);
                    
                    $sql = "DELETE FROM Carts WHERE ISBN = '$isbn' AND Username = '$username'";
                    if (Database::NonQuery($sql)) {
                        $response['success'] = true;
                        $response['message'] = 'Xóa sản phẩm thành công!';
                    } else {
                        $response['message'] = 'Có lỗi xảy ra khi xóa sản phẩm!';
                    }
                } else {
                    $response['message'] = 'Thiếu thông tin cần thiết!';
                }
                break;
                
            default:
                $response['message'] = 'Hành động không hợp lệ!';
                break;
        }
    } else {
        $response['message'] = 'Thiếu thông tin hành động!';
    }
    
    echo json_encode($response);
    exit;
}

include 'header.php';

if (isset($_GET['id']) && !isset($_GET['reload'])) {
    require_once 'config/database.php';
    
    if (!isset($_SESSION['Username'])) {
        echo "<script>window.location.href='login.php';</script>";
        exit;
    }
    
    $isbn = addslashes($_GET['id']);
    $username = addslashes($_SESSION['Username']);
    $qty = isset($_GET['qty']) ? max(1, intval($_GET['qty'])) : 1;
    
    $sql = "SELECT Amount FROM Carts WHERE ISBN = '$isbn' AND Username = '$username'";
    $row = Database::GetData($sql, ['row' => 0]);
    if ($row) {
        $sql = "UPDATE Carts SET Amount = Amount + $qty, UpdatedAt = NOW(3) WHERE ISBN = '$isbn' AND Username = '$username'";
    } else {
        $sql = "INSERT INTO Carts VALUES ('$isbn', '$username', $qty, NOW(3))";
    }
    Database::NonQuery($sql);
    
    echo "<script>window.location.href='cart.php?reload=1';</script>";
    exit;
}

if (!isset($_SESSION['Username'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}
?>
<link rel="stylesheet" href="<?=ROOT_URL?>/assets/css/mystyle.css">

<?php
$hasCart = false;
$totalMoney = 0;

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
                    <tr class="cart_item" data-isbn="<?=$cart['ISBN']?>">
                        <td><input type="checkbox" class="cart-checkbox" name="selected[]" value="<?=$cart['ISBN']?>" data-price="<?=$cart['Price']?>" data-amount="<?=$cart['Amount']?>" checked></td>
                        <td><img class="cart-img" src="<?=ROOT_URL . $cart['Thumbnail']?>"></td>
                        <td class="cart-title"><?=htmlspecialchars($cart['BookTitle'])?></td>
                        <td>
                            <span class="cart-price-sale"><?=number_format($cart['Price'])?> đ</span><br>
                        </td>
                        <td>
                            <div class="cart-qty">
                                <button type="button" class="cart-qty-btn" data-action="minus">-</button>
                                <input type="text" class="cart-qty-input" value="<?=$cart['Amount']?>" readonly style="width:40px;text-align:center;">
                                <button type="button" class="cart-qty-btn" data-action="plus">+</button>
                            </div>
                        </td>
                        <td><span class="cart-price-sale"><?=number_format($cart['Price'] * $cart['Amount'])?> đ</span></td>
                        <td>
                            <a href="#" class="cart-remove-btn" title="Xoá sản phẩm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/js/cart.js"></script>
<?php include 'footer.php'; ?>
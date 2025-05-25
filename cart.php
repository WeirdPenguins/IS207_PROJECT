<?php include 'header.php'?>
<link rel="stylesheet" href="<?=ROOT_URL?>/assets/css/mystyle.css">

<?php
$hasCart = false;
$totalMoney = 0;

    // Thêm sản phẩm vào giỏ hàng
    if (isset($_GET['id'])) {
        $sql = "INSERT INTO Carts VALUES ('" . $_GET['id'] . "', '" . $_SESSION['Username'] . "', 1, NOW(3))";
        Database::NonQuery($sql);
    }

    // Cập nhật số lượng sản phẩm
    if (isset($_POST['update_amount'])) {
        $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';

        $sql = "UPDATE Carts SET Amount = $amount WHERE ISBN = '$isbn' AND Username = '" . $_SESSION['Username'] . "'";
        Database::NonQuery($sql);
    }

    // Xoá sản phẩm trong giỏ hàng
    if (isset($_GET['del-cart-id'])) {
        $isbn = $_GET['del-cart-id'];

        $sql = "DELETE FROM Carts WHERE ISBN = '$isbn' AND Username = '" . $_SESSION['Username'] . "'";
        Database::NonQuery($sql);
    }

    function CreateOrderID()
    {
        $str = 'BHT';
        for ($i = 1; $i < 8; $i++) {
            $str .= rand(0, 9);
        }
        return $str;
    }

    // Tạo đơn hàng
    if (isset($_GET['type']) && $_GET['type'] == 'payment') {
        $sql = "SELECT * FROM Carts WHERE Username = '" . $_SESSION['Username'] . "'";
        $carts = Database::GetData($sql);

        if ($carts) {
            $orderID = CreateOrderID();
            $sql = "SELECT SUM(Amount * Price) FROM Carts, Books WHERE Carts.ISBN = Books.ISBN AND Username = '" . $_SESSION['Username'] . "'";
            $totalMoney = Database::GetData($sql, ['row' => 0, 'cell' => 0]);

            $sql = "INSERT INTO Orders VALUES ('$orderID', $totalMoney, $totalMoney, 0, NULL, NOW(3), '" . $_SESSION['Username'] . "')";
            Database::NonQuery($sql);

            foreach ($carts as $cart) {
                $sql = "INSERT INTO Order_Details VALUES (null, '" . $cart['ISBN'] . "', '$orderID', " . $cart['Amount'] . ')';
                Database::NonQuery($sql);
            }

            $sql = "DELETE FROM Carts WHERE Username = '" . $_SESSION['Username'] . "'";
            Database::NonQuery($sql);
        }
    }

if (isset($_SESSION['Username'])) {
    $sql = "SELECT * FROM Carts, Books WHERE Books.ISBN = Carts.ISBN AND Username = '" . $_SESSION['Username'] . "' ORDER BY Carts.UpdatedAt DESC";
    $carts = Database::GetData($sql);
    if ($carts) {
        $hasCart = true;
        foreach ($carts as $cart) {
            $totalMoney += $cart['Price'] * $cart['Amount'];
        }
    }
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
                    <div class="cart-empty-text">Bạn chưa có giao dịch nào.</div>
                    <img src="<?=ROOT_URL?>/assets/img/empty-cart.png" alt="empty cart" class="cart-empty-img">
                </div>
            </div>
        <?php } else { ?>
        <form method="post" action="#">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="cart-checkbox" id="select-all"></th>
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
                        <td><input type="checkbox" class="cart-checkbox" name="selected[]" value="<?=$cart['ISBN']?>"></td>
                        <td><img class="cart-img" src="<?=ROOT_URL . $cart['Thumbnail']?>"></td>
                        <td class="cart-title"><?=$cart['BookTitle']?></td>
                        <td>
                            <span class="cart-price-sale"><?=number_format($cart['Price'])?> đ</span><br>
                            <span class="cart-price-old"><?=number_format($cart['OldPrice'] ?? ($cart['Price']*1.2))?> đ</span>
                        </td>
                        <td>
                            <div class="cart-qty">
                                <form method="POST">
                                    <input name="isbn" value="<?=$cart['ISBN']?>" hidden>
                                    <button type="submit" name="update_amount" value="-1" class="cart-qty-btn">-</button>
                                    <input name="amount" type="number" class="cart-qty-input" min="1" value="<?=$cart['Amount']?>">
                                    <button type="submit" name="update_amount" value="1" class="cart-qty-btn">+</button>
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
        <div>
            <div class="cart-summary-label">Thành tiền</div>
            <div class="cart-summary-value">0 đ</div>
            <div class="cart-summary-label">Tổng Số Tiền (gồm VAT)</div>
            <div class="cart-summary-value" style="font-size:22px; color:#d0021b;">
                <?=number_format($totalMoney)?> đ
            </div>
            <button class="cart-checkout-btn" <?=(!$hasCart || $totalMoney==0)?'disabled':'';?> onclick="window.location.href='?type=payment'">THANH TOÁN</button>
            <div style="color:#d0021b;font-size:12px;margin-top:8px;">(Giảm giá trên web chỉ áp dụng cho bán lẻ)</div>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/4e5b2b7e4b.js" crossorigin="anonymous"></script>
<script>
// Chọn tất cả checkbox
const selectAll = document.getElementById('select-all');
if (selectAll) {
    selectAll.addEventListener('change', function() {
        document.querySelectorAll('.cart-checkbox').forEach(cb => { cb.checked = selectAll.checked; });
    });
}
</script>
<?php include 'footer.php'?>
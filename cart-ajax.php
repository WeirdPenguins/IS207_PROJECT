<?php
session_start();
include 'config/config.php';
include 'config/database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['Username'])) {
    echo json_encode(['success' => false, 'message' => 'Please log in']);
    exit;
}

$username = addslashes($_SESSION['Username']);
$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Add item to cart
        if ($action === 'add') {
            $isbn = addslashes($_POST['isbn']);
            $qty = isset($_POST['qty']) ? max(1, intval($_POST['qty'])) : 1;

            $sql = "SELECT Amount FROM Carts WHERE ISBN = '$isbn' AND Username = '$username'";
            $row = Database::GetData($sql, ['row' => 0]);
            if ($row) {
                $sql = "UPDATE Carts SET Amount = Amount + $qty, UpdatedAt = NOW(3) WHERE ISBN = '$isbn' AND Username = '$username'";
            } else {
                $sql = "INSERT INTO Carts VALUES ('$isbn', '$username', $qty, NOW(3))";
            }
            Database::NonQuery($sql);
            $response = ['success' => true, 'message' => 'Item added to cart'];
        }

        // Update quantity
        elseif ($action === 'update_qty') {
            $isbn = addslashes($_POST['isbn']);
            $amount = intval($_POST['amount']);
            $operation = $_POST['operation'];

            if ($operation === 'plus') $amount++;
            if ($operation === 'minus') $amount--;
            if ($amount < 1) $amount = 1;

            $sql = "UPDATE Carts SET Amount = $amount, UpdatedAt = NOW(3) WHERE ISBN = '$isbn' AND Username = '$username'";
            Database::NonQuery($sql);
            $response = ['success' => true, 'message' => 'Quantity updated', 'new_amount' => $amount];
        }

        // Delete item
        elseif ($action === 'delete') {
            $isbn = addslashes($_POST['isbn']);
            $sql = "DELETE FROM Carts WHERE ISBN = '$isbn' AND Username = '$username'";
            Database::NonQuery($sql);
            $response = ['success' => true, 'message' => 'Item removed from cart'];
        }
    }
}

// Fetch updated cart data
$sql = "SELECT Carts.*, Books.Price, Books.BookTitle, Books.Thumbnail FROM Carts, Books WHERE Books.ISBN = Carts.ISBN AND Username = '$username'";
$carts = Database::GetData($sql);
$totalMoney = 0;
$voucher_discount = isset($_SESSION['voucher_discount']) ? intval($_SESSION['voucher_discount']) : 0;
$discountMoney = 0;

if ($carts) {
    foreach ($carts as $cart) {
        $totalMoney += $cart['Price'] * $cart['Amount'];
    }
    if ($voucher_discount > 0) {
        $discountMoney = round($totalMoney * $voucher_discount / 100);
        $totalMoney -= $discountMoney;
    }
}

$response['cart'] = $carts ?: [];
$response['totalMoney'] = $totalMoney;
$response['discountMoney'] = $discountMoney;
$response['hasCart'] = !empty($carts);

echo json_encode($response);
exit;
?>
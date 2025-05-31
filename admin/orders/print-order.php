<?php include '../../config/config.php'?>
<?php include '../../config/Database.php'?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In hoá đơn</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- My style -->
    <style>
        body {
            background: #f8fafc;
        }
        .main-logo {
            width: 260px;
            height: 80px;
            object-fit: contain;
        }
        .invoice-box {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 40px 32px 32px 32px;
            margin: 40px auto;
            max-width: 700px;
        }
        .invoice-title {
            color: #00b894;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .section-title {
            color: #0984e3;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 12px;
        }
        .table th, .table td {
            vertical-align: middle !important;
        }
        .summary-box {
            background: #f1f2f6;
            border-radius: 12px;
            padding: 18px 24px;
            margin-top: 18px;
        }
        .paid-stamp {
            height: 120px;
            margin-top: 12px;
        }
        .invoice-link {
            font-size: 0.95rem;
            color: #636e72;
        }
        @media print {
            .btn, .invoice-link { display: none !important; }
            .invoice-box { box-shadow: none; border: none; }
        }
    </style>
</head>

<?php
    $orderID = isset($_GET['order-id']) ? $_GET['order-id'] : '';
    $sql = "SELECT * FROM Orders, Users WHERE Orders.Username = Users.Username AND OrderID = '$orderID'";
    $user = Database::GetData($sql, ['row' => 0]);

    $sql = "SELECT * FROM Order_Details, Books WHERE Books.ISBN = Order_Details.ISBN AND OrderID = '$orderID'";
    $books = Database::GetData($sql);

    $sql = "SELECT * FROM Orders WHERE OrderID = '$orderID'";
    $order = Database::GetData($sql, ['row' => 0]);
?>

<body>
    <div class="invoice-box">
        <div class="text-center mb-4">
            <img class="main-logo mb-2" src="<?=ROOT_URL . '/assets/img/Rebook.png'?>" alt="Logo Rebook">
            <h4 class="invoice-title mb-0">CỬA HÀNG BÁN SÁCH TRỰC TUYẾN REBOOK</h4>
            <div style="font-size:1.1rem;color:#636e72;">www.rebook.vn</div>
        </div>
        <h3 class="text-center mb-4" style="color:#fdcb6e; font-weight:bold; letter-spacing:2px;">HOÁ ĐƠN</h3>
        <div class="mb-4">
            <div class="section-title">THÔNG TIN KHÁCH HÀNG</div>
            <div><b>Họ và tên:</b> <?=htmlspecialchars($user['Fullname'])?></div>
            <div><b>Số điện thoại:</b> <?=htmlspecialchars($user['Phone'])?></div>
            <div><b>Email:</b> <?=htmlspecialchars($user['Email'])?></div>
        </div>
        <div class="mb-4">
            <div class="section-title">CHI TIẾT ĐƠN HÀNG</div>
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Mã sách</th>
                        <th>Tên sách</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($books) {
                            foreach ($books as $book) {
                                echo '<tr>
                                    <th>' . htmlspecialchars($book['ISBN']) . '</th>
                                    <td>' . htmlspecialchars($book['BookTitle']) . '</td>
                                    <td>' . number_format($book['Price']) . 'đ</td>
                                    <td>' . $book['Amount'] . '</td>
                                    <td>' . number_format($book['Price'] * $book['Amount']) . 'đ</td>
                                </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="100%" class="text-center">Không có dữ liệu</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
            <div class="summary-box">
                <div class="row">
                    <div class="col-6"><b>Tổng sản phẩm:</b></div>
                    <div class="col-6 text-end"><?=number_format($order['TotalMoney'])?> đ</div>
                </div>
                <div class="row">
                    <div class="col-6"><b>Phí vận chuyển:</b></div>
                    <div class="col-6 text-end">0 đ</div>
                </div>
                <div class="row" style="font-size:1.15rem;">
                    <div class="col-6"><b>Tổng tiền:</b></div>
                    <div class="col-6 text-end" style="color:#d35400;"><b><?=number_format($order['TotalRevenue'])?> đ</b></div>
                </div>
                <?php if ($order['Status'] == 1) {?>
                    <div class="text-end">
                        <img class="paid-stamp" src="<?=ROOT_URL . '/assets/img/paid-logo.jpg'?>" alt="Đã thanh toán">
                    </div>
                <?php }?>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-4">
            <button onclick="window.print();" class="btn btn-primary">
                <i class="fas fa-print"></i> In hoá đơn
            </button>
        </div>
    </div>
    <!-- Font Awesome for print icon -->
    <script src="https://kit.fontawesome.com/4b8b0b6e0d.js" crossorigin="anonymous"></script>
</body>
</html>
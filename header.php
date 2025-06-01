<?php
include 'config/config.php';
include 'config/Database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REBOOK</title>
    <link rel="icon" href="<?= ROOT_URL ?>/assets/img/favicon.png" />

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap' rel='stylesheet'>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= HOME_TEMPLATE_URL ?>/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= ADMIN_TEMPLATE_URL ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= HOME_TEMPLATE_URL ?>/css/owl.carousel.css">
    <link rel="stylesheet" href="<?= HOME_TEMPLATE_URL ?>/css/ustora-style.css">
    <link rel="stylesheet" href="<?= HOME_TEMPLATE_URL ?>/css/responsive.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>/assets/css/mystyle.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body data-voucher-discount="<?= isset($voucher_discount) ? $voucher_discount : 0 ?>">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="tel:1900636467"><i class="fas fa-phone"></i> 1900 636 467</a>
                    <a href="mailto:support@bhtbookstore.com"><i class="fas fa-envelope"></i> supportrebook@gmail.com</a>
                </div>
                <div class="col-md-6 text-right">
                    <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] == '1') { ?>
                        <a href="<?= ROOT_URL ?>/admin/dashboard/index.php"><i class="fas fa-user-shield"></i> Trang quản trị</a>
                    <?php }
                    if (isset($_SESSION['Role'])) { ?>
                        <a href="<?= ROOT_URL ?>/profile.php"><i class="fas fa-user"></i> <?= $_SESSION['DisplayName'] ?></a>
                        <a href="<?= ROOT_URL ?>/logout.php"><i class="fas fa-sign-in-alt"></i> Đăng xuất</a>
                    <?php } else { ?>
                        <a href="<?= ROOT_URL ?>/sign.php"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                        <a href="<?= ROOT_URL ?>/sign.php"><i class="fas fa-user"></i> Đăng ký</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="main-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <a href="./">
                        <img src="<?= ROOT_URL ?>/assets/img/Rebook_logo.png" style="height:50px;max-width:180px;width:auto;" alt="REBOOK"> </a>
                </div>
                <div class="col-md-6">
                    <form class="search-form" action="shop.php">
                        <input name="keyword" placeholder="Tìm kiếm sách, tác giả, nhà xuất bản...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="col-md-3">
                    <div class="user-actions">
                        <?php
                        $totalMoney = 0;
                        $countItem = 0;
                        if (isset($_SESSION['Username'])) {
                            $sql = "SELECT SUM(Amount * Price) FROM Carts, Books WHERE Carts.ISBN = Books.ISBN AND Username = '" . $_SESSION['Username'] . "'";
                            $totalMoney = Database::GetData($sql, ['row' => 0, 'cell' => 0]);
                            $sql = "SELECT count(*) FROM Carts WHERE Username = '" . $_SESSION['Username'] . "'";
                            $countItem = Database::GetData($sql, ['row' => 0, 'cell' => 0]);
                        }
                        ?>
                        <a href="<?= ROOT_URL . '/cart.php' ?>" class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count"><?= $countItem ?></span>
                        </a>
                        <div class="cart-total"><?= number_format($totalMoney) ?> đ</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-nav">
        <div class="container">
            <ul class="nav-menu">
                <li><a href="./">Trang chủ</a></li>
                <li><a href="<?= ROOT_URL . '/shop.php' ?>">Mua hàng</a></li>
                <li class="nav-item dropdown">
                    <a href="<?= ROOT_URL . '/category-book.php' ?>" class="nav-link">Danh mục <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= ROOT_URL . '/category-book.php?CategoryID=8' ?>"><i class="fas fa-book"></i> Sách thiếu nhi</a></li>
                        <li><a href="<?= ROOT_URL . '/category-book.php?CategoryID=7' ?>"><i class="fas fa-heart"></i> Tâm lý, tâm linh, tôn giáo</a></li>
                        <li><a href="<?= ROOT_URL . '/category-book.php?CategoryID=6' ?>"><i class="fas fa-book-open"></i> Truyện, tiểu thuyết</a></li>
                        <li><a href="<?= ROOT_URL . '/category-book.php?CategoryID=5' ?>"><i class="fas fa-graduation-cap"></i> Giáo trình</a></li>
                        <li><a href="<?= ROOT_URL . '/category-book.php?CategoryID=4' ?>"><i class="fas fa-landmark"></i> Văn hóa xã hội – Lịch sử</a></li>
                        <li><a href="<?= ROOT_URL . '/category-book.php?CategoryID=3' ?>"><i class="fas fa-palette"></i> Văn học nghệ thuật</a></li>
                        <li><a href="<?= ROOT_URL . '/category-book.php?CategoryID=2' ?>"><i class="fas fa-microscope"></i> Khoa học công nghệ – Kinh tế</a></li>
                        <li><a href="<?= ROOT_URL . '/category-book.php?CategoryID=1' ?>"><i class="fas fa-balance-scale"></i> Chính trị – Pháp luật</a></li>
                    </ul>
                </li>
                <li><a href="<?= ROOT_URL ?>/news.php">Tin tức</a></li>
                <li><a href="<?= ROOT_URL ?>/contact.php">Liên hệ</a></li>
            </ul>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.dropdown > a').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('.dropdown-menu').not($(this).next('.dropdown-menu')).slideUp(200);
                $(this).next('.dropdown-menu').slideToggle(200);
            });

            $(document).click(function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').slideUp(200);
                }
            });

            $('.dropdown-menu').click(function(e) {
                e.stopPropagation();
            });
        });
    </script>
</body>

</html>
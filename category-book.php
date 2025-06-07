<?php include 'header.php'; ?>
<link href="<?=ROOT_URL . '/assets/css/shop.css'?>" rel="stylesheet">

<div class="single-product-area">
    <?php
        $categoryID = isset($_GET['CategoryID']) ? $_GET['CategoryID'] : 1;
        $sql = "SELECT CategoryName FROM Categories WHERE CategoryID = $categoryID";
        $categoryName = Database::GetData($sql, ['row' => 0, 'cell' => 0]);
    ?>
    <div class="zigzag-bottom"></div>
    <div class="container">
        <h1 class="text-primary text-center"><?=$categoryName?></h1>
        <div class="row">
            <?php
                $sql = "SELECT * FROM Books WHERE CategoryID = $categoryID ORDER BY UpdatedAt";
                $books = Database::GetData($sql);
                if (empty($books)) {
                    echo '<div class="col-md-12"><div class="empty-state">Không tìm thấy sản phẩm nào trong danh mục này.</div></div>';
                } else {
                    foreach ($books as $book) {
            ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="single-shop-product">
                    <div class="product-upper">
                        <img src="<?=ROOT_URL . $book['Thumbnail']?>" alt="<?=htmlspecialchars($book['BookTitle'])?>">
                    </div>
                    <h2><a href="<?=ROOT_URL . '/book-details.php?id=' . $book['ISBN']?>"><?=htmlspecialchars($book['BookTitle'])?></a></h2>
                    <div class="product-carousel-price">
                        <ins><?=number_format($book['Price'])?> đ</ins>
                    </div>
                    <div class="product-option-shop">
                        <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] == 3) {?>
                        <a class="add_to_cart_button" href="<?=ROOT_URL . '/cart.php?id=' . $book['ISBN']?>"><i class="fas fa-cart-plus"></i> Thêm vào giỏ</a>
                        <?php }?>
                        <a class="add_to_cart_button" href="<?=ROOT_URL . '/book-details.php?id=' . $book['ISBN']?>">Chi tiết</a>
                    </div>
                </div>
            </div>
            <?php }}?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
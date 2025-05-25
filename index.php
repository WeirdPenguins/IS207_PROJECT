<?php include 'header.php'?>

<div class="slider-area">
    <div class="block-slider block-slider4">
        <ul class="" id="bxslider-home4">
            <?php
                $sql = 'SELECT * FROM Sliders WHERE Status = 1';
                $sliders = Database::GetData($sql);
                if ($sliders) {
                    foreach ($sliders as $slider) {
                        echo '<li>
                                <img src="' . ROOT_URL . $slider['Thumbnail'] . '" alt="Slide">
                                <div class="caption-group">
                                    <h2 class="caption title">' . $slider['SliderName'] . '</h2>
                                    <h4 class="caption subtitle">' . $slider['Description'] . '</h4>
                                </div>
                            </li>';
                    }
                }
            ?>
        </ul>
    </div>
</div>

<div class="features-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-feature">
                    <i class="fas fa-sync"></i>
                    <h4>Hoàn trả 30 ngày</h4>
                    <p>Đổi trả miễn phí trong 30 ngày</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-feature">
                    <i class="fas fa-truck"></i>
                    <h4>Miễn phí vận chuyển</h4>
                    <p>Cho đơn hàng từ 300.000đ</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-feature">
                    <i class="fas fa-lock"></i>
                    <h4>Thanh toán an toàn</h4>
                    <p>Bảo mật thông tin thanh toán</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-feature">
                    <i class="fas fa-gift"></i>
                    <h4>Quà tặng khuyến mãi</h4>
                    <p>Nhiều ưu đãi hấp dẫn</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="maincontent-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Sản phẩm mới nhất</h2>
                    <div class="product-carousel">
                        <?php
                            $sql = 'SELECT * FROM Books ORDER BY UpdatedAt LIMIT 5';
                            $books = Database::GetData($sql);
                            foreach ($books as $book) {
                        ?>
                        <div class="single-product">
                            <div class="product-f-image">
                                <img src="<?=ROOT_URL . $book['Thumbnail']?>" alt="">
                                <div class="product-hover custom-product-hover">
                                    <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] == 3) {?>
                                    <a href="<?=ROOT_URL . '/cart.php?id=' . $book['ISBN']?>" class="add-to-cart-link custom-btn"><i class="fa fa-shopping-cart"></i> THÊM VÀO GIỎ</a>
                                    <?php }?>
                                    <a href="<?=ROOT_URL . '/book-details.php?id=' . $book['ISBN']?>" class="view-details-link custom-btn"><i class="fa fa-link"></i> CHI TIẾT</a>
                                </div>
                            </div>
                            <div class="product-info-left">
                                <h2><a href="<?=ROOT_URL . '/book-details.php?id=' . $book['ISBN']?>"><?=$book['BookTitle']?></a></h2>
                                <div class="product-carousel-price custom-price">
                                    <ins><?=number_format($book['Price'])?> đ</ins>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'?>

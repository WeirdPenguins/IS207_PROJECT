<?php include 'header.php'?>

<?php
    $isbn = isset($_GET['id']) ? $_GET['id'] : '';
    $sql = "SELECT * FROM Books, Languages, Categories, Publishes WHERE Books.LanguageID = Languages.LanguageID AND Books.CategoryID = Categories.CategoryID AND Books.PublishID = Publishes.PublishID AND ISBN = '$isbn'";
    $book = Database::GetData($sql, ['row' => 0]);
?>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=ROOT_URL?>">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="<?=ROOT_URL . '/category-book.php?CategoryID=' . $book['CategoryID']?>"><?=$book['CategoryName']?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=$book['BookTitle']?></li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <!-- Book Details -->
            <div class="col-md-4">
                <div class="book-image-container">
                    <div class="main-image">
                        <img src="<?=ROOT_URL . $book['Thumbnail']?>" alt="<?=$book['BookTitle']?>" class="img-fluid">
                    </div>
                    <div class="image-actions">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="book-info">
                    <h1 class="book-title"><?=$book['BookTitle']?></h1>
                    
                    <div class="book-meta">
                        <div class="price-section">
                            <div class="price-wrapper">
                                <span class="current-price"><?=number_format($book['Price'])?> đ</span>
                            </div>
                        </div>
                        
                        <div class="book-details-flex mt-3 mb-3">
                            <div class="book-detail-row">
                                <div class="book-detail-label">Mã sản phẩm:</div>
                                <div class="book-detail-value"><?=$book['ISBN']?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Nhà xuất bản:</div>
                                <div class="book-detail-value"><?=$book['PublishName']?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Năm xuất bản:</div>
                                <div class="book-detail-value"><?=$book['PublishYear']?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Ngôn ngữ:</div>
                                <div class="book-detail-value"><?=$book['LanguageName']?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Số trang:</div>
                                <div class="book-detail-value"><?=$book['PageNumber']?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Kích thước:</div>
                                <div class="book-detail-value"><?=$book['Size']?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Trọng lượng:</div>
                                <div class="book-detail-value"><?=$book['Weight']?> gam</div>
                            </div>
                        </div>
                    </div>

                    <div class="book-actions">
                        <div class="quantity-selector">
                            <label>Số lượng:</label>
                            <div class="quantity-control">
                                <button class="btn-quantity" onclick="decreaseQuantity()">-</button>
                                <input type="number" class="form-control" id="quantity" value="1" min="1">
                                <button class="btn-quantity" onclick="increaseQuantity()">+</button>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <button class="btn btn-primary btn-lg btn-cart" onclick="addToCart('<?=$book['ISBN']?>')">
                                <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                            </button>
                            <button class="btn btn-danger btn-lg btn-buy" onclick="buyNow('<?=$book['ISBN']?>')">
                                Mua ngay
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Book Description -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="book-description">
                    <div class="description-header">
                        <h3>Mô tả sản phẩm</h3>
                        <div class="description-tabs">
                            <button class="tab-btn active" onclick="switchTab('description')">Mô tả</button>
                            <button class="tab-btn" onclick="switchTab('details')">Chi tiết</button>
                            <button class="tab-btn" onclick="switchTab('reviews')">Đánh giá</button>
                        </div>
                    </div>
                    <div class="description-content" id="description-content">
                        <?=$book['Description']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/book-details.js"></script>


<?php include 'footer.php'?>
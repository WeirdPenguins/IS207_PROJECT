
<?php include 'header.php'?>

<?php
    $isbn = isset($_GET['id']) ? $_GET['id'] : '';
    $book = null;
    if ($isbn !== '') {
        $sql = "SELECT Books.*, Languages.LanguageName, Categories.CategoryName, Publishes.PublishName, Authors.AuthorName
                FROM Books
                INNER JOIN Languages ON Books.LanguageID = Languages.LanguageID
                INNER JOIN Categories ON Books.CategoryID = Categories.CategoryID
                INNER JOIN Publishes ON Books.PublishID = Publishes.PublishID
                INNER JOIN Authors ON Books.AuthorID = Authors.AuthorID
                WHERE Books.ISBN = '$isbn'";
        $book = Database::GetData($sql, ['row' => 0]);
    }
    if (!$book) {
        echo "<div class='container mt-5'><div class='alert alert-danger'>Không tìm thấy sách hoặc sách chưa có tác giả hợp lệ!</div></div>";
        include 'footer.php';
        exit;
    }
?>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=ROOT_URL?>">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="<?=ROOT_URL . '/category-book.php?CategoryID=' . $book['CategoryID']?>"><?=htmlspecialchars($book['CategoryName'])?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=htmlspecialchars($book['BookTitle'])?></li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <!-- Book Details -->
            <div class="col-md-4">
                <div class="book-image-container">
                    <div class="main-image">
                        <img src="<?=ROOT_URL . $book['Thumbnail']?>" alt="<?=htmlspecialchars($book['BookTitle'])?>" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="book-info">
                    <h1 class="book-title"><?=htmlspecialchars($book['BookTitle'])?></h1>
                    
                    <div class="book-meta">
                        <div class="price-section">
                            <div class="price-wrapper">
                                <span class="current-price"><?=number_format($book['Price'])?> đ</span>
                            </div>
                        </div>
                        
                        <div class="book-details-flex mt-3 mb-3">
                            <div class="book-detail-row">
                                <div class="book-detail-label">Mã sản phẩm:</div>
                                <div class="book-detail-value"><?=htmlspecialchars($book['ISBN'])?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Tác giả:</div>
                                <div class="book-detail-value"><?=htmlspecialchars($book['AuthorName'])?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Nhà xuất bản:</div>
                                <div class="book-detail-value"><?=htmlspecialchars($book['PublishName'])?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Năm xuất bản:</div>
                                <div class="book-detail-value"><?=htmlspecialchars($book['PublishYear'])?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Ngôn ngữ:</div>
                                <div class="book-detail-value"><?=htmlspecialchars($book['LanguageName'])?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Số trang:</div>
                                <div class="book-detail-value"><?=htmlspecialchars($book['PageNumber'])?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Kích thước:</div>
                                <div class="book-detail-value"><?=htmlspecialchars($book['Size'])?></div>
                            </div>
                            <div class="book-detail-row">
                                <div class="book-detail-label">Trọng lượng:</div>
                                <div class="book-detail-value"><?=htmlspecialchars($book['Weight'])?> gam</div>
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
                        <?=htmlspecialchars($book['Description'])?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/book-details.js"></script>

<?php include 'footer.php'?>
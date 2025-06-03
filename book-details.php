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

        <!-- Book Rating -->
        <div class="row mt-4">
            <div class="col-12">
                <div id="book-rating-wrapper" style="display:none;">
                    <div class="book-rating" id="book-rating">
                        <style>
                        .rating-summary-box {
                            background: #fffbe7;
                            border-radius: 12px;
                            padding: 24px 20px 16px 20px;
                            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
                            margin-bottom: 24px;
                            text-align: center;
                        }
                        .rating-summary-box .avg-point {
                            font-size: 48px;
                            font-weight: bold;
                            color: #ff9800;
                            line-height: 1;
                        }
                        .rating-summary-box .star-list {
                            font-size: 32px;
                            margin: 8px 0 4px 0;
                        }
                        .rating-summary-box .total-rating {
                            color: #888;
                            font-size: 16px;
                        }
                        .your-rating-box {
                            background: #e8f5e9;
                            border-radius: 10px;
                            padding: 18px 16px;
                            margin-bottom: 18px;
                            border: 1px solid #b2dfdb;
                        }
                        .your-rating-box label {
                            font-weight: bold;
                            font-size: 18px;
                            margin-bottom: 8px;
                            display: block;
                        }
                        .your-rating-stars {
                            font-size: 32px;
                            margin-bottom: 6px;
                        }
                        .your-rating-box .rated-msg {
                            color: #388e3c;
                            font-weight: bold;
                            margin-left: 12px;
                        }
                        .review-list {
                            margin-top: 12px;
                        }
                        .review-item {
                            display: flex;
                            align-items: flex-start;
                            gap: 12px;
                            border-bottom: 1px solid #eee;
                            padding: 12px 0 8px 0;
                        }
                        .review-avatar {
                            width: 40px;
                            height: 40px;
                            border-radius: 50%;
                            background: #f5f5f5;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 20px;
                            color: #888;
                            font-weight: bold;
                        }
                        .review-content {
                            flex: 1;
                        }
                        .review-name {
                            font-weight: bold;
                            color: #333;
                        }
                        .review-stars {
                            color: #ff9800;
                            font-size: 20px;
                            margin-right: 8px;
                        }
                        .review-date {
                            color: #888;
                            font-size: 13px;
                        }
                        @media (max-width: 600px) {
                            .rating-summary-box { padding: 14px 4px 10px 4px; }
                            .your-rating-box { padding: 10px 4px; }
                            .review-item { flex-direction: column; gap: 4px; }
                            .review-avatar { width: 32px; height: 32px; font-size: 16px; }
                        }
                        </style>
                        <?php
                        // Lấy điểm trung bình và tổng số đánh giá
                        $sql = "SELECT AVG(Point) as avg_point, COUNT(*) as total FROM Rating WHERE ISBN = '$isbn'";
                        $ratingStats = Database::GetData($sql, ['row' => 0]);
                        $avgPoint = $ratingStats && $ratingStats['avg_point'] ? round($ratingStats['avg_point'], 1) : 0;
                        $totalRating = $ratingStats ? $ratingStats['total'] : 0;
                        ?>
                        <div class="rating-summary-box">
                            <div class="avg-point"><?= $avgPoint ?></div>
                            <div class="star-list">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span style="color:<?= $i <= round($avgPoint) ? '#ff9800' : '#eee' ?>;">★</span>
                                <?php endfor; ?>
                            </div>
                            <div class="total-rating">(<?= $totalRating ?> đánh giá)</div>
                        </div>
                        <?php if (isset($_SESSION['Username'])): ?>
                            <?php
                            $username = addslashes($_SESSION['Username']);
                            $sql = "SELECT * FROM Rating WHERE ISBN = '$isbn' AND Username = '$username'";
                            $userRating = Database::GetData($sql, ['row' => 0]);
                            ?>
                            <div class="your-rating-box">
                                <label>Đánh giá của bạn:</label>
                                <div class="your-rating-stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <button type="button" class="rating-star-btn" data-point="<?= $i ?>" data-isbn="<?= $isbn ?>" style="background:none;border:none;cursor:pointer;outline:none;">
                                            <span style="color:<?= ($userRating && $i <= $userRating['Point']) ? '#ff9800' : '#ccc' ?>;">★</span>
                                        </button>
                                    <?php endfor; ?>
                                    <?php if ($userRating): ?>
                                        <span class="rated-msg">(Bạn đã đánh giá <?= $userRating['Point'] ?> sao)</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div style="color:#d0021b;">Chỉ có thành viên mới có thể viết nhận xét. Vui lòng <a href="login.php" style="color:red;">đăng nhập</a> hoặc <a href="sign.php" style="color:blue;">đăng ký</a>.</div>
                        <?php endif; ?>
                        <div class="review-list">
                            <h5 style="margin-bottom:8px;">Danh sách đánh giá:</h5>
                            <?php
                            $sql = "SELECT r.Point, u.Fullname, u.Username, u.Avatar, r.UpdatedAt FROM Rating r JOIN Users u ON r.Username = u.Username WHERE r.ISBN = '$isbn' ORDER BY r.UpdatedAt DESC";
                            $ratings = Database::GetData($sql);
                            if ($ratings):
                                foreach ($ratings as $r):
                                    $avatar = $r['Avatar'] ? ROOT_URL . $r['Avatar'] : '';
                                    $avatarHtml = $avatar ? '<img src="' . htmlspecialchars($avatar) . '" class="review-avatar" style="object-fit:cover;width:40px;height:40px;">' : '<div class="review-avatar">' . strtoupper(substr($r['Fullname'] ?: $r['Username'], 0, 1)) . '</div>';
                            ?>
                                <div class="review-item">
                                    <?= $avatarHtml ?>
                                    <div class="review-content">
                                        <span class="review-name"><?= $r['Fullname'] ? htmlspecialchars($r['Fullname']) : htmlspecialchars($r['Username']) ?></span>
                                        <span class="review-stars">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <span><?= $i <= $r['Point'] ? '★' : '☆' ?></span>
                                            <?php endfor; ?>
                                        </span>
                                        <span class="review-date">(<?= date('d/m/Y H:i', strtotime($r['UpdatedAt'])) ?>)</span>
                                    </div>
                                </div>
                            <?php endforeach; else: ?>
                                <div style="color:#888;">Chưa có đánh giá nào.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/book-details.js"></script>
<script>
function switchTab(tabName) {
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(tab => tab.classList.remove('active'));
    event.target.classList.add('active');
    if(tabName === 'reviews') {
        document.getElementById('description-content').style.display = 'none';
        document.getElementById('book-rating-wrapper').style.display = '';
    } else {
        document.getElementById('description-content').style.display = '';
        document.getElementById('book-rating-wrapper').style.display = 'none';
    }
}
</script>

<?php include 'footer.php'?>
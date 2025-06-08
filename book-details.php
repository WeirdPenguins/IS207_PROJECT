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
                      <link href="<?=ROOT_URL . '/assets/css/book-details.css'?>" rel="stylesheet">

                        <div class="rating-section">
                            <?php
                            // Lấy điểm trung bình và tổng số đánh giá
                            $sql = "SELECT AVG(Point) as avg_point, COUNT(*) as total FROM Rating WHERE ISBN = '$isbn'";
                            $ratingStats = Database::GetData($sql, ['row' => 0]);
                            $avgPoint = $ratingStats && $ratingStats['avg_point'] ? round($ratingStats['avg_point'], 1) : 0;
                            $totalRating = $ratingStats ? $ratingStats['total'] : 0;

                            // Lấy đánh giá của user hiện tại nếu đã đăng nhập
                            $userRating = null;
                            if (isset($_SESSION['Username'])) {
                                $username = $_SESSION['Username'];
                                $sql = "SELECT * FROM Rating WHERE ISBN = '$isbn' AND Username = '$username'";
                                $userRating = Database::GetData($sql, ['row' => 0]);
                            }
                            ?>

                            <div class="rating-summary-box">
                                <div class="avg-point"><?= $avgPoint ?></div>
                                <div class="star-list">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span style="color:<?= $i <= round($avgPoint) ? '#ffc107' : '#ccc' ?>">★</span>
                                    <?php endfor; ?>
                                </div>
                                <div class="total-rating">(<?= $totalRating ?> đánh giá)</div>
                            </div>

                            <?php if (isset($_SESSION['Username'])): ?>
                                <div class="your-rating-box">
                                    <label>Đánh giá của bạn:</label>
                                    <div class="your-rating-stars">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <button type="button" class="rating-star-btn" data-point="<?= $i ?>" data-isbn="<?= $isbn ?>" style="background:none;border:none;cursor:pointer;outline:none;">
                                                <span style="color:<?= ($userRating && $i <= $userRating['Point']) ? '#ffc107' : '#ccc' ?>;">★</span>
                                            </button>
                                        <?php endfor; ?>
                                        <?php if ($userRating): ?>
                                            <span style="margin-left:8px;color:green;">(Bạn đã đánh giá <?= $userRating['Point'] ?> sao)</span>
                                        <?php endif; ?>
                                    </div>
                                    <div style="margin-top: 8px;">
                                        <textarea id="rating-comment" placeholder="Nhập đánh giá của bạn về sản phẩm này..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-height: 80px;"><?= $userRating ? htmlspecialchars($userRating['Comment']) : '' ?></textarea>
                                        <button type="button" id="submit-rating" class="btn btn-primary" style="margin-top: 8px;">Gửi đánh giá</button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div style="color:#d0021b;">Chỉ có thành viên mới có thể viết nhận xét. Vui lòng <a href="sign.php" style="color:red;">đăng nhập</a> hoặc <a href="sign.php" style="color:blue;">đăng ký</a>.</div>
                            <?php endif; ?>

                            <div class="review-list">
                                <h5 style="margin-bottom:8px;">Danh sách đánh giá:</h5>
                                <?php
                                $sql = "SELECT r.Point, r.Comment, u.Fullname, u.Username, u.Avatar, r.UpdatedAt FROM Rating r JOIN Users u ON r.Username = u.Username WHERE r.ISBN = '$isbn' ORDER BY r.UpdatedAt DESC";
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
                                            <?php if ($r['Comment']): ?>
                                                <div class="review-comment mt-2"><?= nl2br(htmlspecialchars($r['Comment'])) ?></div>
                                            <?php endif; ?>
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?=ROOT_URL?>/assets/js/book-details.js"></script>
<script src="<?=ROOT_URL?>/assets/js/rating.js"></script>

<?php include 'footer.php'?>
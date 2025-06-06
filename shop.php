<?php include 'header.php'; ?>
<link href="<?=ROOT_URL . '/assets/css/shop.css'?>" rel="stylesheet">

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <!-- Sidebar bộ lọc bên trái -->
            <div class="col-md-3">
                <form method="get" action="">
                    <div class="filter-card">
                        <div class="card-header">Lọc sản phẩm</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="keyword" class="form-label">Từ khóa</label>
                                <input type="text" class="form-control" name="keyword" id="keyword" value="<?=isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''?>" placeholder="Tìm theo tên sách">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá tối đa</label>
                                <input type="number" class="form-control" name="max_price" id="price" value="<?=isset($_GET['max_price']) ? intval($_GET['max_price']) : ''?>" placeholder="Nhập giá tối đa" min="0" step="1000">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Thể loại</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">Tất cả</option>
                                    <?php
                                    $categories = Database::GetData("SELECT * FROM Categories");
                                    foreach ($categories as $cat) {
                                        $selected = (isset($_GET['category']) && $_GET['category'] == $cat['CategoryID']) ? 'selected' : '';
                                        echo "<option value='{$cat['CategoryID']}' $selected>" . htmlspecialchars($cat['CategoryName']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="author" class="form-label">Tác giả</label>
                                <select class="form-control" name="author" id="author">
                                    <option value="">Tất cả</option>
                                    <?php
                                    $authors = Database::GetData("SELECT * FROM Authors");
                                    foreach ($authors as $author) {
                                        $selected = (isset($_GET['author']) && $_GET['author'] == $author['AuthorID']) ? 'selected' : '';
                                        echo "<option value='{$author['AuthorID']}' $selected>" . htmlspecialchars($author['AuthorName']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Lọc</button>
                            <a href="<?=ROOT_URL . '/products.php'?>" class="btn btn-secondary btn-block mt-2">Xóa bộ lọc</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Danh sách sản phẩm bên phải -->
            <div class="col-md-9">
                <div class="sort-control">
                    <label for="sort" class="form-label">Sắp xếp theo</label>
                    <select class="form-control" name="sort" id="sort" onchange="window.location.href='?sort='+this.value">
                        <option value="updated_desc" <?=isset($_GET['sort']) && $_GET['sort'] == 'updated_desc' ? 'selected' : ''?>>Mới cập nhật</option>
                        <option value="price_asc" <?=isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : ''?>>Giá: Thấp đến cao</option>
                        <option value="price_desc" <?=isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : ''?>>Giá: Cao đến thấp</option>
                        <option value="title_asc" <?=isset($_GET['sort']) && $_GET['sort'] == 'title_asc' ? 'selected' : ''?>>Tên: A-Z</option>
                        <option value="title_desc" <?=isset($_GET['sort']) && $_GET['sort'] == 'title_desc' ? 'selected' : ''?>>Tên: Z-A</option>
                    </select>
                </div>
                <div class="row">
                    <?php
                        $where = [];
                        if (isset($_GET['keyword']) && $_GET['keyword'] !== '') {
                            $where[] = "BookTitle LIKE '%" . addslashes($_GET['keyword']) . "%'";
                        }
                        if (isset($_GET['max_price']) && $_GET['max_price'] !== '') {
                            $where[] = "Price <= " . intval($_GET['max_price']);
                        }
                        if (isset($_GET['category']) && $_GET['category'] !== '') {
                            $where[] = "CategoryID = " . intval($_GET['category']);
                        }
                        if (isset($_GET['author']) && $_GET['author'] !== '') {
                            $where[] = "AuthorID = " . intval($_GET['author']);
                        }
                        $whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';
                        
                        // Xử lý sắp xếp
                        $sortSql = 'ORDER BY UpdatedAt DESC';
                        if (isset($_GET['sort'])) {
                            switch ($_GET['sort']) {
                                case 'price_asc':
                                    $sortSql = 'ORDER BY Price ASC';
                                    break;
                                case 'price_desc':
                                    $sortSql = 'ORDER BY Price DESC';
                                    break;
                                case 'title_asc':
                                    $sortSql = 'ORDER BY BookTitle ASC';
                                    break;
                                case 'title_desc':
                                    $sortSql = 'ORDER BY BookTitle DESC';
                                    break;
                                default:
                                    $sortSql = 'ORDER BY UpdatedAt DESC';
                                    break;
                            }
                        }
                        
                        $sql = "SELECT * FROM Books $whereSql $sortSql";
                        $books = Database::GetData($sql);
                        if (empty($books)) {
                            echo '<div class="col-md-12"><div class="empty-state">Không tìm thấy sản phẩm nào phù hợp với bộ lọc.</div></div>';
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
    </div>
</div>
<?php include 'footer.php'; ?>
<?php include '../header.php'?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Add images
        $image_path = '';
        if (isset($_FILES['pic']) && $_FILES['pic']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $ext = strtolower(pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed)) {
                $filename = time() . '_' . basename($_FILES['pic']['name']);
                $upload_dir = '../../assets/img/books/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $image_path = '/assets/img/books/' . $filename;
                move_uploaded_file($_FILES['pic']['tmp_name'], $upload_dir . $filename);
            } else {
                $image_path = '';
                $message = [
                    'type' => 'warning',
                    'text' => 'Chỉ cho phép upload file ảnh (jpg, jpeg, png, gif)',
                ];
            }
        }

        // Add items
        if (isset($_POST['action']) && $_POST['action'] == 'add') {
            $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $publish_year = isset($_POST['publish_year']) ? $_POST['publish_year'] : '';
            $weight = isset($_POST['weight']) ? $_POST['weight'] : '';
            $size_width = isset($_POST['size_width']) ? $_POST['size_width'] : '';
            $size_height = isset($_POST['size_height']) ? $_POST['size_height'] : '';
            $page = isset($_POST['page']) ? $_POST['page'] : '';
            $language = isset($_POST['language']) ? $_POST['language'] : '';
            $price = isset($_POST['price']) ? $_POST['price'] : '';
            $category = isset($_POST['category']) ? $_POST['category'] : '';
            $publish = isset($_POST['publish']) ? $_POST['publish'] : '';
            $author = isset($_POST['author']) ? $_POST['author'] : '';

            if (!empty($name)) {
                $sql = "INSERT INTO Books (ISBN, BookTitle, Description, PublishYear, Weight, Size, PageNumber, Thumbnail, LanguageID, Price, CategoryID, PublishID, UpdatedAt, AuthorID)
                        VALUES ('$isbn', '$name', '$description', $publish_year, $weight, '$size_width x $size_height', $page, '$image_path', '$language', $price, $category, $publish, NOW(3), '$author')";
                if (Database::NonQuery($sql)) {
                    $message = [
                        'type' => 'success',
                        'text' => 'Thêm thành công',
                    ];
                }
            } else {
                $message = [
                    'type' => 'warning',
                    'text' => 'Tên sách không được trống',
                ];
            }
        }

        // Edit items
        if (isset($_POST['action']) && $_POST['action'] == 'edit') {
            $id = isset($_GET['edit-id']) ? $_GET['edit-id'] : '';
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $publish_year = isset($_POST['publish_year']) ? $_POST['publish_year'] : '';
            $weight = isset($_POST['weight']) ? $_POST['weight'] : '';
            $size_width = isset($_POST['size_width']) ? $_POST['size_width'] : '';
            $size_height = isset($_POST['size_height']) ? $_POST['size_height'] : '';
            $page = isset($_POST['page']) ? $_POST['page'] : '';
            $language = isset($_POST['language']) ? $_POST['language'] : '';
            $price = isset($_POST['price']) ? $_POST['price'] : '';
            $category = isset($_POST['category']) ? $_POST['category'] : '';
            $publish = isset($_POST['publish']) ? $_POST['publish'] : '';
            $author = isset($_POST['author']) ? $_POST['author'] : '';

            if (!empty($name)) {
                $thumbnail_sql = !empty($image_path) ? "Thumbnail = '$image_path', " : '';
                $sql = "UPDATE Books SET $thumbnail_sql BookTitle = '$name', Description = '$description', PublishYear = '$publish_year', Weight = '$weight', Size = '$size_width x $size_height', PageNumber = $page, LanguageID = '$language', Price = $price, CategoryID = $category, PublishID = $publish, UpdatedAt = NOW(3), AuthorID = '$author' WHERE ISBN = '$id'";
                if (Database::NonQuery($sql)) {
                    $message = [
                        'type' => 'success',
                        'text' => 'Cập nhật thành công',
                    ];
                }
            } else {
                $message = [
                    'type' => 'warning',
                    'text' => 'Tên sách không được trống',
                ];
            }
        }
    }

    // Delete items
    if (isset($_GET['del-id'])) {
        $id = isset($_GET['del-id']) ? $_GET['del-id'] : '';
        Database::NonQuery("DELETE FROM composers WHERE ISBN = $id");
        Database::NonQuery("DELETE FROM Order_Details WHERE ISBN = $id");
        Database::NonQuery("DELETE FROM Carts WHERE ISBN = $id");
        Database::NonQuery("DELETE FROM rating WHERE ISBN = $id");
        $sql = "DELETE FROM Books WHERE ISBN = $id";

        if (Database::NonQuery($sql)) {
            $message = [
                'type' => 'success',
                'text' => 'Xoá thành công',
            ];
        }
    }
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?=ADMIN_URL?>/dasboard/" class="brand-link">
        <img src="<?=ROOT_URL?>/assets/img/Rebook_logo.png" alt="Rebook logo" style="width: 100%">
    </a>
    <?php include '../sidebar.php'?>
</aside>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sách</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?=ADMIN_URL?>/"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Sách</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <?php include '../alert.php'?>

        <!-- Modal: Add -->
        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 800px">
                <form class="modal-content" method="POST" enctype="multipart/form-data">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title">Thêm sách</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>ISBN</label>
                                <input type="text" name="isbn" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Tên sách</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mô tả</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Năm xuất bản</label>
                                <select class="form-control" name="publish_year" required>
                                    <?php
                                        for ($i = 2016; $i <= 2025; $i++) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Trọng lượng</label>
                                <div class="input-group">
                                    <input type="number" name="weight" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">gam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Kích thước</label>
                                <div class="input-group">
                                    <input type="number" name="size_width" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">x</span>
                                    </div>
                                    <input type="number" name="size_height" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">mm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Số trang</label>
                                <input type="number" name="page" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="pic" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Ngôn ngữ</label>
                                <select class="form-control" name="language">
                                    <?php
                                        $sql = 'SELECT * FROM Languages';
                                        $languages = Database::GetData($sql);
                                        if ($languages) {
                                            foreach ($languages as $lang) {
                                                echo '<option value="' . $lang['LanguageID'] . '">' . $lang['LanguageName'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Giá</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="category" required>
                                    <?php
                                        $sql = 'SELECT * FROM Categories';
                                        $categories = Database::GetData($sql);
                                        if ($categories) {
                                            foreach ($categories as $cate) {
                                                echo '<option value="' . $cate['CategoryID'] . '">' . $cate['CategoryName'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nhà xuất bản</label>
                                <select class="form-control" name="publish" required>
                                    <?php
                                        $sql = 'SELECT * FROM Publishes';
                                        $publishes = Database::GetData($sql);
                                        if ($publishes) {
                                            foreach ($publishes as $pub) {
                                                echo '<option value="' . $pub['PublishID'] . '">' . $pub['PublishName'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Tác giả</label>
                                <select class="form-control" name="author" required>
                                    <option value="">Chọn tác giả</option>
                                    <?php
                                        $sql = 'SELECT * FROM Authors';
                                        $authors = Database::GetData($sql);
                                        if ($authors) {
                                            foreach ($authors as $author) {
                                                echo '<option value="' . $author['AuthorID'] . '">' . $author['AuthorName'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
                        <button name="action" value="add" class="btn btn-success">Thêm</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal: Edit -->
        <?php
            $id = isset($_GET['edit-id']) ? $_GET['edit-id'] : '';
            $book = [];
            if ($id != '') {
                $sql = "SELECT * FROM Books WHERE ISBN = '$id'";
                $book = Database::GetData($sql, ['row' => 0]);
            }
        ?>
        <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 800px">
                <form class="modal-content" method="POST" enctype="multipart/form-data">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title">Sửa sách</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>ISBN</label>
                                <input type="text" name="isbn" value="<?=$book['ISBN']?>" class="form-control" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Tên sách</label>
                                <input type="text" name="name" value="<?=$book['BookTitle']?>" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mô tả</label>
                                <input type="text" name="description" value="<?=$book['Description']?>" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Năm xuất bản</label>
                                <select class="form-control" name="publish_year">
                                    <?php
                                        for ($i = 2016; $i <= 2025; $i++) {
                                            $selected = $i == $book['PublishYear'] ? 'selected' : '';
                                            echo "<option value='$i' $selected>$i</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Trọng lượng</label>
                                <div class="input-group">
                                    <input type="number" name="weight" value="<?=$book['Weight']?>" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">gam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <?php $size = explode(' x ', $book['Size']);?>
                                <label>Kích thước</label>
                                <div class="input-group">
                                    <input type="number" value="<?=$size[0]?>" name="size_width" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">x</span>
                                    </div>
                                    <input type="number" value="<?=$size[1]?>" name="size_height" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">mm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Số trang</label>
                                <input type="number" name="page" value="<?=$book['PageNumber']?>" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="pic" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Ngôn ngữ</label>
                                <select class="form-control" name="language">
                                    <?php
                                        $sql = 'SELECT * FROM Languages';
                                        $languages = Database::GetData($sql);
                                        if ($languages) {
                                            foreach ($languages as $lang) {
                                                $selected = $lang['LanguageID'] == $book['LanguageID'] ? 'selected' : '';
                                                echo '<option value="' . $lang['LanguageID'] . '"' . $selected . '>' . $lang['LanguageName'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Giá</label>
                                <input type="number" name="price" value="<?=$book['Price']?>" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="category">
                                    <?php
                                        $sql = 'SELECT * FROM Categories';
                                        $categories = Database::GetData($sql);
                                        if ($categories) {
                                            foreach ($categories as $cate) {
                                                $selected = $cate['CategoryID'] == $book['CategoryID'] ? 'selected' : '';
                                                echo '<option value="' . $cate['CategoryID'] . '"' . $selected . '>' . $cate['CategoryName'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nhà xuất bản</label>
                                <select class="form-control" name="publish">
                                    <?php
                                        $sql = 'SELECT * FROM Publishes';
                                        $publishes = Database::GetData($sql);
                                        if ($publishes) {
                                            foreach ($publishes as $pub) {
                                                $selected = $pub['PublishID'] == $book['PublishID'] ? 'selected' : '';
                                                echo '<option value="' . $pub['PublishID'] . '"' . $selected . '>' . $pub['PublishName'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Tác giả</label>
                                <select class="form-control" name="author" required>
                                    <option value="">Chọn tác giả</option>
                                    <?php
                                        $sql = 'SELECT * FROM Authors';
                                        $authors = Database::GetData($sql);
                                        if ($authors) {
                                            foreach ($authors as $author) {
                                                $selected = (isset($book['AuthorID']) && $book['AuthorID'] == $author['AuthorID']) ? 'selected' : '';
                                                echo '<option value="' . $author['AuthorID'] . '" ' . $selected . '>' . $author['AuthorName'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
                        <button name="action" value="edit" class="btn btn-success">Sửa</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row my-2 d-flex-end">
                <button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#modal-add">
                    <i class="fas fa-plus"></i>
                </button>
                <form method="GET">
                    <div class="input-group">
                        <input type="text" name="keyword" placeholder="Từ khoá" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-outline-info"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row my-2">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead class="table-warning">
                                <tr>
                                    <th>ISBN</th>
                                    <th>Tên sách</th>
                                    <th>Tác giả</th>
                                    <th>Hình ảnh</th>
                                    <th>Ngôn ngữ</th>
                                    <th>Giá</th>
                                    <th>Danh mục</th>
                                    <th width="160">Công cụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $pager = (new Pagination())->get('Books', $page, ROW_OF_PAGE);

                                    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                                    if ($keyword) {
                                        $keyword = "AND BookTitle LIKE '%$keyword%'";
                                    }

                                    $sql = "SELECT Books.*, Languages.LanguageName, Categories.CategoryName, Authors.AuthorName
                                            FROM Books
                                            LEFT JOIN Languages ON Books.LanguageID = Languages.LanguageID
                                            LEFT JOIN Categories ON Books.CategoryID = Categories.CategoryID
                                            LEFT JOIN Authors ON Books.AuthorID = Authors.AuthorID
                                            WHERE 1=1 $keyword
                                            ORDER BY UpdatedAt DESC
                                            LIMIT " . $pager['StartIndex'] . ', ' . ROW_OF_PAGE;
                                    $books = Database::GetData($sql);

                                    if ($books) {
                                        foreach ($books as $book) {
                                            echo '
                                                <tr>
                                                    <th>' . $book['ISBN'] . '</th>
                                                    <td>' . $book['BookTitle'] . '</td>
                                                    <td>' . htmlspecialchars($book['AuthorName']) . '</td>
                                                    <td class="text-center"><img height="60" src="' . ROOT_URL . $book['Thumbnail'] . '" alt="" /></td>
                                                    <td>' . $book['LanguageName'] . '</td>
                                                    <td>' . number_format($book['Price']) . '</td>
                                                    <td>' . $book['CategoryName'] . '</td>
                                                    <td>
                                                        <a href="' . ROOT_URL . '/book-details.php?id=' . $book['ISBN'] . '"class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="?edit-id=' . $book['ISBN'] . '"class="btn btn-warning"><i class="fas fa-marker"></i></a>
                                                        <a onclick="removeRow(' . $book['ISBN'] . ')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                    } else {
                                        echo '<tr><td colspan="100%" class="text-center">Không có dữ liệu</td></tr>';
                                    }
                                ?>
                                <button type="button" data-toggle="modal" data-target="#modal-edit" hidden>
                                    <i class="fas fa-plus"></i>
                                </button>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-2 d-flex-between">
                <div>Hiển thị từ <?=$pager['StartPage']?> đến <?=$pager['EndPage']?> của <?=$pager['TotalItems']?> bản ghi</div>
                <ul class="pagination">
                    <?php
                        for ($i = 1; $i <= $pager['TotalPages']; $i++) {
                            $active = $page == $i ? 'active' : '';
                            echo '<li class="page-item ' . $active . '">
                                <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                            </li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php include '../footer.php'?>

<script>
$(document).ready(function() {
    function GetParameterValues(param) {
        var url = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < url.length; i++) {
            var urlparam = url[i].split('=');
            if (urlparam[0] == param) {
                return urlparam[1];
            }
        }
    }

    if (GetParameterValues('edit-id') != undefined) {
        document.querySelector("[data-target='#modal-edit']").click();
    }
});

function removeRow(id) {
    if (confirm('Bạn có chắc chắn muốn xoá không?')) {
        window.location = '?del-id=' + id;
    }
}
</script>
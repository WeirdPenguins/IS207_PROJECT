<?php include '../header.php'?>

<?php
// Xử lý thêm/sửa/xóa voucher
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? addslashes($_POST['name']) : '';
    $discount = isset($_POST['discount']) ? intval($_POST['discount']) : 0;
    $start = isset($_POST['start']) ? $_POST['start'] : '';
    $end = isset($_POST['end']) ? $_POST['end'] : '';
    $user = isset($_POST['username']) ? addslashes($_POST['username']) : null;

    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        if ($name && $discount && $start && $end) {
            $sql = "INSERT INTO vouchers (VoucherName, Discount, StartTime, EndTime, Username) VALUES ('$name', $discount, '$start', '$end', " . ($user ? "'$user'" : "NULL") . ")";
            Database::NonQuery($sql);
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : '';
        if ($id && $name && $discount && $start && $end) {
            $sql = "UPDATE vouchers SET VoucherName='$name', Discount=$discount, StartTime='$start', EndTime='$end', Username=" . ($user ? "'$user'" : "NULL") . " WHERE VoucherID=$id";
            Database::NonQuery($sql);
        }
    }
}

if (isset($_GET['del-id'])) {
    $id = isset($_GET['del-id']) ? intval($_GET['del-id']) : '';
    if ($id) {
        $sql = "DELETE FROM vouchers WHERE VoucherID=$id";
        Database::NonQuery($sql);
    }
}

// Lấy dữ liệu voucher để sửa nếu có edit-id
$book = [];
if (isset($_GET['edit-id'])) {
    $id = $_GET['edit-id'];
    if ($id != '') {
        $sql = "SELECT * FROM vouchers WHERE VoucherID = '$id'";
        $book = Database::GetData($sql, ['row' => 0]);
    }
}
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?=ADMIN_URL?>/dasboard/" class="brand-link">
        <img src="<?=ROOT_URL?>/assets/img/bht_bookstore_logo.png" alt="BHT Bookstore" style="width: 100%">
    </a>
    <?php include '../sidebar.php'?>
</aside>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Quản lý khuyến mãi</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=ADMIN_URL?>/"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Khuyến mãi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row my-2 d-flex-end">
                <form method="GET">
                    <div class="input-group">
                        <input type="text" name="keyword" placeholder="Từ khoá" class="form-control" value="<?=isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-info"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <button class="btn btn-success ml-2" data-toggle="modal" data-target="#modal-add"><i class="fas fa-plus"></i> Thêm khuyến mãi</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="table-warning">
                            <tr>
                                <th>ID</th>
                                <th>Tên voucher</th>
                                <th>Giảm (%)</th>
                                <th>Bắt đầu</th>
                                <th>Kết thúc</th>
                                <th>Trạng thái</th>
                                <th>Username</th>
                                <th width="120">Công cụ</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $keyword = isset($_GET['keyword']) ? addslashes($_GET['keyword']) : '';
                            $where = $keyword ? "WHERE VoucherName LIKE '%$keyword%'" : '';
                            $sql = "SELECT * FROM vouchers $where ORDER BY VoucherID DESC";
                            $vouchers = Database::GetData($sql);
                            if ($vouchers) {
                                foreach ($vouchers as $v) {
                                    echo '<tr>
                                        <th>'.$v['VoucherID'].'</th>
                                        <td>'.htmlspecialchars($v['VoucherName']).'</td>
                                        <td>'.$v['Discount'].'</td>
                                        <td>'.$v['StartTime'].'</td>
                                        <td>'.$v['EndTime'].'</td>
                                        <td>';
                                    // Hiển thị trạng thái nếu có trường UsedStatus, nếu không thì để trống hoặc badge mặc định
                                    if (isset($v['UsedStatus'])) {
                                        echo $v['UsedStatus'] ? '<span class="badge badge-success">Đã dùng</span>' : '<span class="badge badge-secondary">Chưa dùng</span>';
                                    } else {
                                        echo '<span class="badge badge-secondary">Chưa xác định</span>';
                                    }
                                    echo '</td>
                                        <td>'.htmlspecialchars($v['Username']).'</td>
                                        <td>
                                            <a href="?edit-id='.$v['VoucherID'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a onclick="return confirm(\'Xoá voucher này?\')" href="?del-id='.$v['VoucherID'].'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="100%" class="text-center">Không có dữ liệu</td></tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content" method="POST">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title">Thêm khuyến mãi</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Tên voucher</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Giảm (%)</label>
                                <input type="number" name="discount" class="form-control" min="1" max="100" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bắt đầu</label>
                                <input type="datetime-local" name="start" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Kết thúc</label>
                                <input type="datetime-local" name="end" class="form-control" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Username (nếu có)</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                        <button class="btn btn-success">Thêm</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        <?php if (!empty($book) && isset($book['VoucherID'])): ?>
        <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content" method="POST">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">Sửa khuyến mãi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location='list.php'">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" value="<?=$book['VoucherID']?>">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Tên voucher</label>
                                <input type="text" name="name" class="form-control" value="<?=htmlspecialchars($book['VoucherName'])?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Giảm (%)</label>
                                <input type="number" name="discount" class="form-control" min="1" max="100" value="<?=$book['Discount']?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bắt đầu</label>
                                <input type="datetime-local" name="start" class="form-control" value="<?=date('Y-m-d\TH:i', strtotime($book['StartTime']))?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Kết thúc</label>
                                <input type="datetime-local" name="end" class="form-control" value="<?=date('Y-m-d\TH:i', strtotime($book['EndTime']))?>" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Username (nếu có)</label>
                                <input type="text" name="username" class="form-control" value="<?=htmlspecialchars($book['Username'])?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.location='list.php'">Huỷ</button>
                        <button class="btn btn-warning">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#modal-edit').modal('show');
            });
        </script>
        <?php endif; ?>
    </section>
</div>
<?php include '../footer.php'; ?>
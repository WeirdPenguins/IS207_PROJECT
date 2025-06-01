<?php include '../header.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Thêm voucher
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $discount = isset($_POST['discount']) ? intval($_POST['discount']) : 0;
        $start = isset($_POST['start']) ? $_POST['start'] : '';
        $end = isset($_POST['end']) ? $_POST['end'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $status = isset($_POST['status']) ? intval($_POST['status']) : 1;
        if (!empty($name) && $discount && $start && $end) {
            $sql = "INSERT INTO vouchers (VoucherName, Discount, StartTime, EndTime, Username, UsedStatus) VALUES ('$name', $discount, '$start', '$end', " . ($username ? "'$username'" : "NULL") . ", $status)";
            if (Database::NonQuery($sql)) {
                $message = [
                    'type' => 'success',
                    'text' => 'Thêm thành công',
                ];
            }
        } else {
            $message = [
                'type' => 'warning',
                'text' => 'Vui lòng nhập đầy đủ thông tin voucher',
            ];
        }
    }

    // Sửa voucher
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $discount = isset($_POST['discount']) ? intval($_POST['discount']) : 0;
        $start = isset($_POST['start']) ? $_POST['start'] : '';
        $end = isset($_POST['end']) ? $_POST['end'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $status = isset($_POST['status']) ? intval($_POST['status']) : 1;
        if ($id && !empty($name) && $discount && $start && $end) {
            $sql = "UPDATE vouchers SET VoucherName = '$name', Discount = $discount, StartTime = '$start', EndTime = '$end', Username = " . ($username ? "'$username'" : "NULL") . ", UsedStatus = $status WHERE VoucherID = $id";
            if (Database::NonQuery($sql)) {
                $message = [
                    'type' => 'success',
                    'text' => 'Cập nhật thành công',
                ];
            }
        } else {
            $message = [
                'type' => 'warning',
                'text' => 'Vui lòng nhập đầy đủ thông tin voucher',
            ];
        }
    }
}

// Xóa voucher
if (isset($_GET['del-id'])) {
    $id = isset($_GET['del-id']) ? intval($_GET['del-id']) : '';
    if ($id) {
        $sql = "DELETE FROM vouchers WHERE VoucherID = $id";
        if (Database::NonQuery($sql)) {
            $message = [
                'type' => 'success',
                'text' => 'Xoá thành công',
            ];
        }
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
                    <h1 class="m-0">Voucher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?=ADMIN_URL?>/"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Voucher</li>
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
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <form class="modal-content" method="POST">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title">Thêm voucher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên voucher</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Giảm (%)</label>
                            <input type="number" name="discount" class="form-control" min="1" max="100">
                        </div>
                        <div class="form-group">
                            <label>Bắt đầu</label>
                            <input type="datetime-local" name="start" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kết thúc</label>
                            <input type="datetime-local" name="end" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Username (nếu có)</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control" name="status">
                                <option value="1">Hoạt động</option>
                                <option value="0">Khóa</option>
                            </select>
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
            $voucher = [];
            if ($id != '') {
                $sql = "SELECT * FROM vouchers WHERE VoucherID = $id";
                $voucher = Database::GetData($sql, ['row' => 0]);
            }
        ?>
        <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <form class="modal-content" method="POST">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title">Sửa voucher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?=isset($voucher['VoucherID']) ? $voucher['VoucherID'] : ''?>">
                        <div class="form-group">
                            <label>Tên voucher</label>
                            <input type="text" name="name" value="<?=isset($voucher['VoucherName']) ? $voucher['VoucherName'] : ''?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Giảm (%)</label>
                            <input type="number" name="discount" value="<?=isset($voucher['Discount']) ? $voucher['Discount'] : ''?>" class="form-control" min="1" max="100">
                        </div>
                        <div class="form-group">
                            <label>Bắt đầu</label>
                            <input type="datetime-local" name="start" value="<?=isset($voucher['StartTime']) ? date('Y-m-d\TH:i', strtotime($voucher['StartTime'])) : ''?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kết thúc</label>
                            <input type="datetime-local" name="end" value="<?=isset($voucher['EndTime']) ? date('Y-m-d\TH:i', strtotime($voucher['EndTime'])) : ''?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Username (nếu có)</label>
                            <input type="text" name="username" value="<?=isset($voucher['Username']) ? $voucher['Username'] : ''?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control" name="status">
                                <option value="1" <?=isset($voucher['UsedStatus']) && $voucher['UsedStatus'] == 1 ? 'selected' : ''?>>Hoạt động</option>
                                <option value="0" <?=isset($voucher['UsedStatus']) && $voucher['UsedStatus'] == 0 ? 'selected' : ''?>>Khóa</option>
                            </select>
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
                        <input type="text" name="keyword" placeholder="Từ khoá" class="form-control" value="<?=isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''?>">
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
                                    <th>ID</th>
                                    <th>Tên voucher</th>
                                    <th>Giảm (%)</th>
                                    <th>Bắt đầu</th>
                                    <th>Kết thúc</th>
                                    <th>Trạng thái</th>
                                    <th>Username</th>
                                    <th width="111">Công cụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include '../services/Helper.php';

                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $row_per_page = defined('ROW_OF_PAGE') ? ROW_OF_PAGE : 10;
                                    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                                    $where = '';
                                    if ($keyword) {
                                        $where = "WHERE VoucherName LIKE '%$keyword%'";
                                    }

                                    // Phân trang
                                    $total_sql = "SELECT COUNT(*) as total FROM vouchers $where";
                                    $total_row = Database::GetData($total_sql, ['row' => 0]);
                                    $total_items = $total_row ? $total_row['total'] : 0;
                                    $total_pages = ceil($total_items / $row_per_page);
                                    $start_index = ($page - 1) * $row_per_page;

                                    $sql = "SELECT * FROM vouchers $where ORDER BY VoucherID DESC LIMIT $start_index, $row_per_page";
                                    $vouchers = Database::GetData($sql);

                                    if ($vouchers) {
                                        foreach ($vouchers as $v) {
                                            echo '
                                                <tr>
                                                    <th>' . $v['VoucherID'] . '</th>
                                                    <td>' . htmlspecialchars($v['VoucherName']) . '</td>
                                                    <td>' . $v['Discount'] . '</td>
                                                    <td>' . $v['StartTime'] . '</td>
                                                    <td>' . $v['EndTime'] . '</td>
                                                    <td>';
                                            if (isset($v['UsedStatus'])) {
                                                echo $v['UsedStatus'] == 1
                                                    ? '<span class="badge badge-success">Hoạt động</span>'
                                                    : '<span class="badge badge-secondary">Khóa</span>';
                                            } else {
                                                echo '<span class="badge badge-secondary">Chưa xác định</span>';
                                            }
                                            echo '</td>
                                                    <td>' . htmlspecialchars($v['Username']) . '</td>
                                                    <td>
                                                        <a href="?edit-id=' . $v['VoucherID'] . '" class="btn btn-warning"><i class="fas fa-marker"></i></a>
                                                        <a onclick="removeRow(' . $v['VoucherID'] . ')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
                <div>Hiển thị từ <?=$start_index+1?> đến <?=min($start_index+$row_per_page, $total_items)?> của <?=$total_items?> bản ghi</div>
                <ul class="pagination">
                    <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
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
<?php include '../footer.php'; ?>

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
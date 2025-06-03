<?php
session_start();
header('Content-Type: application/json');
include 'config/database.php';

if (!isset($_SESSION['Username'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập để đánh giá!']);
    exit;
}

$isbn = isset($_POST['isbn']) ? addslashes($_POST['isbn']) : '';
$point = isset($_POST['point']) ? intval($_POST['point']) : 0;
$username = addslashes($_SESSION['Username']);

if (!$isbn || $point < 1 || $point > 5) {
    echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ!']);
    exit;
}

// Kiểm tra đã đánh giá chưa
$sql = "SELECT * FROM Rating WHERE ISBN = '$isbn' AND Username = '$username'";
$userRating = Database::GetData($sql, ['row' => 0]);
if ($userRating) {
    $sql = "UPDATE Rating SET Point = $point, UpdatedAt = NOW(3) WHERE ISBN = '$isbn' AND Username = '$username'";
} else {
    $sql = "INSERT INTO Rating (ISBN, Username, Point, UpdatedAt) VALUES ('$isbn', '$username', $point, NOW(3))";
}
Database::NonQuery($sql);

// Render lại phần rating (copy logic từ book-details.php)
ob_start();
// Lấy điểm trung bình và tổng số đánh giá
$sql = "SELECT AVG(Point) as avg_point, COUNT(*) as total FROM Rating WHERE ISBN = '$isbn'";
$ratingStats = Database::GetData($sql, ['row' => 0]);
$avgPoint = $ratingStats && $ratingStats['avg_point'] ? round($ratingStats['avg_point'], 1) : 0;
$totalRating = $ratingStats ? $ratingStats['total'] : 0;
// Lấy lại userRating
$sql = "SELECT * FROM Rating WHERE ISBN = '$isbn' AND Username = '$username'";
$userRating = Database::GetData($sql, ['row' => 0]);
?>
<h4>Đánh giá sản phẩm</h4>
<div style="font-size: 32px; font-weight: bold; display: flex; align-items: center; gap: 8px;">
    <span><?= $avgPoint ?></span><span style="font-size: 18px;">/5</span>
    <span style="margin-left: 16px; color: #888; font-size: 16px;">(<?= $totalRating ?> đánh giá)</span>
</div>
<div style="margin: 8px 0;">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <span style="color:<?= $i <= round($avgPoint) ? '#ffc107' : '#ccc' ?>; font-size: 24px;">★</span>
    <?php endfor; ?>
</div>
<hr>
<div style="margin-bottom: 16px;">
    <label>Đánh giá của bạn:</label>
    <div style="font-size: 24px;">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <button type="button" class="rating-star-btn" data-point="<?= $i ?>" data-isbn="<?= $isbn ?>" style="background:none;border:none;cursor:pointer;outline:none;">
                <span style="color:<?= ($userRating && $i <= $userRating['Point']) ? '#ffc107' : '#ccc' ?>;">★</span>
            </button>
        <?php endfor; ?>
        <?php if ($userRating): ?>
            <span style="margin-left:8px;color:green;">(Bạn đã đánh giá <?= $userRating['Point'] ?> sao)</span>
        <?php endif; ?>
    </div>
</div>
<hr>
<div>
    <h5>Danh sách đánh giá:</h5>
    <?php
    $sql = "SELECT r.Point, u.Fullname, u.Username, r.UpdatedAt FROM Rating r JOIN Users u ON r.Username = u.Username WHERE r.ISBN = '$isbn' ORDER BY r.UpdatedAt DESC";
    $ratings = Database::GetData($sql);
    if ($ratings):
        foreach ($ratings as $r):
    ?>
        <div style="margin-bottom: 8px; border-bottom: 1px solid #eee; padding-bottom: 4px;">
            <b><?= $r['Fullname'] ? htmlspecialchars($r['Fullname']) : htmlspecialchars($r['Username']) ?></b>
            <span style="color:#ffc107;">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span><?= $i <= $r['Point'] ? '★' : '☆' ?></span>
                <?php endfor; ?>
            </span>
            <span style="color:#888; font-size:12px;">(<?= date('d/m/Y H:i', strtotime($r['UpdatedAt'])) ?>)</span>
        </div>
    <?php endforeach; else: ?>
        <div>Chưa có đánh giá nào.</div>
    <?php endif; ?>
</div>
<?php
$html = ob_get_clean();
echo json_encode(['success' => true, 'html' => $html]); 
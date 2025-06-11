<?php
// Prevent any output before JSON response
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 0); // Turn off error display
ini_set('log_errors', 1); // Enable error logging
ini_set('error_log', 'php_errors.log'); // Set error log file

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set headers
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Include database configuration
require_once 'config/database.php';

// Constants
define('MIN_RATING', 1);
define('MAX_RATING', 5);
define('MAX_COMMENT_LENGTH', 1000);
define('ROOT_URL', '/Rebook'); // Add ROOT_URL constant

function sendJsonResponse($success, $message, $html = null) {
    // Clear any previous output
    ob_clean();
    
    $response = [
        'success' => $success,
        'message' => $message,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    if ($html !== null) {
        $response['html'] = $html;
    }
    echo json_encode($response);
    exit;
}

try {
    // Log request data for debugging
    error_log("Request Method: " . $_SERVER['REQUEST_METHOD']);
    error_log("POST Data: " . print_r($_POST, true));
    error_log("GET Data: " . print_r($_GET, true));
    error_log("Session Data: " . print_r($_SESSION, true));

    // Validate session
    if (!isset($_SESSION['Username'])) {
        error_log("Session validation failed: Username not set");
        sendJsonResponse(false, 'Bạn cần đăng nhập để đánh giá!');
    }

    // Validate request method
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    if (!in_array($requestMethod, ['POST', 'GET'])) {
        error_log("Invalid request method: " . $requestMethod);
        sendJsonResponse(false, 'Invalid request method');
    }

    $requestData = $requestMethod === 'POST' ? $_POST : $_GET;

    // Input validation
    if (!isset($requestData['isbn']) || !isset($requestData['point'])) {
        error_log("Missing required fields. Request data: " . print_r($requestData, true));
        sendJsonResponse(false, 'Missing required fields');
    }

    $isbn = trim($requestData['isbn']);
    $point = filter_var($requestData['point'], FILTER_VALIDATE_INT);
    $comment = isset($requestData['comment']) ? trim($requestData['comment']) : '';
    $username = $_SESSION['Username'];

    error_log("Processing rating - ISBN: $isbn, Point: $point, Username: $username");

    // Validate ISBN format (13 digits)
    if (!preg_match('/^\d{13}$/', $isbn)) {
        error_log("Invalid ISBN format: $isbn");
        sendJsonResponse(false, 'Invalid ISBN format');
    }

    // Validate rating point
    if ($point === false || $point < MIN_RATING || $point > MAX_RATING) {
        error_log("Invalid rating point: $point");
        sendJsonResponse(false, 'Invalid rating point. Must be between ' . MIN_RATING . ' and ' . MAX_RATING);
    }

    // Validate comment length
    if (strlen($comment) > MAX_COMMENT_LENGTH) {
        error_log("Comment too long: " . strlen($comment) . " characters");
        sendJsonResponse(false, 'Comment is too long. Maximum length is ' . MAX_COMMENT_LENGTH . ' characters');
    }

    // Escape values for SQL
    $isbn = addslashes($isbn);
    $username = addslashes($username);
    $comment = addslashes($comment);
    
    // Check if book exists
    $checkBookSql = "SELECT ISBN FROM books WHERE ISBN = '$isbn'";
    error_log("Checking book existence with SQL: $checkBookSql");
    $bookExists = Database::GetData($checkBookSql, ['row' => 0]);
    if (!$bookExists) {
        error_log("Book not found: $isbn");
        sendJsonResponse(false, 'Book not found');
    }
    
    // Check if user has already rated this book
    $sql = "SELECT * FROM rating WHERE ISBN = '$isbn' AND Username = '$username'";
    error_log("Checking existing rating with SQL: $sql");
    $existingRating = Database::GetData($sql, ['row' => 0]);

    try {
        if ($existingRating) {
            // Update existing rating
            $sql = "UPDATE rating SET Point = $point, Comment = '$comment', UpdatedAt = CURRENT_TIMESTAMP(3) WHERE ISBN = '$isbn' AND Username = '$username'";
        } else {
            // Insert new rating
            $sql = "INSERT INTO rating (ISBN, Username, Point, Comment) VALUES ('$isbn', '$username', $point, '$comment')";
        }

        error_log("Executing SQL: $sql");
        if (!Database::NonQuery($sql)) {
            error_log("Failed to save rating");
            throw new Exception("Failed to save rating");
        }

        // Get updated rating data
        $sql = "SELECT AVG(Point) as avg_point, COUNT(*) as total FROM rating WHERE ISBN = '$isbn'";
        error_log("Getting rating stats with SQL: $sql");
        $ratingStats = Database::GetData($sql, ['row' => 0]);
        $avgPoint = $ratingStats && $ratingStats['avg_point'] ? round($ratingStats['avg_point'], 1) : 0;
        $totalRating = $ratingStats ? $ratingStats['total'] : 0;

        // Get user's rating
        $sql = "SELECT * FROM rating WHERE ISBN = '$isbn' AND Username = '$username'";
        error_log("Getting user rating with SQL: $sql");
        $userRating = Database::GetData($sql, ['row' => 0]);

        // Get all ratings with pagination
        $page = isset($requestData['page']) ? max(1, intval($requestData['page'])) : 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $sql = "SELECT r.Point, r.Comment, u.Fullname, u.Username, u.Avatar, r.UpdatedAt 
                FROM rating r 
                JOIN users u ON r.Username = u.Username 
                WHERE r.ISBN = '$isbn' 
                ORDER BY r.UpdatedAt DESC
                LIMIT $perPage OFFSET $offset";
        error_log("Getting paginated ratings with SQL: $sql");
        $ratings = Database::GetData($sql);

        // Get total pages
        $sql = "SELECT COUNT(*) as total FROM rating WHERE ISBN = '$isbn'";
        error_log("Getting total ratings count with SQL: $sql");
        $totalRatings = Database::GetData($sql, ['row' => 0])['total'];
        $totalPages = ceil($totalRatings / $perPage);

        // Build HTML response
        ob_start();
        ?>
        <div class="rating-summary-box">
            <div class="avg-point"><?= htmlspecialchars($avgPoint) ?></div>
            <div class="star-list">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span style="color:<?= $i <= round($avgPoint) ? '#ffc107' : '#ccc' ?>">★</span>
                <?php endfor; ?>
            </div>
            <div class="total-rating">(<?= htmlspecialchars($totalRating) ?> đánh giá)</div>
        </div>

        <div class="your-rating-box">
            <label>Đánh giá của bạn:</label>
            <div class="your-rating-stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <button type="button" class="rating-star-btn" data-point="<?= $i ?>" data-isbn="<?= htmlspecialchars($isbn) ?>" style="background:none;border:none;cursor:pointer;outline:none;">
                        <span style="color:<?= ($userRating && $i <= $userRating['Point']) ? '#ffc107' : '#ccc' ?>;">★</span>
                    </button>
                <?php endfor; ?>
                <?php if ($userRating): ?>
                    <span style="margin-left:8px;color:green;">(Bạn đã đánh giá <?= htmlspecialchars($userRating['Point']) ?> sao)</span>
                <?php endif; ?>
            </div>
            <div style="margin-top: 8px;">
                <textarea id="rating-comment" placeholder="Nhập đánh giá của bạn về sản phẩm này..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-height: 80px;"><?= $userRating ? htmlspecialchars($userRating['Comment']) : '' ?></textarea>
                <button type="button" id="submit-rating" class="btn btn-primary" style="margin-top: 8px;">Gửi đánh giá</button>
            </div>
        </div>

        <div class="review-list">
            <h5 style="margin-bottom:8px;">Danh sách đánh giá:</h5>
            <?php if ($ratings): ?>
                <?php foreach ($ratings as $r):
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
                <?php endforeach; ?>

                <?php if ($totalPages > 1): ?>
                    <div class="pagination" style="margin-top: 20px; text-align: center;">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <button type="button" class="btn btn-sm <?= $i === $page ? 'btn-primary' : 'btn-outline-primary' ?>" 
                                    onclick="loadRatings(<?= $i ?>)"><?= $i ?></button>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div style="color:#888;">Chưa có đánh giá nào.</div>
            <?php endif; ?>
        </div>
        <?php
        $html = ob_get_clean();
        
        error_log("Rating submitted successfully");
        sendJsonResponse(true, 'Rating submitted successfully', $html);
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        sendJsonResponse(false, 'Error submitting rating: ' . $e->getMessage());
    }
} catch (Exception $e) {
    error_log("General error: " . $e->getMessage());
    sendJsonResponse(false, 'Error submitting rating: ' . $e->getMessage());
} 
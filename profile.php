<?php
// Start output buffering at the very beginning
ob_start();

include 'config/config.php';
include 'config/Database.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['Username'])) {
    $_SESSION['message'] = 'Vui lòng đăng nhập để xem thông tin cá nhân!';
    header('Location: ' . ROOT_URL . '/sign.php?form=signup');
    exit;
}

// Initialize variables
$fullname = '';
$phone = '';
$email = '';
$message = '';

// Check if this is an AJAX request
$is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// Handle AJAX requests
if ($is_ajax && isset($_POST['update_avatar'])) {
    // Clear any previous output
    ob_clean();
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    // Debug information
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    try {
        if (!isset($_FILES['avatar'])) {
            throw new Exception('Không tìm thấy file upload!');
        }

        $file = $_FILES['avatar'];
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Lỗi upload file! Mã lỗi: ' . $file['error']);
        }

        $tmp_name = $file['tmp_name'];
        $name = $file['name'];
        $type = $file['type'];
        
        // Create upload directory if it doesn't exist
        $upload_dir = 'assets/img/avatar/';
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                throw new Exception('Không thể tạo thư mục upload!');
            }
        }
        
        // Generate unique filename
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $new_filename = uniqid('avatar_') . '.' . $extension;
        $upload_path = $upload_dir . $new_filename;
        
        // Try to move the file
        if (!move_uploaded_file($tmp_name, $upload_path)) {
            throw new Exception('Không thể di chuyển file! Lỗi: ' . error_get_last()['message']);
        }

        // Update database
        $db_path = '/assets/img/avatar/' . $new_filename;
        
        // Delete old avatar if exists
        if (!empty($user['Avatar']) && file_exists(ltrim($user['Avatar'], '/'))) {
            unlink(ltrim($user['Avatar'], '/'));
        }
        
        $sql = "UPDATE Users SET Avatar = '$db_path' WHERE Username = '" . addslashes($_SESSION['Username']) . "'";
        
        if (!Database::NonQuery($sql)) {
            // Delete uploaded file if database update fails
            unlink($upload_path);
            throw new Exception('Lỗi khi cập nhật database!');
        }

        $_SESSION['Avatar'] = $db_path;
        echo json_encode([
            'success' => true,
            'message' => '<p style="color: #48CFAD;">Cập nhật ảnh đại diện thành công!</p>',
            'avatar_path' => $db_path
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => '<p style="color: red;">' . $e->getMessage() . '</p>'
        ]);
    }
    exit;
}

// Handle regular form submissions
if (isset($_POST['update_info'])) {
    $fullname = isset($_POST['fullname']) ? addslashes($_POST['fullname']) : '';
    $phone = isset($_POST['phone']) ? addslashes($_POST['phone']) : '';
    $email = isset($_POST['email']) ? addslashes($_POST['email']) : '';
    
    $sql = "UPDATE Users SET Fullname = '$fullname', Phone = '$phone', Email = '$email' WHERE Username = '" . addslashes($_SESSION['Username']) . "'";
    if (Database::NonQuery($sql)) {
        $message = '<p style="color: #48CFAD;">Cập nhật thông tin cá nhân thành công!</p>';
    } else {
        $message = '<p style="color: red;">Cập nhật thông tin thất bại!</p>';
    }
}

// Fetch user data
$sql = "SELECT * FROM Users, Account_Types WHERE Users.AccountTypeID = Account_Types.AccountTypeID AND Username = '" . addslashes($_SESSION['Username']) . "'";
$user = Database::GetData($sql, ['row' => 0]);

// Output HTML only for non-AJAX requests
if (!$is_ajax) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="icon" href="<?= htmlspecialchars(ROOT_URL) ?>/assets/img/favicon.png" />
    <link rel="stylesheet" href="<?= htmlspecialchars(ROOT_URL) ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= htmlspecialchars(ROOT_URL) ?>/assets/css/profile.css">
    <style>
        .avatar-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 10px auto;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #48CFAD;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .avatar-container:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(72, 207, 173, 0.5);
        }
        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .avatar-input {
            display: none;
        }
        .avatar-upload-text {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .avatar-container:hover .avatar-upload-text {
            opacity: 1;
        }
    </style>
</head>
<body class="profile__bg d-flex-center">
    <div class="profile__form">
        <div class="profile__form--header">
            <h3>Thông tin cá nhân</h3>
        </div>
        <form class="profile__form--body" method="POST" enctype="multipart/form-data">
            <div class="profile__group profile__avatar">
                <b>Ảnh đại diện: </b>
                <div class="avatar-container">
                    <img src="<?= htmlspecialchars($user['Avatar'] ? ROOT_URL . $user['Avatar'] : ROOT_URL . '/assets/img/user.png') ?>" alt="Avatar" class="avatar-img" id="avatar-preview">
                    <input type="file" name="avatar" id="avatar-input" accept="image/*" style="display: none;">
                    <div class="avatar-upload-text">Click để thay đổi ảnh</div>
                </div>
                <button type="button" id="updateAvatarBtn" class="btn" style="margin-top: 10px;">Cập nhật ảnh</button>
            </div>
            <div class="profile__group">
                <b>Tên đăng nhập: </b>
                <input type="text" name="username" value="<?= htmlspecialchars($user['Username']) ?>" disabled>
            </div>
            <div class="profile__group">
                <b>Họ tên: </b>
                <input type="text" name="fullname" value="<?= htmlspecialchars($user['Fullname']) ?>">
            </div>
            <div class="profile__group">
                <b>Số điện thoại: </b>
                <input type="text" name="phone" value="<?= htmlspecialchars($user['Phone']) ?>">
            </div>
            <div class="profile__group">
                <b>Email: </b>
                <input type="email" name="email" value="<?= htmlspecialchars($user['Email']) ?>">
            </div>
            <div class="profile__group">
                <span><b>Ngày tạo:</b> <?= date_format(new DateTime($user['CreatedAt']), 'd-m-Y') ?></span>
            </div>
            <div class="profile__group">
                <span><b>Loại tài khoản:</b> <?= htmlspecialchars($user['AccountTypeName']) ?></span>
            </div>
            <div class="profile__group">
                <button type="submit" name="update_info" class="btn">Cập nhật thông tin</button>
                <a class="btn" href="<?= htmlspecialchars(ROOT_URL) ?>/change-password.php">Đổi mật khẩu</a>
                <a class="btn" href="<?= htmlspecialchars(ROOT_URL) ?>">Trang chủ</a>
            </div>
        </form>
        <?php if (isset($message)) { ?>
            <div class="profile__form--footer"><?= $message ?></div>
        <?php } ?>
    </div>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const avatarContainer = document.querySelector('.avatar-container');
    const avatarInput = document.getElementById('avatar-input');
    const avatarPreview = document.getElementById('avatar-preview');
    const updateAvatarBtn = document.getElementById('updateAvatarBtn');

    avatarContainer.addEventListener('click', function() {
        avatarInput.click();
    });

    avatarInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                avatarPreview.src = e.target.result;
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });

    updateAvatarBtn.addEventListener('click', function() {
        if (!avatarInput.files || !avatarInput.files[0]) {
            alert('Vui lòng chọn ảnh trước khi cập nhật!');
            return;
        }

        const formData = new FormData();
        formData.append('avatar', avatarInput.files[0]);
        formData.append('update_avatar', '1');

        // Show loading state
        updateAvatarBtn.disabled = true;
        updateAvatarBtn.textContent = 'Đang cập nhật...';

        fetch(window.location.href, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Show message
            const messageContainer = document.querySelector('.profile__form--footer') || document.createElement('div');
            messageContainer.className = 'profile__form--footer';
            messageContainer.innerHTML = data.message;
            
            if (!document.querySelector('.profile__form--footer')) {
                document.querySelector('.profile__form').appendChild(messageContainer);
            }

            // Update avatar if successful
            if (data.success && data.avatar_path) {
                avatarPreview.src = '<?= ROOT_URL ?>' + data.avatar_path;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi cập nhật ảnh!');
        })
        .finally(() => {
            // Reset button state
            updateAvatarBtn.disabled = false;
            updateAvatarBtn.textContent = 'Cập nhật ảnh';
        });
    });
});
</script>
</html>
<?php
}
?>
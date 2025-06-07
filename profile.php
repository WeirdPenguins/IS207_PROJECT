<?php include 'config/config.php'?>
<?php include 'config/Database.php'?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<link href="<?=ROOT_URL . '/assets/css/profile.css'?>" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="icon" href="<?=ROOT_URL?>/assets/img/favicon.png" />
    <link rel="stylesheet" href="<?=ROOT_URL . '/assets/css/style.css'?>">
</head>

<?php
    if (isset($_POST['submit'])) {
        $username = (isset($_POST['username'])) ? $_POST['username'] : '';
        $fullname = (isset($_POST['fullname'])) ? $_POST['fullname'] : '';
        $phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';

        $sql = "UPDATE Users SET Fullname = '$fullname', Phone = '$phone', Email = '$email' WHERE Username = '" . $_SESSION['Username'] . "'";
        if (Database::NonQuery($sql)) {
            $message = '<p style="color: #48CFAD;">Cập nhật thông tin cá nhân thành công</p>';
            header('Location: logout.php');
        }
    }

    $sql = "SELECT * FROM Users, Account_Types WHERE Users.AccountTypeID = Account_Types.AccountTypeID AND Username = '" . $_SESSION['Username'] . "'";
    $user = Database::GetData($sql, ['row' => 0]);

?>

<body class="profile__bg d-flex-center">
    <div class="profile__form">
        <div class="profile__form--header">
            <h3>Thông tin cá nhân</h3>
        </div>
        <form class="profile__form--body" method="POST">
            <div class="profile__group">
                <b>Tên đăng nhập: </b>
                <input type="text" name="username" value="<?=$user['Username']?>" disabled>
            </div>
            <div class="profile__group">
                <b>Họ tên: </b>
                <input type="text" name="fullname" value="<?=$user['Fullname']?>">
            </div>
            <div class="profile__group">
                <b>Số điện thoại: </b>
                <input type="text" name="phone" value="<?=$user['Phone']?>">
            </div>
            <div class="profile__group">
                <b>Email: </b>
                <input type="email" name="email" value="<?=$user['Email']?>">
            </div>
            <div class="profile__group">
                <span><b>Ngày tạo:</b> <?=date_format(new DateTime($user['CreatedAt']), 'd-m-Y')?></span>
            </div>
            <div class="profile__group">
                <span><b>Loại tài khoản:</b> <?=$user['AccountTypeName']?></span>
            </div>
            <div class="profile__group">
                <input class="btn" name="submit" type="submit" value="Cập nhật">
                <a class="btn" href="<?=ROOT_URL . '/change-password.php'?>">Đổi mật khẩu</a>
                <a class="btn" href="<?=ROOT_URL . '/'?>">Trang chủ</a>
            </div>
        </form>
        <?php
            if (isset($message)) {
                echo '<div class="profile__form--footer">' . $message . '</div>';
            }
        ?>
    </div>
</body>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const fullname = document.querySelector('input[name="fullname"]').value.trim();
    const phone = document.querySelector('input[name="phone"]').value.trim();
    const email = document.querySelector('input[name="email"]').value.trim();
    let errors = [];

    if (fullname.length < 3) {
        errors.push("Họ tên phải có ít nhất 3 ký tự.");
    }

    if (!/^(0[3|5|7|8|9])+([0-9]{8})$/.test(phone)) {
        errors.push("Số điện thoại không hợp lệ.");
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errors.push("Email không hợp lệ.");
    }

    if (errors.length > 0) {
        e.preventDefault();
        alert(errors.join('\n'));
    }
});
</script>


</html>
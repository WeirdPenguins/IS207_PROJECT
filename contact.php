<?php include 'header.php'; ?>
<link href="<?=ROOT_URL . '/assets/css/contact.css'?>" rel="stylesheet">

<div class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-card">
                    <h3>Liên Hệ Với Chúng Tôi</h3>
                    <hr>
                    <p><strong>Hiệu sách REBOOK</strong></p>
                    <ul>
                        <li><strong>UIT (03870027JQK)</strong></li>
                    </ul>
                    <p><strong>Hotline và Zalo:</strong> 03870027JQK<br>
                    <strong>Email:</strong> Rebook@gmail.com</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.484646860093!2d106.7694543153347!3d10.85063706077347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175271d1b1b1b1b%3A0x1b1b1b1b1b1b1b1b!2zVElU!5e0!3m2!1svi!2s!4v1680000000000!5m2!1svi!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <h3>Gửi Lời Nhắn Cho Chúng Tôi</h3>
                    <hr>
                    <p>Để lại lời nhắn và chúng tôi sẽ phản hồi nhanh nhất có thể.</p>
                    <?php if (isset($_SESSION['contact_success'])) { ?>
                        <div class="alert alert-success">
                            <?=$_SESSION['contact_success']?>
                            <?php unset($_SESSION['contact_success']); ?>
                        </div>
                    <?php } elseif (isset($_SESSION['contact_error'])) { ?>
                        <div class="alert alert-danger">
                            <?=$_SESSION['contact_error']?>
                            <?php unset($_SESSION['contact_error']); ?>
                        </div>
                    <?php } ?>
                    <form method="post" action="<?=ROOT_URL . '/send-contact.php'?>">
                        <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Điện thoại</label>
                            <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="message">Nội dung</label>
                            <textarea class="form-control" name="message" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
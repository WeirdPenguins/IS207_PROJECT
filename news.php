<?php include 'header.php'; ?>

<style>
.news-circle-img {
    width: 220px;
    height: 220px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.news-section {
    background: #f7f6f2;
    padding: 40px 0 0 0;
    min-height: 100vh;
}
.news-title {
    font-weight: 700;
    font-size: 1.5rem;
    margin-bottom: 10px;
}
.news-desc {
    color: #444;
    font-size: 1rem;
    margin-bottom: 0;
}
.news-block {
    display: flex;
    align-items: center;
    margin-bottom: 40px;
}
.news-block .news-content {
    margin-left: 30px;
}
@media (max-width: 767px) {
    .news-block {
        flex-direction: column;
        align-items: flex-start;
    }
    .news-block .news-content {
        margin-left: 0;
        margin-top: 20px;
    }
}
</style>

<div class="news-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent px-0">
                <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tin về sách</li>
            </ol>
        </nav>
        <div class="news-block">
            <img src="assets/img/news1.jpg" class="news-circle-img" alt="Triết học phương Đông">
            <div class="news-content">
                <div class="news-title">Tiệm bán sách cũ triết học giá rẻ ở Hồ Chí Minh, Bình Dương</div>
                <p class="news-desc">Sách cũ triết học không chỉ là những trang giấy ngả màu thời gian, mà còn là kho tàng tri thức sâu sắc...</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="d-flex align-items-center">
                    <img src="assets/img/news2.jpg" class="news-circle-img" style="width:120px;height:120px;" alt="Ngoại văn">
                    <div class="news-content">
                        <div class="news-title" style="font-size:1.1rem;">Mua bán sách cũ ngoại văn HCM và Bình Dương uy tín</div>
                        <p class="news-desc">Bạn đang có những cuốn sách cũ ngoại văn và muốn tìm kiếm một mái nhà mới? Dịch vụ thanh lý, thu mua...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="d-flex align-items-center">
                    <img src="assets/img/news3.jpg" class="news-circle-img" style="width:120px;height:120px;" alt="Kỹ năng">
                    <div class="news-content">
                        <div class="news-title" style="font-size:1.1rem;">Tiệm bán sách cũ kỹ năng gần đây không thể bỏ qua</div>
                        <p class="news-desc">Sách cũ kỹ năng không chỉ là những cuốn sách, mà còn là người bạn đồng hành đáng tin cậy trên con đường...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="d-flex align-items-center">
                    <img src="assets/img/news4.jpg" class="news-circle-img" style="width:120px;height:120px;" alt="Thiếu nhi">
                    <div class="news-content">
                        <div class="news-title" style="font-size:1.1rem;">Địa chỉ thu mua sách cũ thiếu nhi uy tín ở HCM và Bình Dương</div>
                        <p class="news-desc">Nơi thu mua sách thiếu nhi cũ với giá tốt, hỗ trợ tận nơi và thanh toán nhanh chóng...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="d-flex align-items-center">
                    <img src="assets/img/news5.jpg" class="news-circle-img" style="width:120px;height:120px;" alt="Kinh Dịch">
                    <div class="news-content">
                        <div class="news-title" style="font-size:1.1rem;">Sưu tầm sách cũ Kinh Dịch: Hành trình tìm về nguồn cội</div>
                        <p class="news-desc">Khám phá những cuốn sách Kinh Dịch cũ quý hiếm, lưu giữ giá trị văn hóa truyền thống...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?> 
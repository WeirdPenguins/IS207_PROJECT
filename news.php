<?php include 'header.php'; ?>

<style>
.news-section {
    background: #f7f6f2;
    padding: 60px 0;
    min-height: 100vh;
}
.news-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    padding: 20px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
}
.news-circle-img {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: 25px;
    border: 2px solid #eee;
}
.news-content {
    flex: 1;
}
.news-title {
    font-weight: 700;
    font-size: 1.6rem;
    color: #2c3e50;
    margin-bottom: 10px;
    transition: color 0.3s ease;
}
.news-title:hover {
    color: #e74c3c;
}
.news-desc {
    color: #555;
    font-size: 1rem;
    line-height: 1.7;
    margin-bottom: 15px;
}
.read-more-btn {
    display: inline-block;
    padding: 8px 20px;
    background: #e74c3c;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 500;
    transition: background 0.3s ease;
}
.read-more-btn:hover {
    background: #c0392b;
    color: #fff;
}
.breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 30px;
}
.breadcrumb-item a {
    color: #e74c3c;
    text-decoration: none;
}
.breadcrumb-item a:hover {
    text-decoration: underline;
}
.breadcrumb-item.active {
    color: #2c3e50;
}
@media (max-width: 767px) {
    .news-card {
        flex-direction: column;
        align-items: flex-start;
    }
    .news-circle-img {
        width: 150px;
        height: 150px;
        margin-right: 0;
        margin-bottom: 20px;
    }
    .news-title {
        font-size: 1.4rem;
    }
    .news-desc {
        font-size: 0.95rem;
    }
}
</style>

<div class="news-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tin về sách</li>
            </ol>
        </nav>
        <div class="news-card">
            <img src="assets/img/news/news1.jpg" class="news-circle-img" alt="Triết học phương Đông">
            <div class="news-content">
                <div class="news-title">Tiệm bán sách cũ triết học giá rẻ ở Hồ Chí Minh, Bình Dương</div>
                <p class="news-desc">Sách cũ triết học không chỉ là những trang giấy ngả màu thời gian, mà còn là kho tàng tri thức sâu sắc về tư tưởng và văn hóa phương Đông. Tại các tiệm sách cũ ở Hồ Chí Minh và Bình Dương, bạn có thể tìm thấy những tác phẩm kinh điển từ Khổng Tử, Lão Tử đến các triết gia hiện đại với mức giá phải chăng. Những cuốn sách này không chỉ giúp bạn khám phá triết lý sống mà còn là nguồn cảm hứng bất tận cho tâm hồn.</p>
                <a href="#" class="read-more-btn">Đọc thêm</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="news-card">
                    <img src="assets/img/news/news2.jpg" class="news-circle-img" alt="Ngoại văn">
                    <div class="news-content">
                        <div class="news-title">Mua bán sách cũ ngoại văn uy tín tại HCM và Bình Dương</div>
                        <p class="news-desc">Bạn đang sở hữu những cuốn sách ngoại văn quý giá và muốn tìm nơi trao đổi đáng tin cậy? Dịch vụ mua bán sách cũ ngoại văn tại Hồ Chí Minh và Bình Dương của chúng tôi đảm bảo uy tín, giá tốt và hỗ trợ tận nơi. Từ tiểu thuyết kinh điển của Shakespeare đến sách khoa học hiện đại, bạn có thể tìm thấy những cuốn sách chất lượng để làm mới bộ sưu tập của mình.</p>
                        <a href="#" class="read-more-btn">Đọc thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="news-card">
                    <img src="assets/img/news/news3.jpg" class="news-circle-img" alt="Kỹ năng">
                    <div class="news-content">
                        <div class="news-title">Tiệm bán sách cũ kỹ năng không thể bỏ qua</div>
                        <p class="news-desc">Sách kỹ năng cũ là người bạn đồng hành tuyệt vời giúp bạn phát triển bản thân. Tại các cửa hàng sách cũ gần đây ở Hồ Chí Minh và Bình Dương, bạn sẽ tìm thấy những cuốn sách về kỹ năng giao tiếp, quản lý thời gian, và tư duy sáng tạo với giá cả hợp lý. Những cuốn sách này không chỉ truyền cảm hứng mà còn cung cấp công cụ thực tiễn để thành công trong cuộc sống.</p>
                        <a href="#" class="read-more-btn">Đọc thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="news-card">
                    <img src="assets/img/news/news4.jpg" class="news-circle-img" alt="Thiếu nhi">
                    <div class="news-content">
                        <div class="news-title">Địa chỉ thu mua sách cũ thiếu nhi uy tín ở HCM và Bình Dương</div>
                        <p class="news-desc">Sách thiếu nhi cũ mang đến những câu chuyện đầy màu sắc và bài học ý nghĩa cho trẻ em. Dịch vụ thu mua sách cũ thiếu nhi tại Hồ Chí Minh và Bình Dương cung cấp giải pháp tiện lợi để tái chế những cuốn sách không còn sử dụng, với mức giá hấp dẫn và dịch vụ tận tâm, đảm bảo mang lại giá trị mới cho những cuốn sách yêu thích của bạn.</p>
                        <a href="#" class="read-more-btn">Đọc thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="news-card">
                    <img src="assets/img/news/news5.jpg" class="news-circle-img" alt="Kinh Dịch">
                    <div class="news-content">
                        <div class="news-title">Sưu tầm sách cũ Kinh Dịch: Hành trình tìm về nguồn cội</div>
                        <p class="news-desc">Sách Kinh Dịch cũ là kho báu văn hóa, lưu giữ những tri thức cổ xưa về vũ trụ và con người. Việc sưu tầm những cuốn sách này tại các tiệm sách cũ ở Hồ Chí Minh và Bình Dương không chỉ là hành trình khám phá triết học mà còn là cách để kết nối với cội nguồn văn hóa phương Đông, mang lại giá trị tinh thần sâu sắc.</p>
                        <a href="#" class="read-more-btn">Đọc thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
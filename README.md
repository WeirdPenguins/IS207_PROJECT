# Rebook - Nền tảng thương mại điện tử bán sách

## 1. Giới thiệu

Rebook là một website thương mại điện tử chuyên cung cấp sách, cho phép người dùng tìm kiếm, mua sách và thanh toán trực tuyến. Hệ thống cung cấp giao diện thân thiện cho người dùng và bảng quản trị mạnh mẽ cho quản trị viên để quản lý sách, đơn hàng, và nhiều tính năng khác.

---

## 2. Hướng dẫn sử dụng

### 2.1 Giao diện người dùng

**Chức năng chính:**
- **Đăng ký/Đăng nhập:** Tạo tài khoản hoặc đăng nhập để sử dụng.
- **Tìm kiếm sách:** Tìm theo từ khóa hoặc thể loại.
- **Xem chi tiết sách:** Xem thông tin chi tiết như giá, tác giả, mô tả.
- **Giỏ hàng:** Thêm/xóa sách, cập nhật số lượng.
- **Tạo đơn hàng:** Tạo và theo dõi đơn hàng.
- **Thanh toán:** Hỗ trợ thanh toán qua QR code.

### 2.2 Giao diện quản trị viên

**Chức năng chính:**
- Xem thống kê doanh thu qua biểu đồ.
- Quản lý **Thể loại** (Thêm, sửa, xóa, tìm kiếm).
- Quản lý **Tác giả** (Thêm, sửa, xóa, tìm kiếm).
- Quản lý **Nhà xuất bản** (Thêm, sửa, xóa, tìm kiếm).
- Quản lý **Sách** (Thêm, sửa, xóa, tìm kiếm).
- Quản lý **Nhà cung cấp** (Thêm, sửa, xóa, tìm kiếm).
- Quản lý **Slider** (Thêm, sửa, xóa, tìm kiếm).
- Quản lý **Đơn hàng** (In hóa đơn, xác nhận thanh toán).
- Quản lý **Tài khoản** (Khóa tài khoản, đổi mật khẩu, phân quyền).
- Quản lý **Vouchers** (Thêm, sửa, xóa).

---

## 3. Hướng dẫn cài đặt

### 3.1 Yêu cầu hệ thống

- **XAMPP:** Phiên bản mới nhất (PHP ≥ 8.2).
- **MySQL/MariaDB:** MySQL 5.7 hoặc MariaDB 10.3 trở lên.
- **Trình duyệt:** Chrome, Edge, hoặc Firefox.
- **Công cụ:** Git, Composer.
- **Thư viện:** PHPMailer ([https://github.com/PHPMailer/PHPMailer](https://github.com/PHPMailer/PHPMailer)).

### 3.2 Các bước cài đặt

1. **Cài đặt XAMPP**
   - Tải và cài đặt từ [https://www.apachefriends.org](https://www.apachefriends.org).
   - Khởi động Apache và MySQL trong XAMPP Control Panel.

2. **Clone mã nguồn**
   ```bash
   cd /path/to/xampp/htdocs
   git clone https://github.com/WeirdPenguins/IS207_PROJECT.git Rebook
   cd Rebook
   ```

3. **Cài đặt PHPMailer**
   - Tải PHPMailer từ [https://github.com/PHPMailer/PHPMailer](https://github.com/PHPMailer/PHPMailer).
   - Giải nén và đặt vào thư mục `Rebook/vendor`.
   - Chạy lệnh để cài đặt các thư viện khác:
     ```bash
     composer install
     ```

4. **Cấu hình kết nối cơ sở dữ liệu và đường dẫn**
   - Truy cập [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
   - Tạo database mới (VD: `rebook_database`).
   - Import file `.sql` từ thư mục `mysql`.
   - Cấu hình kết nối cơ sở dữ liệu:
     - Mở file `config/database`.
     - Cập nhật thông tin `HOST`, `USERNAME`, `PASSWORD`, và `DBNAME`.
   - Cấu hình đường dẫn
     - Mở file `config/config`.
     - Đảm bảo `ROOT_URL = '/Rebook'`.

5. **Kiểm tra cài đặt**
   - Truy cập giao diện người dùng: [http://localhost/Rebook](http://localhost/Rebook).
   - Truy cập giao diện admin: [http://localhost/Rebook/admin](http://localhost/Rebook/admin).

---

## 4. Thông tin tài khoản mặc định

### 4.1 Tài khoản Admin
- **Tài khoản:** admin
- **Mật khẩu:** 123456

### 4.2 Tài khoản User
- **Tài khoản:** user1
- **Mật khẩu:** 123456

---

## 5. Thành viên nhóm

| STT | MSSV       | Họ và Tên          | Github                     | Email                     |
|-----|------------|--------------------|----------------------------|---------------------------|
| 1   | 23521788   | Dương Phát Vĩnh    | [https://github.com/WeirdPenguins](https://github.com/WeirdPenguins) | 23521788@gm.uit.edu.vn    |
| 2   | 23521705   | Trần Văn Tú        | [https://github.com/acommency](https://github.com/acommency)         | 23521705@gm.uit.edu.vn    |
| 3   | 23521804   | Đỗ Văn Vũ          | [https://github.com/DW1804](https://github.com/DW1804)               | 23521804@gm.uit.edu.vn    |
| 4   | 23521669   | Họ và Tên 4        | [https://github.com/thanhtruc011](https://github.com/thanhtruc011)   | 23521669@gm.uit.edu.vn    |
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 07, 2025 lúc 02:29 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `ID` int(11) NOT NULL,
  `IDKH` int(11) DEFAULT NULL,
  `IDSP` int(11) DEFAULT NULL,
  `binhLuan` text DEFAULT NULL,
  `ngayBL` text DEFAULT NULL,
  `star` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`ID`, `IDKH`, `IDSP`, `binhLuan`, `ngayBL`, `star`) VALUES
(283, 50, 62, 'ok', '2024-11-28 05:39:45', 5),
(284, 55, 80, 'ok', '2025-04-18 14:18:38', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `ID` int(11) NOT NULL,
  `tenBrand` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`ID`, `tenBrand`) VALUES
(1, 'Nhà Xuất Bản Lý Luận Chính Trị'),
(2, 'ThaiHaBook'),
(3, 'NXB Trẻ'),
(4, 'NXB Văn Học'),
(5, 'Fahasa'),
(11, 'Kim Đồng'),
(12, 'NXB Giáo Dục Việt Nam'),
(13, 'NXB Lao Động');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `ID` int(11) NOT NULL,
  `IDDH` int(11) DEFAULT NULL,
  `IDSP` int(11) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `Size` varchar(100) NOT NULL,
  `tongTien` float NOT NULL,
  `cachThanhToan` varchar(100) DEFAULT NULL,
  `ten` varchar(100) DEFAULT NULL,
  `diaChi` varchar(200) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ghiChu` text DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`ID`, `IDDH`, `IDSP`, `soLuong`, `Size`, `tongTien`, `cachThanhToan`, `ten`, `diaChi`, `sdt`, `email`, `ghiChu`, `status`) VALUES
(362, 209, 62, 1, '39', 2544400, 'Chuyển khoản ngân hàng', 'test', 'no', 'null', 'admin1@gmail.com', '', 0),
(363, 209, 65, 1, '39', 750000, 'Chuyển khoản ngân hàng', 'test', 'no', 'null', 'admin1@gmail.com', '', 0),
(364, 210, 67, 2, '39', 900000, 'Chuyển khoản ngân hàng', 'test', 'no', 'null', 'admin1@gmail.com', '', 0),
(365, 211, 62, 1, '42', 112500, 'Chuyển khoản ngân hàng', 'test', 'no', 'null', 'admin1@gmail.com', '', 0),
(366, 212, 63, 1, '43', 500000, 'Chuyển khoản ngân hàng', 'test', 'no', 'null', 'admin1@gmail.com', '', 0),
(367, 213, 63, 1, '43', 500000, 'Chuyển khoản ngân hàng', 'test', 'no', 'null', 'admin1@gmail.com', '', 0),
(368, 214, 62, 1, '42', 112500, 'Chuyển khoản ngân hàng', 'test', 'no', 'null', 'admin1@gmail.com', '', 0),
(369, 215, 63, 2, '13x19cm', 1000000, 'Chuyển khoản ngân hàng', 'dss', 'dsa', 'null', 'admin1111@gmail.com', '', 0),
(370, 215, 68, 1, '19x26cm', 525000, 'Chuyển khoản ngân hàng', 'dss', 'dsa', 'null', 'admin1111@gmail.com', '', 0),
(371, 215, 69, 2, '19x26cm', 500000, 'Chuyển khoản ngân hàng', 'dss', 'dsa', 'null', 'admin1111@gmail.com', '', 0),
(372, 215, 72, 2, '19x26cm', 500000, 'Chuyển khoản ngân hàng', 'dss', 'dsa', 'null', 'admin1111@gmail.com', '', 0),
(373, 216, 78, 1, '19x26cm', 5000000, 'Chuyển khoản ngân hàng', 'Dương Phát Vĩnh', 'TPHCM', 'null', 'vinhd220@gmail.com', '', 2),
(374, 217, 62, 1, '24x16cm', 112500, 'Chuyển khoản ngân hàng', 'Vinh Hoang', '123213123', 'null', 'canhcut115@gmail.com', '', 0),
(375, 217, 72, 1, '19x26cm', 250000, 'Chuyển khoản ngân hàng', 'Vinh Hoang', '123213123', 'null', 'canhcut115@gmail.com', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsachyeuthich`
--

CREATE TABLE `danhsachyeuthich` (
  `ID` int(11) NOT NULL,
  `IDKH` int(11) DEFAULT NULL,
  `IDSP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhsachyeuthich`
--

INSERT INTO `danhsachyeuthich` (`ID`, `IDKH`, `IDSP`) VALUES
(598, 53, 62),
(599, 53, 63);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `ID` int(11) NOT NULL,
  `IDKH` int(11) NOT NULL,
  `ngayDat` date DEFAULT NULL,
  `tinhTrang` varchar(100) DEFAULT NULL,
  `phiGD` float NOT NULL,
  `giamGia` double NOT NULL DEFAULT 0,
  `tongTien` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`ID`, `IDKH`, `ngayDat`, `tinhTrang`, `phiGD`, `giamGia`, `tongTien`) VALUES
(209, 50, '2024-11-24', 'Đã nhận hàng', 29000, 0, 0),
(210, 50, '2024-11-24', 'Đã nhận hàng', 29000, 0, 0),
(211, 50, '2024-11-24', 'Đã nhận hàng', 29000, 0, 0),
(212, 50, '2024-11-24', 'Đã nhận hàng', 29000, 0, 0),
(213, 50, '2024-11-24', 'Đã nhận hàng', 29000, 0, 0),
(214, 50, '2024-11-28', 'Đã nhận hàng', 29000, 10, 127350),
(215, 53, '2025-03-27', 'Đã nhận hàng', 29000, 0, 0),
(216, 55, '2025-04-18', 'Đã nhận hàng', 29000, 0, 0),
(217, 56, '2025-04-25', 'Đang xử lý', 29000, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giamgia`
--

CREATE TABLE `giamgia` (
  `ID` int(11) NOT NULL,
  `IDSK` int(11) DEFAULT NULL,
  `IDSP` int(11) DEFAULT NULL,
  `giaGiam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giamgia`
--

INSERT INTO `giamgia` (`ID`, `IDSK`, `IDSP`, `giaGiam`) VALUES
(85, NULL, 62, 10),
(86, NULL, 63, 0),
(91, NULL, 68, 30),
(92, NULL, 69, 0),
(95, NULL, 72, 0),
(102, NULL, 78, 0),
(103, NULL, 79, 0),
(104, NULL, 80, 0),
(105, NULL, 81, 0),
(106, NULL, 82, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `ID` int(11) NOT NULL,
  `IDKH` int(11) DEFAULT NULL,
  `IDSP` int(11) DEFAULT NULL,
  `soLuong` int(11) DEFAULT NULL,
  `size` text NOT NULL,
  `tongTien` float DEFAULT NULL,
  `thoiGian` date DEFAULT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`ID`, `IDKH`, `IDSP`, `soLuong`, `size`, `tongTien`, `thoiGian`, `status`) VALUES
(1980, 53, 68, 4, '19x26cm', 2100000, '2025-03-27', 1),
(1981, 53, 62, 1, '24x16cm', 112500, '2025-03-27', 1),
(1982, 53, 63, 1, '13x19cm', 500000, '2025-03-27', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `ID` int(11) NOT NULL,
  `IDTK` int(11) DEFAULT NULL,
  `hoTen` varchar(50) DEFAULT NULL,
  `ngaysinh` text DEFAULT NULL,
  `gioiTinh` varchar(50) NOT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `diachi` varchar(100) DEFAULT NULL,
  `ranks` int(30) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`ID`, `IDTK`, `hoTen`, `ngaysinh`, `gioiTinh`, `sdt`, `diachi`, `ranks`, `image`) VALUES
(50, 49, 'd', '2001-01-01', 'Nam', 'null', 'd', 0, 'Public/image/Avatar/noavatar.png'),
(51, 50, 'test', '2001-01-01', 'Nam', 'null', 'no', 0, 'Public/image/Avatar/noavatar.png'),
(52, 51, 'nn', '2020-02-02', 'Nam', 'null', 'd', 0, 'Public/image/Avatar/noavatar.png'),
(53, 52, 'hbs', '2001-01-01', 'Nam', 'null', 'ks', 0, 'Public/image/Avatar/noavatar.png'),
(54, 53, 'dss', '2001-01-01', 'Nam', 'null', 'dsa', 0, 'Public/image/Avatar/noavatar.png'),
(55, 54, 'admnett', '2001-01-01', 'Nam', 'null', 'viens', 0, 'Public/image/Avatar/noavatar.png'),
(56, 55, 'Dương Phát Vĩnh', '2005-04-30', 'Nam', 'null', 'TPHCM', 0, 'Public/image/Avatar/tải xuống2025_04_18_14_45_22.jpg'),
(57, 56, 'Vinh Hoang', '2003-04-30', 'Nam', 'null', '123213123', 0, 'Public/image/Avatar/noavatar.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kichthuoc`
--

CREATE TABLE `kichthuoc` (
  `ID` int(11) NOT NULL,
  `size` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `kichthuoc`
--

INSERT INTO `kichthuoc` (`ID`, `size`) VALUES
(1, '19x26cm'),
(2, '16x24cm'),
(4, '24x16cm'),
(5, '13x19cm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsubanhang`
--

CREATE TABLE `lichsubanhang` (
  `ID` int(11) NOT NULL,
  `IDKH` int(11) DEFAULT NULL,
  `IDSP` int(11) DEFAULT NULL,
  `soLuong` int(11) DEFAULT NULL,
  `ngayBan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lichsubanhang`
--

INSERT INTO `lichsubanhang` (`ID`, `IDKH`, `IDSP`, `soLuong`, `ngayBan`) VALUES
(97, 50, 62, 1, '2024-11-28'),
(98, 50, 63, 1, '2024-12-05'),
(99, 53, 63, 2, '2025-03-27'),
(100, 53, 68, 1, '2025-03-27'),
(101, 53, 69, 2, '2025-03-27'),
(102, 53, 72, 2, '2025-03-27'),
(103, 50, 63, 1, '2025-03-27'),
(104, 55, 78, 1, '2025-04-19'),
(105, 50, 62, 1, '2025-04-19'),
(106, 50, 62, 1, '2025-04-19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `magiam`
--

CREATE TABLE `magiam` (
  `ID` int(11) NOT NULL,
  `IDSK` int(11) DEFAULT NULL,
  `codes` varchar(100) DEFAULT NULL,
  `giagiam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `magiam`
--

INSERT INTO `magiam` (`ID`, `IDSK`, `codes`, `giagiam`) VALUES
(11, 76, '123', 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mausac`
--

CREATE TABLE `mausac` (
  `ID` int(11) NOT NULL,
  `tenMau` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mausac`
--

INSERT INTO `mausac` (`ID`, `tenMau`) VALUES
(1, 'Xanh Pasteur'),
(2, 'Nâu'),
(3, 'Trắng'),
(4, 'Đen'),
(5, 'Be'),
(6, 'Nâu Cafe'),
(8, 'Xám');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `ID` int(11) NOT NULL,
  `IDLoai` int(11) DEFAULT NULL,
  `IDBrand` int(11) DEFAULT NULL,
  `IDSize` int(11) DEFAULT NULL,
  `IDMau` int(11) DEFAULT NULL,
  `IDSX` int(11) DEFAULT NULL,
  `tenSP` varchar(200) DEFAULT NULL,
  `giaSP` float DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `image1` text NOT NULL,
  `image2` text NOT NULL,
  `moTa` text NOT NULL,
  `congDung` text NOT NULL,
  `suDung` text NOT NULL,
  `gioiThieuTH` text NOT NULL,
  `combo` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`ID`, `IDLoai`, `IDBrand`, `IDSize`, `IDMau`, `IDSX`, `tenSP`, `giaSP`, `image`, `image1`, `image2`, `moTa`, `congDung`, `suDung`, `gioiThieuTH`, `combo`, `status`) VALUES
(62, 67, 3, 4, 2, 19, 'Người Đàn Ông Mang Tên Ove', 125000, 'Public/image/asasa1.png', 'Public/image/asasa1.png', 'Public/image/asasa1.png', 'hể họ là bọn ăn trộm và ngón trỏ của ông là cây đèn pin của cảnh sát. Ove tin tất cả những người ở nơi ông sống đều kém cỏi, ngu dốt và không đáng làm hàng xóm của ông. Ove nguyên tắc, cứng nhắc, cấm cảu và cay nghiệt.', 'hể họ là bọn ăn trộm và ngón trỏ của ông là cây đèn pin của cảnh sát. Ove tin tất cả những người ở nơi ông sống đều kém cỏi, ngu dốt và không đáng làm hàng xóm của ông. Ove nguyên tắc, cứng nhắc, cấm cảu và cay nghiệt.', 'hể họ là bọn ăn trộm và ngón trỏ của ông là cây đèn pin của cảnh sát. Ove tin tất cả những người ở nơi ông sống đều kém cỏi, ngu dốt và không đáng làm hàng xóm của ông. Ove nguyên tắc, cứng nhắc, cấm cảu và cay nghiệt.', 'Nơi Khô Ráo, Thoáng Mát', 0, 1),
(63, 58, 2, 5, 1, 2, 'Những Xu Hướng Lớn Sẽ Định Hình Thế Giới Tương Lai', 500000, 'Public/image/ant.png', 'Public/image/ant.png', 'Public/image/ant.png', 'Cuốn sách là bản phân tích đột phá từ một trong những chuyên gia hàng đầu thế giới về các xu hướng toàn cầu, bao gồm cả cách Covid-19 đang đẩy nhanh tất cả những thay đổi lớn đang diễn ra cho thế giới của chúng ta.', 'Từng có lúc, thế giới phân biệt rõ rệt giữa giàu và nghèo. Dân số trẻ, tài chính đảm bảo, người lao động nhiều hơn người về hưu. Những công ty lớn không thấy nhu cầu bành trướng ra bên ngoài Mỹ và châu Âu. Một người bình thường trong xã hội phát triển chỉ cần siêng năng làm việc là sẽ có một tương lai ổn định.', 'Đến năm 2030, thế giới đó sẽ khác:  – Ông bà sẽ nhiều hơn cháu chắt  – Giới trung lưu châu Á và châu Phi Hạ Sahara sẽ có dân số đông hơn Mỹ và châu Âu cộng lại  – Lần đầu tiên trong lịch sử, kinh tế toàn cầu sẽ bị điều khiển bởi nhu cầu phi-phương Tây  – Nữ sẽ sở hữu tài sản nhiều hơn nam  – Sẽ có nhiều robot hơn người lao động', 'Nơi Khô Ráo, Thoáng Mát', 0, 1),
(68, 65, 1, 1, NULL, 2, 'Giáo trình Lí thuyết âm nhạc cơ bản', 750000, 'Public/image/assas.png', 'Public/image/assas.png', 'Public/image/assas.png', 'ách - Giáo trình Lí thuyết âm nhạc cơ bản giúp người học có cơ sở lí luận trong việc học tập, nghiên cứu, lí giải, giải thích các vấn đề chuyên môn và phục vụ công việc giảng dạy sau này; đồng thời giúp người học hiểu biết hơn về môn học, ngành học, có cái nhìn bao quát và xuyên suốt, biết mình cần những kiến thức gì, mức độ nào, áp dụng vào đâu,… trong công việc học tập, nghiên cứu khoa học, hoạt động nghề nghiệp và giảng dạy trong tương lai.', 'ách - Giáo trình Lí thuyết âm nhạc cơ bản giúp người học có cơ sở lí luận trong việc học tập, nghiên cứu, lí giải, giải thích các vấn đề chuyên môn và phục vụ công việc giảng dạy sau này; đồng thời giúp người học hiểu biết hơn về môn học, ngành học, có cái nhìn bao quát và xuyên suốt, biết mình cần những kiến thức gì, mức độ nào, áp dụng vào đâu,… trong công việc học tập, nghiên cứu khoa học, hoạt động nghề nghiệp và giảng dạy trong tương lai.', 'ách - Giáo trình Lí thuyết âm nhạc cơ bản giúp người học có cơ sở lí luận trong việc học tập, nghiên cứu, lí giải, giải thích các vấn đề chuyên môn và phục vụ công việc giảng dạy sau này; đồng thời giúp người học hiểu biết hơn về môn học, ngành học, có cái nhìn bao quát và xuyên suốt, biết mình cần những kiến thức gì, mức độ nào, áp dụng vào đâu,… trong công việc học tập, nghiên cứu khoa học, hoạt động nghề nghiệp và giảng dạy trong tương lai.', 'Nơi Khô Ráo, Thoáng Mát', 0, 1),
(69, 64, 2, 1, NULL, 19, 'Bách Khoa Tri Thức Khoa Học Tự Nhiên 8', 250000, 'Public/image/abktt.png', 'Public/image/abktt.png', 'Public/image/abktt.png', 'Bách Khoa Tri Thức Khoa Học Tự Nhiên 8 (Dùng Chung Cho Các Bộ SGK Hiện Hành) - Đây là một môn học giải quyết các vấn đề của khoa học tự nhiên, một lĩnh vực có nhiều quy luật, nguyên lí, chứa đựng lượng kiến thức \"khổng lồ\".', 'Bách Khoa Tri Thức Khoa Học Tự Nhiên 8 (Dùng Chung Cho Các Bộ SGK Hiện Hành) - Đây là một môn học giải quyết các vấn đề của khoa học tự nhiên, một lĩnh vực có nhiều quy luật, nguyên lí, chứa đựng lượng kiến thức \"khổng lồ\".', 'Bách Khoa Tri Thức Khoa Học Tự Nhiên 8 (Dùng Chung Cho Các Bộ SGK Hiện Hành) - Đây là một môn học giải quyết các vấn đề của khoa học tự nhiên, một lĩnh vực có nhiều quy luật, nguyên lí, chứa đựng lượng kiến thức \"khổng lồ\".', 'Nơi Khô Ráo, Thoáng Mát', 0, 1),
(72, 49, 4, 1, NULL, 19, 'Tục Ngữ Ca Dao Dân Ca Việt Nam', 250000, 'Public/image/atca.png', 'Public/image/atca.png', 'Public/image/atca.png', 'Để đến gần hơn với tục ngữ ca dao dân ca, Thư viện Trường Tiểu học Ái Mộ A xin giới thiệu tới các thầy cô giáo và các em học sinh cuốn sách “Tục ngữ, ca dao, dân ca Việt Nam” với hy vọng sẽ góp phần đắc lực vào công tác giảng dạy văn học, giáo dục đến các em tinh thần yêu quê hương nước, yêu làng xóm gốc đa, bến nước.', 'Để đến gần hơn với tục ngữ ca dao dân ca, Thư viện Trường Tiểu học Ái Mộ A xin giới thiệu tới các thầy cô giáo và các em học sinh cuốn sách “Tục ngữ, ca dao, dân ca Việt Nam” với hy vọng sẽ góp phần đắc lực vào công tác giảng dạy văn học, giáo dục đến các em tinh thần yêu quê hương nước, yêu làng xóm gốc đa, bến nước.', 'Để đến gần hơn với tục ngữ ca dao dân ca, Thư viện Trường Tiểu học Ái Mộ A xin giới thiệu tới các thầy cô giáo và các em học sinh cuốn sách “Tục ngữ, ca dao, dân ca Việt Nam” với hy vọng sẽ góp phần đắc lực vào công tác giảng dạy văn học, giáo dục đến các em tinh thần yêu quê hương nước, yêu làng xóm gốc đa, bến nước.', 'Nơi Khô Ráo, Thoáng Mát', 0, 1),
(78, 7, 11, 1, NULL, 2, 'BÁO THANH NGHỊ - VŨ ĐÌNH HOÈ (1942)', 5000000, 'Public/image/alod.png', 'Public/image/alod.png', 'Public/image/alod.png', 'Trong thế kỷ 20, năm 1945 là một cái mốc lớn chia lịch sử ra thành hai giai đoạn khác nhau rõ rệt về mọi mặt. Đất nước từ đó trải qua một cuộc xáo trộn tận gốc với cách mạng và chiến tranh. Về sau người ta có khuynh hướng chia mọi chuyện thành trước và sau cái mốc ấy, trước 1945 thường gọi là thời “tiền chiến”, như nhạc tiền chiến, văn thơ tiền chiến..., như thuộc về một thời đại khác hẳn thời 1945 trở về sau.', 'Trong thế kỷ 20, năm 1945 là một cái mốc lớn chia lịch sử ra thành hai giai đoạn khác nhau rõ rệt về mọi mặt. Đất nước từ đó trải qua một cuộc xáo trộn tận gốc với cách mạng và chiến tranh. Về sau người ta có khuynh hướng chia mọi chuyện thành trước và sau cái mốc ấy, trước 1945 thường gọi là thời “tiền chiến”, như nhạc tiền chiến, văn thơ tiền chiến..., như thuộc về một thời đại khác hẳn thời 1945 trở về sau.', 'BÁO THANH NGHỊ  TỪ SỐ 12 ĐẾN SỐ 21  CÒN RẤT ĐẸP', 'Nơi Khô Ráo, Thoáng Mát', 0, 1),
(79, 7, 1, 1, NULL, 5, 'Nghệ Thuật Sống', 3000000, 'Public/image/nst.png', 'Public/image/nst.png', 'Public/image/nst.png', 'MỘT NGHỆ THUẬT SỐNG  XUẤT BẢN NĂM 1941  SÁCH CÒN RẤT ĐẸP', 'Tác phẩm Một nghệ thuật sống nêu lên những quan niệm về cuộc sống và cách sống: sống là gì, lẽ sống của con người, nhận biết chân giá trị của sự vật, hành động để giải thoát…  Tác giả không tập trung khai thác, phân tích tâm lý con người như những sách nghệ thuật sống, rèn luyện nhân cách phổ biến hiện nay. Ông cũng không lên gân, dạy dỗ phải làm điều này điều nọ để có được hạnh phúc trong cuộc sống. Tác giả hướng người đọc đến việc nhận thức được giá trị sự vật như nó vốn có, hiểu được bản ngã của mình để hành động phù hợp với hoàn cảnh. Để trở nên một con người hoàn tòan, theo tác giả, con người cần phải làm hai điều: cải tạo cá nhân và cải tạo xã hội. Đây cũng là chủ đề xuyên suốt trong các chương của cuốn sách.', 'Tác phẩm Một nghệ thuật sống nêu lên những quan niệm về cuộc sống và cách sống: sống là gì, lẽ sống của con người, nhận biết chân giá trị của sự vật, hành động để giải thoát…  Tác giả không tập trung khai thác, phân tích tâm lý con người như những sách nghệ thuật sống, rèn luyện nhân cách phổ biến hiện nay. Ông cũng không lên gân, dạy dỗ phải làm điều này điều nọ để có được hạnh phúc trong cuộc sống. Tác giả hướng người đọc đến việc nhận thức được giá trị sự vật như nó vốn có, hiểu được bản ngã của mình để hành động phù hợp với hoàn cảnh. Để trở nên một con người hoàn tòan, theo tác giả, con người cần phải làm hai điều: cải tạo cá nhân và cải tạo xã hội. Đây cũng là chủ đề xuyên suốt trong các chương của cuốn sách.', 'Nơi Khô Ráo, Thoáng Mát', 0, 1),
(80, 48, 1, 1, NULL, 6, 'GIỜ THỨ 25 - Virgil Gheorghiu', 1200000, 'Public/image/aaa.png', 'Public/image/aaa.png', 'Public/image/aaa.png', 'Ấn phẩm \"Giờ thứ 25\" của tác giả Virgil Gheorghiu, sách do dịch giả Lê Ngọc Trụ và Võ Thị Hay chuyển sang Việt ngữ, được nhà xuất bản Gió Bốn Phương ấn hành năm 1967. Ấn bản đang lưu giữ tại Quán Sách Mùa Thu có tình trang tốt. Sách còn bìa trước và bìa sau, gáy sách còn nguyên và số trang đầy đủ, còn đọc tốt, chữ rõ.  Nhân lần thứ 19 ngày nhà văn nổi tiếng Lỗ Ma Ni Constantin Virgil Gheorghiu lìa trần tại Paris, chúng ta cùng đọc lại tác phẩm đầu tay tuyệt diệu của ông: Giờ Thứ Hai Mươi Lăm xuất bản năm 1949, dầy khoảng 450 trang. Đó là cuốn sách bán chạy nhất Âu châu sau Thế chiến thứ hai, ngay vài tuần lễ đầu đã bán được hơn nửa triệu cuốn, đã được dịch ra hầu hết các thứ tiếng trên thế giới. độc giả Việt Nam đã thấy trong tác phẩm không khí của thời binh đao khói lửa và thân phận bi thảm của con người thời chiến. Cuốn sách đã khiến cho người Tây phương vô cùng xúc động hãi hùng về những tội ác rùng rợn của quân Nga gây ra khi họ tràn sang xâm chiếm Đông Âu.', 'Ấn phẩm \"Giờ thứ 25\" của tác giả Virgil Gheorghiu, sách do dịch giả Lê Ngọc Trụ và Võ Thị Hay chuyển sang Việt ngữ, được nhà xuất bản Gió Bốn Phương ấn hành năm 1967. Ấn bản đang lưu giữ tại Quán Sách Mùa Thu có tình trang tốt. Sách còn bìa trước và bìa sau, gáy sách còn nguyên và số trang đầy đủ, còn đọc tốt, chữ rõ.  Nhân lần thứ 19 ngày nhà văn nổi tiếng Lỗ Ma Ni Constantin Virgil Gheorghiu lìa trần tại Paris, chúng ta cùng đọc lại tác phẩm đầu tay tuyệt diệu của ông: Giờ Thứ Hai Mươi Lăm xuất bản năm 1949, dầy khoảng 450 trang. Đó là cuốn sách bán chạy nhất Âu châu sau Thế chiến thứ hai, ngay vài tuần lễ đầu đã bán được hơn nửa triệu cuốn, đã được dịch ra hầu hết các thứ tiếng trên thế giới. độc giả Việt Nam đã thấy trong tác phẩm không khí của thời binh đao khói lửa và thân phận bi thảm của con người thời chiến. Cuốn sách đã khiến cho người Tây phương vô cùng xúc động hãi hùng về những tội ác rùng rợn của quân Nga gây ra khi họ tràn sang xâm chiếm Đông Âu.', 'Ấn phẩm \"Giờ thứ 25\" của tác giả Virgil Gheorghiu, sách do dịch giả Lê Ngọc Trụ và Võ Thị Hay chuyển sang Việt ngữ, được nhà xuất bản Gió Bốn Phương ấn hành năm 1967. Ấn bản đang lưu giữ tại Quán Sách Mùa Thu có tình trang tốt. Sách còn bìa trước và bìa sau, gáy sách còn nguyên và số trang đầy đủ, còn đọc tốt, chữ rõ.  Nhân lần thứ 19 ngày nhà văn nổi tiếng Lỗ Ma Ni Constantin Virgil Gheorghiu lìa trần tại Paris, chúng ta cùng đọc lại tác phẩm đầu tay tuyệt diệu của ông: Giờ Thứ Hai Mươi Lăm xuất bản năm 1949, dầy khoảng 450 trang. Đó là cuốn sách bán chạy nhất Âu châu sau Thế chiến thứ hai, ngay vài tuần lễ đầu đã bán được hơn nửa triệu cuốn, đã được dịch ra hầu hết các thứ tiếng trên thế giới. độc giả Việt Nam đã thấy trong tác phẩm không khí của thời binh đao khói lửa và thân phận bi thảm của con người thời chiến. Cuốn sách đã khiến cho người Tây phương vô cùng xúc động hãi hùng về những tội ác rùng rợn của quân Nga gây ra khi họ tràn sang xâm chiếm Đông Âu.', 'Nơi Khô Ráo, Thoáng Mát', 0, 1),
(81, 51, 11, 1, NULL, 2, 'CỔNG LÀNG NGƯỜI VIỆT Ở CHÂU THỔ BẮC BỘ - VŨ THỊ THU HÀ', 5000000, 'Public/image/1a2.png', 'Public/image/1a2.png', 'Public/image/1a2.png', 'Văn hóa truyền thống của người Việt từ ngàn đời nay được lưu giữ một phần lớn và quan trọng là ở làng. Làng Việt ở Bắc Bộ là nơi định cư sớm của cư dân Việt. Đa phần công việc trong làng là làm nghề nông. Về cảnh quan, có đường làng, chùa làng, đình làng, ao làng, chợ làng,... và nhiều làng không thể thiếu cổng làng', 'Văn hóa truyền thống của người Việt từ ngàn đời nay được lưu giữ một phần lớn và quan trọng là ở làng. Làng Việt ở Bắc Bộ là nơi định cư sớm của cư dân Việt. Đa phần công việc trong làng là làm nghề nông. Về cảnh quan, có đường làng, chùa làng, đình làng, ao làng, chợ làng,... và nhiều làng không thể thiếu cổng làng', 'Văn hóa truyền thống của người Việt từ ngàn đời nay được lưu giữ một phần lớn và quan trọng là ở làng. Làng Việt ở Bắc Bộ là nơi định cư sớm của cư dân Việt. Đa phần công việc trong làng là làm nghề nông. Về cảnh quan, có đường làng, chùa làng, đình làng, ao làng, chợ làng,... và nhiều làng không thể thiếu cổng làng', 'Nơi Khô Ráo, Thoáng Mát', 0, 1),
(82, 52, 5, 1, NULL, 2, 'ĐÔNG CHU LIỆT QUỐC - PHÙNG MỘNG LONG', 125000, 'Public/image/ang.png', 'Public/image/ang.png', 'Public/image/ang.png', 'Trọn bộ 8 tập Đông chu liệt quốc,  sách được đóng bìa cứng (rất ít gặp), có áo, ruột đẹp và còn nguyên vẹn.', 'Trọn bộ 8 tập Đông chu liệt quốc,  sách được đóng bìa cứng (rất ít gặp), có áo, ruột đẹp và còn nguyên vẹn.', 'Trọn bộ 8 tập Đông chu liệt quốc,  sách được đóng bìa cứng (rất ít gặp), có áo, ruột đẹp và còn nguyên vẹn.', 'Nơi Khô Ráo, Thoáng Mát', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sukien`
--

CREATE TABLE `sukien` (
  `ID` int(11) NOT NULL,
  `tenSK` varchar(200) DEFAULT NULL,
  `ngayBD` text DEFAULT NULL,
  `ngayKT` text DEFAULT NULL,
  `noiDung` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sukien`
--

INSERT INTO `sukien` (`ID`, `tenSK`, `ngayBD`, `ngayKT`, `noiDung`, `image`) VALUES
(76, 'test', '', '', 'okkkkkk', 'Public/image/SuKien/0 (1) (1).png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `passwords` varchar(200) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `checktk` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`ID`, `email`, `passwords`, `role`, `checktk`, `status`) VALUES
(49, 'admin111@gmail.com', '$2y$10$BtOIlzj0RbiHDc3mQCLvQusGGRNSjVPt2VFlnxVeHtgNv6vC4CiIO', 'user', 0, 0),
(50, 'admin1@gmail.com', '$2y$10$F7.AFmRGv.H5MQ7fKVHOTu3hJSWbUVD5o7PG2EZ8I4wOew3iikgNC', 'admin', 2, 0),
(51, 'admintet@gmail.com', '$2y$10$97PQc64tYYpB443yXPOueehsjE1yCnzxPx/x8pDM3SoP82CTeUwpC', 'admin', 1, 0),
(52, 'admintaaet@gmail.com', '$2y$10$3j8m0xJkLsFmihWFZciGqu6YnX/GQa62Z3t5zYwpP5wdkZRpwkbya', 'admin', 0, 0),
(53, 'admin1111@gmail.com', '$2y$10$oWcfYFZjIpg3FpwPgWZY8esH2u4y4GP6LrO3F7GDxVTIEFeMjyDoS', 'admin', 0, 1),
(54, 'abcde@gmail.com', '$2y$10$zcM18tKDCoskAmSZZosAwu2k86sup1e4zjPTEUyLKf25HAmRgNFzK', 'admin', 1, 0),
(55, 'vinhd220@gmail.com', '$2y$10$iXDdBo7qVaAs6FZsAzYJdOvhGtvObUruDnOMSSclNFgeBa9tQHBD6', 'admin', 0, 1),
(56, 'canhcut115@gmail.com', '$2y$10$TUvwfdggsLUguy0mhGwCL.1jnQURo2BoEehs5Fwhwqw9XWJobBhBa', 'user', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `ID` int(11) NOT NULL,
  `tenTL` varchar(100) DEFAULT NULL,
  `Loai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`ID`, `tenTL`, `Loai`) VALUES
(7, 'Sách Xuất Bản Trước 1945', '0'),
(48, 'Sách Xuất Bản Trước 1975', '0'),
(49, 'Sách Văn Học Việt Nam', '0'),
(51, 'Sách Lịch Sử-Văn Hóa', '1'),
(52, 'Sách Văn Học Nước Ngoài', '1'),
(53, 'Sách Kỹ Năng Kinh Doanh', '1'),
(54, 'Sách Kinh Dịch - Tử Vi', '1'),
(55, 'Sách Thiếu Nhi', '2'),
(56, 'Sách Triết Học', '2'),
(57, 'Truyện Cổ Tích', '2'),
(58, 'Sách Binh Pháp', '2'),
(63, 'Truyện Tranh', '0'),
(64, 'Sách Giáo Khoa', '3'),
(65, 'Sách Mỹ Thuật & Âm Nhạc', '3'),
(66, 'Sách Đông Y', '3'),
(67, 'Sách Tiểu Thuyết', '3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `ID` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `date_at` date DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`ID`, `title`, `date_at`, `content`, `image`, `category`) VALUES
(40, 'BƯỚC VÀO THẾ GIỚI SÁCH', '2024-11-30', '\"Chào mừng bạn đến với cửa hàng sách của chúng tôi! Chúng tôi tự hào mang đến cho bạn những cuốn sách thú vị và bổ ích nhất, từ những tác phẩm văn học kinh điển đến những cuốn sách mới nhất giúp bạn mở rộng kiến thức và khám phá thế giới.\"', './Public/image/a4.png', 1),
(41, 'SÁCH ĐƯỢC QUAN TÂM', '2024-11-23', '\"Tại cửa hàng sách của chúng tôi, chúng tôi cam kết cung cấp những cuốn sách chất lượng, được lựa chọn kỹ lưỡng để mang lại trải nghiệm đọc tuyệt vời nhất, giúp bạn khám phá tri thức và đắm chìm trong những câu chuyện đầy cảm hứng.\"', './Public/image/a5.png', 1),
(42, 'Đặt Hàng Trực Tuyến, Linh Hoạt Và Nhanh Chóng', '2022-12-01', '\"Hệ thống đặt sách trực tuyến của chúng tôi đã được nâng cấp để đáp ứng mọi nhu cầu của bạn. Cho phép bạn dễ dàng tìm kiếm, lựa chọn và đặt mua những cuốn sách yêu thích, với dịch vụ giao sách nhanh chóng và chính xác, mang lại sự tiện lợi tối đa cho mỗi đơn hàng.\"\r\n\r\n\r\n\r\n\r\n\r\n\r\n', './Public/image/pv.png', 2),
(43, 'Khuyến Mãi và Ưu Đãi - Hấp Dẫn và Đa Dạng', '2024-12-18', '\"Để tri ân sự ủng hộ của khách hàng, chúng tôi luôn mang đến các chương trình khuyến mãi và ưu đãi hấp dẫn dành cho những tín đồ yêu thích sách. Chúng tôi cam kết đem lại sự hài lòng và trải nghiệm mua sắm tuyệt vời nhất cho mỗi khách hàng.\"', './Public/image/sp.png', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xuatxu`
--

CREATE TABLE `xuatxu` (
  `ID` int(11) NOT NULL,
  `tenSX` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `xuatxu`
--

INSERT INTO `xuatxu` (`ID`, `tenSX`) VALUES
(2, 'Nhiều Tác Giả'),
(4, 'Hungary'),
(5, 'DUNG KIM'),
(6, 'Virgil Gheorghiu'),
(8, 'Vũ Thị Thu Hà'),
(19, 'Việt Nam'),
(20, 'Vũ Đình Hòe');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDKH` (`IDKH`),
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDDH` (`IDDH`);

--
-- Chỉ mục cho bảng `danhsachyeuthich`
--
ALTER TABLE `danhsachyeuthich`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDKH` (`IDKH`),
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDKH` (`IDKH`);

--
-- Chỉ mục cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDSK` (`IDSK`),
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDKH` (`IDKH`),
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDTK` (`IDTK`);

--
-- Chỉ mục cho bảng `kichthuoc`
--
ALTER TABLE `kichthuoc`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `lichsubanhang`
--
ALTER TABLE `lichsubanhang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDKH` (`IDKH`),
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `magiam`
--
ALTER TABLE `magiam`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDSK` (`IDSK`);

--
-- Chỉ mục cho bảng `mausac`
--
ALTER TABLE `mausac`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDLoai` (`IDLoai`),
  ADD KEY `IDBrand` (`IDBrand`),
  ADD KEY `IDSize` (`IDSize`),
  ADD KEY `IDMau` (`IDMau`),
  ADD KEY `IDSX` (`IDSX`);

--
-- Chỉ mục cho bảng `sukien`
--
ALTER TABLE `sukien`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `xuatxu`
--
ALTER TABLE `xuatxu`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- AUTO_INCREMENT cho bảng `danhsachyeuthich`
--
ALTER TABLE `danhsachyeuthich`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=600;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1986;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `kichthuoc`
--
ALTER TABLE `kichthuoc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `lichsubanhang`
--
ALTER TABLE `lichsubanhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT cho bảng `magiam`
--
ALTER TABLE `magiam`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `mausac`
--
ALTER TABLE `mausac`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `sukien`
--
ALTER TABLE `sukien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `xuatxu`
--
ALTER TABLE `xuatxu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`ID`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`IDSP`) REFERENCES `sanpham` (`ID`);

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`IDDH`) REFERENCES `donhang` (`ID`);

--
-- Các ràng buộc cho bảng `danhsachyeuthich`
--
ALTER TABLE `danhsachyeuthich`
  ADD CONSTRAINT `danhsachyeuthich_ibfk_1` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`ID`),
  ADD CONSTRAINT `danhsachyeuthich_ibfk_2` FOREIGN KEY (`IDSP`) REFERENCES `sanpham` (`ID`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`ID`);

--
-- Các ràng buộc cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  ADD CONSTRAINT `giamgia_ibfk_1` FOREIGN KEY (`IDSK`) REFERENCES `sukien` (`ID`),
  ADD CONSTRAINT `giamgia_ibfk_2` FOREIGN KEY (`IDSP`) REFERENCES `sanpham` (`ID`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`ID`),
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`IDSP`) REFERENCES `sanpham` (`ID`);

--
-- Các ràng buộc cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `khachhang_ibfk_1` FOREIGN KEY (`IDTK`) REFERENCES `taikhoan` (`ID`);

--
-- Các ràng buộc cho bảng `lichsubanhang`
--
ALTER TABLE `lichsubanhang`
  ADD CONSTRAINT `lichsubanhang_ibfk_1` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`ID`),
  ADD CONSTRAINT `lichsubanhang_ibfk_2` FOREIGN KEY (`IDSP`) REFERENCES `sanpham` (`ID`);

--
-- Các ràng buộc cho bảng `magiam`
--
ALTER TABLE `magiam`
  ADD CONSTRAINT `magiam_ibfk_1` FOREIGN KEY (`IDSK`) REFERENCES `sukien` (`ID`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`IDLoai`) REFERENCES `theloai` (`ID`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`IDBrand`) REFERENCES `brand` (`ID`),
  ADD CONSTRAINT `sanpham_ibfk_3` FOREIGN KEY (`IDSize`) REFERENCES `kichthuoc` (`ID`),
  ADD CONSTRAINT `sanpham_ibfk_4` FOREIGN KEY (`IDMau`) REFERENCES `mausac` (`ID`),
  ADD CONSTRAINT `sanpham_ibfk_5` FOREIGN KEY (`IDSX`) REFERENCES `xuatxu` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 11, 2025 lúc 09:59 PM
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
-- Cơ sở dữ liệu: `rebook`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_types`
--

CREATE TABLE `account_types` (
  `AccountTypeID` int(11) NOT NULL,
  `AccountTypeName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account_types`
--

INSERT INTO `account_types` (`AccountTypeID`, `AccountTypeName`) VALUES
(1, 'Quản trị viên'),
(3, 'Thành viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `authors`
--

CREATE TABLE `authors` (
  `AuthorID` int(11) NOT NULL,
  `AuthorName` varchar(64) DEFAULT NULL,
  `Note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `authors`
--

INSERT INTO `authors` (`AuthorID`, `AuthorName`, `Note`) VALUES
(1, 'Aoyama Gosho', 'Tác giả Nhật Bản'),
(2, 'Nguyễn Nhật Ánh', 'Tác giả Việt Nam'),
(3, 'Author Conan Doyle', 'Tác giả Anh'),
(4, 'Shinkai Makoto', 'Tác giả Nhật'),
(5, 'Tite Kubo', 'Tác giả Nhật Bản'),
(6, 'Tô Hoàii', 'Tác giả Việt Nam'),
(7, 'Eiichiro Oda', 'Tác giả Nhật Bản'),
(8, 'ONE', 'Tác giả Nhật Bản'),
(9, 'Murata', 'Tác giả Nhật Bản'),
(10, 'Gege Akutami', 'Tác giả Nhật Bản'),
(11, 'Obata', 'Tác giả Nhật Bản'),
(12, 'Masashi Kisimoto', 'Tác giả Nhật Bản'),
(13, 'Fujiko', 'Tác giả Nhật Bản'),
(17, 'Hubert Seipel', 'Tác giả Đức'),
(18, 'Allan Dib', ''),
(20, 'Bộ Giáo Dục Và Đào Tạo', ''),
(21, 'Phan Huy Lê', ''),
(22, 'Hà Văn Tấn', ''),
(23, 'Nhiều tác giả', ''),
(24, 'Khác', ''),
(25, 'Hae Min', ''),
(26, 'Nguyễn Anh Dũng', ''),
(27, 'Antoine De Saint-Exupéry', ''),
(28, 'Phùng Quán', ''),
(29, 'Paul R. Murphy, Jr., A. Michael Knemeyer', ''),
(30, 'Hubert Seipel', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `books`
--

CREATE TABLE `books` (
  `ISBN` varchar(13) NOT NULL,
  `BookTitle` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `PublishYear` int(11) DEFAULT NULL,
  `Weight` int(11) DEFAULT NULL,
  `Size` varchar(11) DEFAULT NULL,
  `PageNumber` int(11) DEFAULT NULL,
  `Thumbnail` varchar(255) DEFAULT NULL,
  `LanguageID` varchar(8) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `PublishID` int(11) DEFAULT NULL,
  `UpdatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `AuthorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `books`
--

INSERT INTO `books` (`ISBN`, `BookTitle`, `Description`, `PublishYear`, `Weight`, `Size`, `PageNumber`, `Thumbnail`, `LanguageID`, `Price`, `CategoryID`, `PublishID`, `UpdatedAt`, `AuthorID`) VALUES
('8934974169697', 'Nước Mỹ Trong Mắt Trump - The United States Of Trump : How The President Really Sees America', 'Nước Mỹ trong mắt Trump là cuốn sách mới nhất của B.O’Reilly, xuất bản cuối 2019, được viết dưới dạng kể chuyện từ những cuộc phỏng vấn trực tiếp của O’Reilly với Tổng thống Mỹ D.Trump và gia đình theo mạch thời gian kèm theo một số bình luận của tác giả; cũng như nghiên cứu của tác giả về các chủ đề liên quan. O’Reilly đã tìm cách lý giải những động lực thúc đẩy Donald Trump trong cuộc sống và cụ thể hơn là trong quyết định tạm gác lại những xa hoa phú quý của một ông trùm bất động sản để tuyên bố tranh cử Tổng thống; chỉ ra sức hút của ông Trump đối với cử tri Mỹ trong năm 2016. Những lập luận và khung phân tích của tác giả chắc chắn rất có ích trong phân tích cuộc tổng tuyển cử Mỹ năm 2020. Ngôn ngữ sắc sảo và ngắn gọn, cùng sự cẩn trọng chi tiết trong nghiên cứu về chủ thể của tác giả mang lại sự hấp dẫn đặc biệt khó cưỡng đối với ai muốn biết về tổng thống Mỹ D. Trump- trong đời thường và trong chính trường. - Về tác giả: B. O’Reilly có hơn 20 năm là người dẫn chương trình và bình luận viên thời sự của Fox News, đã trở nên quen thuộc với nhiều độc giả Việt Nam thông qua loạt sách Killing, kể về những tình tiết đặc biệt xung quanh cuộc đời của những nhân vật lịch sử nổi tiếng từng bị ám sát. O’Reilly đã có 4 cuốn sách nằm trong danh sách bán chạy nhất của Thời báo New York.', 2020, 400, '23 x 15', 392, '/assets/img/books/1749212917_NuocMyTrongMatTrump.jpg', 'aa', 198000, 1, 2, '2025-06-06 22:41:08', 24),
('8935075947375', 'Cửa Sổ Lịch Sử Văn Hóa Việt Nam', 'Trong tâm trí của nhiều người đương thời, tên tuổi Hà Văn Tấn được ghi nhận như một nhà khoa học đầu đàn trong lĩnh vực khảo cổ học, một trong những ngành khoa học đòi hỏi trình độ chính xác cao; và ở đó ông đã thu được những thành tựu khả quan.  Song bên cạnh khảo cổ học, Hà Văn Tấn cũng đã viết nhiều về lịch sử trung đại Việt Nam, và đi vào một số hiện tượng văn hóa tiêu biểu như đình, chùa, văn hóa Phật giáo... Rồi ông mở rộng ra một số vấn đề trọng yếu như bản sắc dân tộc, giao lưu văn hóa cổ, hoặc thử đề nghị một cách nhìn biện chứng đối với truyền thống.', 2020, 420, '140 x 220', 406, '/assets/img/books/1749217286_CuaSoLichSuVHVN.jpg', 'aa', 169000, 4, 8, '2025-06-06 22:30:56', 22),
('8935086853672', 'Putin - Logic Của Quyền Lực - Putin: Innenansichten Der Macht', 'Tên gốc của tác phẩm là Putin: Innenansichten der Macht. Sách gồm 21 chương, do Hubert Seipel thực hiện trong 5 năm (từ năm 2010 đến 2015). Tác giả đã có hơn 20 buổi phỏng vấn chuyên sâu với Putin, đồng thời tháp tùng ông trên hàng chục chuyến đi trong, ngoài nước.  Sách mở ra góc nhìn mới về nhà lãnh đạo Nga. Putin: Logic của quyền lực phát hành ở Việt Nam cuối tháng 11, do dịch giả Phan Xuân Loan chuyển ngữ, Nhà xuất bản Tổng hợp phát hành. Hubert Seipel tái hiện những dấu mốc chính trong cuộc đời Putin. Năm 1975, Putin tốt nghiệp khoa Luật Đại học Tổng hợp Quốc gia Saint Petersburg. Năm 1985, ông trở thành nhân viên tình báo đối ngoại của Liên Xô ở Đức. Năm 1994, ông trở thành phó chủ tịch thứ nhất của thành phố quê nhà Saint Petersburg. Năm 1996, ông chuyển đến Moskva và được bổ nhiệm nhiều chức vụ quan trọng trong văn phòng Tổng thống Nga. Cuối năm 1999, ông trở thành Tổng thống Nga.  Khi mới lên nắm quyền, ông phải đối mặt với nhiều khó khăn trong giai đoạn ', 2020, 400, '20 x 14', 384, '/assets/img/books/1749213133_PutinLogicCuaQuyenLuc.jpg', 'vi', 168000, 1, 6, '2025-06-06 22:42:11', 30),
('8935235243163', 'Khi Mọi Điều Không Như Ý', 'Có những ngày, mọi thứ đều chống lại ta - công việc bế tắc, các mối quan hệ rạn nứt, lòng trống rỗng đến nghẹt thở. Ta tự hỏi: ', 2019, 300, '240 x 120', 240, '/assets/img/books/1749217130_KhiMoiDieuKhongNhuy.jpg', 'vi', 109000, 7, 1, '2025-06-06 22:32:21', 25),
('8935244827972', 'Sách - Tuổi Thơ Dữ Dội', '“Tuổi Thơ Dữ Dội” là một câu chuyện hay, cảm động viết về tuổi thơ. Sách dày 404 trang mà người đọc không bao giờ muốn ngừng lại, bị lôi cuốn vì những nhân vật ngây thơ có, khôn ranh có, anh hùng có, vì những sự việc khi thì ly kỳ, khi thì hài hước, khi thì gây xúc động đến ứa nước mắt...  ', 2019, 420, '135 x 200', 400, '/assets/img/books/1749216147_TuoiThoDuDoi.jpg', 'vi', 80001, 8, 1, '2025-06-06 22:36:01', 28),
('8935244868999', 'Hoàng Tử Bé (Tái Bản 2022)', '“...Cậu hoàng tử chợp mắt ngủ, tôi bế em lên vòng tay tôi và lại lên đường. Lòng tôi xúc động. Tôi có cảm giác như trên Mặt Đất này không có gì mong manh hơn. Nhờ ánh sáng trăng, tôi nhìn thấy vầng trán nhợt nhạt ấy, đôi mắt nhắm nghiền các lẵng tóc run rẩy trước gió, và tôi nghĩ thầm: ', 2016, 140, '130 x 245', 120, '/assets/img/books/1749216521_HoangTuBe.jpg', 'vi', 35000, 8, 1, '2025-06-06 22:34:01', 27),
('8935251422467', 'Marketing Tinh Gọn - Lean Marketing - Lợi Nhuận Nhiều Hơn, Quảng Cáo Ít Hơn', 'Marketing Tinh Gọn - Lean Marketing - Lợi Nhuận Nhiều Hơn, Quảng Cáo Ít Hơn  AI NÊN ĐỌC CUỐN SÁCH NÀY:  - Chủ doanh nghiệp nhỏ đến vừa đang bị “ngợp” với quá nhiều kênh marketing.  - Marketer đang tìm kiếm một hệ thống dễ áp dụng và đo lường rõ ràng.  - Những ai chán nản với các chiến lược marketing truyền thống: đắt đỏ, rủi ro cao và thiếu hiệu quả.  - Người muốn tạo tăng trưởng bền vững, không cần “la hét” để vượt qua đối thủ.  TÓM TẮT SÁCH  Cuốn sách Marketing tinh gọn là phần tiếp theo của hiện tượng best-seller toàn cầu Kế hoạch marketing trên một-trang-giấy, tiếp tục sứ mệnh giúp các doanh nghiệp làm ít hơn nhưng hiệu quả hơn trong marketing.  Trong bối cảnh các chiến lược marketing ngày càng phức tạp, tốn kém và mất kiểm soát, Allan Dib đưa ra giải pháp “marketing tinh gọn” (lean marketing) – một cách tiếp cận đơn giản, có hệ thống và cực kỳ hiệu quả. Thay vì chạy theo trào lưu, công cụ hào nhoáng hay những chiến dịch cồng kềnh, “lean marketing” giúp tập trung vào những hoạt động có giá trị thật, đem lại kết quả rõ rệt.  Cuốn sách tập trung giải quyết những vấn đề:  - Tại sao nhiều kỹ thuật marketing hiện tại không còn hiệu quả – và nên thay thế bằng cách tiếp cận nào?  - Cung cấp bộ công cụ và chiến thuật cụ thể để xây dựng một hệ thống marketing hiệu quả và dễ vận hành.  - Cách tổ chức hoạt động marketing hiệu quả, đồng bộ tránh tình trạng làm việc tự phát, “hứng đâu làm đấy”.  - Làm sao để giảm thiểu chi phí, công sức mà vẫn lôi kéo được khách hàng.  - Cách tạo ra sự phù hợp hoàn hảo giữa sản phẩm và thị trường mục tiêu (product-market fit).  - Cách làm marketing chân chính – không phô trương, không thao túng, không gây áp lực.  - Cách xây dựng thương hiệu mạnh mẽ, thu hút đúng khách hàng lý tưởng.  CUỐN SÁCH CÓ GÌ ĐẶC BIỆT  - Chủ đề “Tinh gọn” nhưng hiếm người nói đúng cách trong marketing: chọn một hướng đi đặc biệt: làm ít nhưng trúng – và hiệu quả vượt trội. Tác giả đưa tư duy “tinh gọn” từ sản xuất và quản trị (như Lean Startup) vào marketing một cách rất tự nhiên, thực tế.  - Cách triển khai khoa học, có hệ thống, thực chiến: cung cấp khung tư duy + công cụ hành động, giúp độc giả áp dụng ngay vào thực tế như:  + 9 nguyên lý cốt lõi của Lean Marketing  + 7 loại giá trị cốt lõi khách hàng thực sự tìm kiếm  + 10 điều răn trong copywriting  + Công thức tính Lifetime Value (LTV) và Customer Acquisition Cost (CAC)  - Lối viết thẳng thắn, hài hước và không màu mè.  - Các chiến lược đều đã được kiểm chứng trong thực tế.  - Có chiều sâu nhưng không hàn lâm, phù hợp với cả người mới bắt đầu lẫn người làm marketing lâu năm. Những case-study, ví dụ thực tế được chọn lọc kỹ lưỡng, dễ hiểu.  CÁC TRÍCH ĐOẠN HAY  “Văn hóa hối hả tôn vinh ‘sự cày cuốc’. Mặc dù chưa bao giờ né tránh công việc khó khăn, nhưng tôi cũng không bao giờ hiểu được sự phức tạp của kiểu tử vì đạo này. Tại sao một thứ chiếm phần lớn cuộc sống lại phải là sự cày cuốc mệt mỏi? Công việc và kinh doanh nên là niềm vui, và kiểu cày cuốc duy nhất thực sự thú vị lại nằm ngoài phạm vi của cuốn sách này. Vì vậy, thay vì ‘cày cuốc’, tôi khuyến khích bạn xây dựng một doanh nghiệp dễ dàng, sinh lời và thú vị.”  “Có rất nhiều cách tiếp cận khác nhau với marketing, và thật hấp dẫn khi cố tìm ra “cách tiếp cận đúng đắn duy nhất”, nhưng đó là suy nghĩ của những kẻ nửa vời. Giá trị thực sự nằm ở việc tiếp thu đa dạng góc nhìn và chọn lọc những ý tưởng hay nhất từ mỗi quan điểm. Một số nhận thức sâu sắc nhất của tôi đến từ những người mà trước đó tôi không đồng tình. “  “Một khái niệm quan trọng trong sản xuất tinh gọn là sử dụng các máy móc nhỏ, đa năng thay vì các máy móc lớn, đắt tiền, chuyên dụng. Tương tự, trong marketing tinh gọn, chúng ta tập trung vào các nguyên tắc cơ bản cốt lõi của tiếp thị – các quy trình và hệ thống mà bạn có thể tự mình thực hiện cùng với đội ngũ nhân viên bình thường của mình. Bạn không cần đến các chuyên gia, thiên tài đắt tiền hay những người có kỹ năng chuyên môn độc nhất vô nhị. Nếu thực hiện nhất quán các nguyên tắc cơ bản trong cuốn sách này, bạn sẽ xây dựng được một cơ sở hạ tầng tiếp thị mạnh mẽ, phát triển năng lực tiếp thị của riêng mình và đạt được kết quả lớn.”  “Do những hạn chế của thế giới vật chất và mối tương quan trực tiếp với lợi nhuận, các nhà sản xuất tinh gọn đã tập trung mạnh mẽ vào việc loại bỏ lãng phí và tăng hiệu quả. Toyota là công ty tiên phong trong lĩnh vực này, vào những năm 1950 và 1960, họ đã phát triển Hệ thống sản xuất Toyota, tiền thân của Sản xuất tinh gọn. Sản xuất tinh gọn là một phương pháp tập trung vào việc loại bỏ lãng phí và tăng hiệu quả trong quy trình sản xuất.”  “Người ta sẽ quên những gì bạn nói, người ta sẽ quên những gì bạn làm, nhưng người ta sẽ không bao giờ quên cảm giác mà bạn mang lại cho họ.”  “Một người không muốn quan tâm tới bạn thì cũng sẽ không chi tiền cho bạn. Tiền sẽ chảy đến nơi có sự chú ý. Đúng người, đúng việc sẽ mở e-mail của bạn, yêu thích nội dung của bạn và mua hàng của bạn. Còn một danh sách e-mail khách hàng mà bạn không bao giờ gửi thì có tác dụng gì? Có thể bạn sẽ không bị ai hủy đăng ký, nhưng bạn cũng sẽ không có bất cứ cuộc trò chuyện, chuyển đổi hoặc doanh thu nào. Thành công nằm ở sự theo sát.”  “Mỗi nền tảng đều có những đặc điểm riêng và một nhóm ‘người hoàng tộc’ phát triển mạnh ở đó. Các tiểu văn hóa này nổi lên và có một lượng người theo dõi đông đảo.”  … Reddit bị thống trị bởi những người ẩn danh, chia sẻ suy nghĩ, cảm xúc và trải nghiệm của họ chi tiết đến mức khó tin. Không có tiểu văn hóa nào là quá kỳ quặc hoặc quá cụ thể. Những câu nói hóm hỉnh ngắn gọn được ủng hộ nhiệt tình, và những chuỗi bình luận dài dằng dặc biến thành dòng ý thức bất tận.”  9 nguyên tắc marketing tinh gọn:  # 1 - Tạo ra giá trị cho thị trường mục tiêu bằng hoạt động marketing  # 2 - Lồng ghép marketing vào toàn bộ vòng đời sản phẩm và hành trình khách hàng  # 3 - Thị trường đi trước sản phẩm  # 4 - Sử dụng các công cụ và công nghệ để làm những việc nặng nhọc và giảm rào cản  # 5 - Tài sản làm tăng sản lượng từ các hoạt động marketing  # 6 - Bán hàng là cách tốt nhất để xây dựng thương hiệu  # 7 - Marketing là một quy trình, không phải một sự kiện  # 8 - Hãy sử dụng nội dung để tạo ra lực hút  # 9 - Hãy kiểm tra, đo lường và liên tục cải thiện từng bước trong các chiến dịch marketing', 2020, 480, '20 x 13', 464, '/assets/img/books/1749213898_bia-marketing-tinh-gon-bia-1.jpg', 'vi', 194500, 2, 7, '2025-06-06 22:40:37', 18),
('8935278607557', 'Logistics Và Quản Trị Chuỗi Cung Ứng', 'Logistics Và Quản Trị Chuỗi Cung Ứng  Logistics và Quản trị chuỗi cung ứng - “Bách khoa toàn thư” về Logistics thời đại mới  Chỉ cần một cú click chuột, ta sẽ nhận về hàng nghìn kết quả với cụm từ “Logistics và Quản trị chuỗi cung ứng”. Điều này làm ta như chìm trong đại dương thông tin và mơ hồ với những đúng - sai, thật - giả. Những kiến thức và khái niệm sai lệch không chỉ gây nên những lỗ hổng kiến thức mà còn cản trở quá trình tiếp thu và nghiên cứu. Và quyển sách textbook Logistics và Quản trị chuỗi cung ứng sẽ là ngọn hải đăng soi sáng, mang đến những thông tin, kiến thức chính xác và đưa bạn thoát khỏi những băn khoăn về ngành nghề thú vị này.  Quyển sách được ông Trần Thanh Hải - Phó Cục trưởng Cục Xuất nhập khẩu (Bộ Công Thương) và Chủ tịch danh dự Hiệp hội Phát triển nhân lực Logistics Việt Nam (VALOMA); cùng ông Đào Trọng Khoa - Phó Chủ tịch Thường trực Hiệp hội Doanh nghiệp Dịch vụ Logistics Việt Nam viết lời giới thiệu và đề xuất với bạn đọc.  Logistics và Quản trị chuỗi cung ứng là một cuốn “bách khoa toàn thư” mang đến những kiến thức, hướng dẫn đầy đủ nhất về Logistics và quản trị chuỗi cung ứng đương đại. Điều đó sẽ mang đến cho độc giả những thông tin và kiến thức chính xác, bổ ích nhưng vẫn vô cùng dễ dàng tiếp thu, giúp độc giả dễ dàng hơn trong việc tìm hiểu và nghiên cứu về ngành nghề “mắt xích phát triển kinh tế” này. Quyển textbook này sẽ giúp bạn nắm rõ từ kho vận đến giao nhận một cách dễ dàng với 3 phần chính: Tổng quan về Logistics, Quản trị chuỗi cung ứng và Các thành tố của hệ thống Logistics. Mỗi phần sẽ tiếp tục chia ra thành các mục nhỏ, bảo đảm sẽ giúp bạn hiểu tường tận từng ngõ ngách của Logistics và quản trị chuỗi cung ứng.  Dù độc giả có bắt đầu từ con số 0 tròn trĩnh, Logistics và Quản trị chuỗi cung ứng vẫn sẽ giúp hành trình khám phá của bạn vô cùng dễ dàng và đầy lý thú. Ở mỗi phần, tác giả đều phân cấp kiến thức một cách logic, để người đọc hiểu từ khái quát cho đến chi tiết, từ chiều rộng cho đến chiều sâu. Cùng với đó, mỗi chương sách đều có phần tóm tắt, tổng kết kiến thức chung toàn chương và bảng các thuật ngữ chính cần ghi nhớ để độc giả dễ dàng hệ thống kiến thức. Đặc biệt, những khái niệm, từ ngữ chuyên ngành được in đậm và chú thích trực tiếp bên cạnh văn bản; người đọc sẽ hiểu tường tận các kiến thức mà không phải loay hoay tra cứu thêm. Không chỉ mang đến những lý thuyết, khái niệm căn bản để đặt nền móng kiến thức, độc giả còn được nhập vai để cùng tác giả phân tích và giải quyết các tình huống trong doanh nghiệp. Độc giả có thể vận dụng các kiến thức đã tìm hiểu để đề ra các giải pháp tối ưu cho nhiều vấn đề: từ quyết định đầu tư, chiến lược Logistics, tổ chức và quản lý Logistics, dịch vụ khách hàng cho đến các cân nhắc về luật định và chính trị trong quản lý chuỗi cung ứng.  Qua 12 lần tái bản, quyển “bách khoa toàn thư về Logistics” này đã chứng kiến những thăng trầm trong ngành từ buổi sơ khai đến những giai đoạn bùng nổ thương mại toàn cầu. Đồng thời, quyển textbook cũng liên tục cập nhật và phản ánh bối cảnh kinh doanh đặc trưng bởi những căng thẳng địa chính trị ở nhiều nơi trên thế giới, các lỗ hổng trong chuỗi cung ứng do thảm họa nghiêm trọng và các tiến bộ công nghệ tăng tốc không ngừng. Cùng với các khái niệm, thuật ngữ mới luôn được cập nhật, Logistics và quản trị chuỗi cung ứng đã trở thành một tài liệu quý giá không chỉ dành cho sinh viên, giảng viên hay người trong ngành, mà còn dành cho bất kỳ ai yêu thích và đam mê ngành kinh tế toàn cầu này.', 2016, 450, '27 x 20', 436, '/assets/img/books/1749214208_logistics-va-quan-tri-chuoi-cung-ung-pdf.jpg', 'vi', 346500, 2, 7, '2025-06-06 22:40:06', 29),
('8935279135219', 'Giáo Trình Tư Tưởng Hồ Chí Minh (Dành Cho Bậc Đại Học Hệ Không Chuyên Lý Luận Chính Trị)', 'Giáo trình do tập thể tác giả là những nhà nghiên cứu, nhà giáo dục có nhiều kinh nghiệm trong nghiên cứu, giảng dạy về tư tưởng Hồ Chí Minh, PGS.TS. Mạch Quang Thắng làm chủ biên; được biên soạn theo quan điểm đổi mới căn bản, toàn diện giáo dục và đào tạo. Giáo trình thể hiện nhiều kết quả nghiên cứu mới về tư tưởng Hồ Chí Minh, gắn với các nội dung học tập và làm theo tư tưởng, đạo đức, phong cách Hồ Chí Minh.  Giáo trình được kết cấu gồm 6 chương, trình bày những vấn đề cơ bản của tư tưởng Hồ Chí Minh. Chương 1 đề cập những vấn đề chung nhất của môn học (khái niệm, đối tượng, phương pháp nghiên cứu và ý nghĩa học tập môn Tư tưởng Hồ Chí Minh); Chương 2 trình bày cơ sở, quá trình hình thành và phát triển tư tưởng Hồ Chí Minh. Các chương còn lại gồm các nội dung: Tư tưởng Hồ Chí Minh về độc lập dân tộc và chủ nghĩa xã hội; Tư tưởng Hồ Chí Minh về Đảng Cộng sản Việt Nam và Nhà nước của nhân dân, do nhân dân, vì nhân dân; Tư tưởng Hồ Chí Minh về đại đoàn kết toàn dân tộc và đoàn kết quốc tế; Tư tưởng Hồ Chí Minh về văn hóa, con người.  Giáo trình góp phần giúp người học hiểu sâu sắc, toàn diện và đầy đủ hơn về vai trò, vị trí, ý nghĩa của tư tưởng Hồ Chí Minh, các nội dung cơ bản trong tư tưởng Hồ Chí Minh, từ đó vận dụng, liên hệ với thực tiễn học tập, rèn luyện, xây dựng nhân cách để trở thành công dân tốt, đóng góp vào công cuộc xây dựng đất nước.', 2024, 320, '205 x 120', 272, '/assets/img/books/1749218391_GiaoTrinhTuTuong.jpg', 'vi', 60000, 5, 8, '2025-06-06 22:28:58', 20),
('8935279153367', 'Giáo Trình Triết Học Mác - Lênin (Dành Cho Bậc Đại Học Hệ Không Chuyên Lý Luận Chính Trị)', 'Giáo trình do Ban biên soạn gồm các tác giả là nhà nghiên cứu, nhà giáo dục thuộc Viện Triết học - Học viện Chính trị quốc gia Hồ Chí Minh, các học viện, trường đại học, Viện Triết học - Viện Hàn lâm Khoa học xã hội Việt Nam,... tổ chức biên soạn trên cơ sở kế thừa những kết quả nghiên cứu trước đây, đồng thời bổ sung nhiều nội dung, kiến thức, kết quả nghiên cứu mới, gắn với công cuộc đổi mới ở Việt Nam, nhất là những thành tựu trong 35 năm đổi mới đất nước.  Giáo trình gồm 03 chương:  Chương 1 trình bày những nét khái quát nhất về triết học, triết học Mác - Lênin và vai trò của triết học Mác - Lênin trong đời sống xã hội.  Chương 2 trình bày những nội dung cơ bản của chủ nghĩa duy vật biện chứng, gồm: vấn đề vật chất và ý thức; phép biện chứng duy vật; lý luận nhận thức của chủ nghĩa duy vật biện chứng.  Chương 3 trình bày những nội dung cơ bản của chủ nghĩa duy vật lịch sử, gồm: vấn đề hình thái kinh tế - xã hội; giai cấp và dân tộc; nhà nước và cách mạng xã hội; ý thức xã hội; triết học về con người.  Giáo trình được biên soạn theo yêu cầu đổi mới căn bản, toàn diện giáo dục và đào tạo, phù hợp với đối tượng người học, nhằm cung cấp những tri thức hiểu biết có tính nền tảng và hệ thống về triết học Mác - Lênin; xây dựng thế giới quan duy vật và phương pháp luận biện chứng duy vật làm nền tảng lý luận cho việc nhận thức các vấn đề, nội dung của các môn học khác; nhận thức được thực chất giá trị, bản chất khoa học, cách mạng của triết học Mác - Lênin. Đồng thời, giúp cho sinh viên vận dụng tri thức triết học Mác - Lênin, thế giới quan duy vật và phương pháp luận biện chứng duy vật để rèn luyện tư duy, giúp ích trong học tập và cuộc sống.', 2024, 510, '205 x 150', 496, '/assets/img/books/1749218267_GiaoTrinhTriet.jpg', 'vi', 74000, 5, 1, '2025-06-06 22:29:04', 20),
('9784041046593', 'Your Name', 'Truyện ngắn', 2016, 0, '130 x 176', 288, '/assets/img/books/your-name.jpg', 'vi', 60000, 6, 3, '2025-06-06 22:42:37', 4),
('9784088802206', 'Naruto tập 72', 'Truyện ngắn', 2021, 0, '117 x 176', 288, '/assets/img/books/naruto-vol-72.jpg', 'vi', 22000, 6, 3, '2025-06-06 22:43:07', 12),
('9786042212811', 'One Punch Man Tập 1', 'Truyện ngắn', 2018, 0, '117 x 176', 184, '/assets/img/books/opm-1.jpg', 'vi', 18000, 6, 1, '2025-06-06 22:43:32', 8),
('9786042212819', 'One Punch Man Tập 9', 'Truyện ngắn', 2018, 0, '117 x 176', 184, '/assets/img/books/opm-9.jpg', 'vi', 18000, 6, 1, '2025-06-06 22:43:43', 8),
('9786042212831', 'Death Note Tập 1', 'Truyện ngắn', 2020, 0, '117 x 176', 184, '/assets/img/books/death-note-1.jpg', 'vi', 35000, 6, 1, '2025-06-06 22:44:28', 11),
('9786042212840', 'Chú Thuật Hồi Chiến Tập 0', 'Truyện ngắn', 2021, 0, '117 x 176', 184, '/assets/img/books/chut-thuat-hoi-chien-0.jpg', 'vi', 30000, 6, 1, '2025-06-06 22:44:37', 10),
('9786042212842', 'Chú Thuật Hồi Chiến Tập 2', 'Truyện ngắn', 2021, 0, '117 x 176', 184, '/assets/img/books/chu-thuat-hoi-chien-2.jpg', 'vi', 30000, 6, 1, '2025-06-06 22:45:02', 10),
('9786042212847', 'Doraemon dài - Tập 14: Nobita và ba chàng hiệp sĩ mộng mơ', 'Truyện dài', 2021, 0, '130 x 190', 189, '/assets/img/books/doraemon-vol-14.jpg', 'vi', 18000, 6, 1, '2025-06-06 22:45:28', 13),
('9786042234252', 'Thám Tử Lừng Danh Conan - Tập 99', 'Truyện ngắn', 2022, 200, '176 x 113', 184, '/assets/img/books/conan-tap-99.jpg', 'vi', 20000, 6, 1, '2025-06-06 22:34:38', 1),
('9786042268127', 'Chú Thuật Hồi Chiến Tập 1', 'Truyện ngắn', 2022, 0, '117 x 176', 184, '/assets/img/books/chu-thuat-hoi-chien-tap-1.jpg', 'vi', 30000, 6, 1, '2025-06-06 22:34:53', 10),
('9786043440287', 'Tư Duy Ngược', 'Tư Duy Ngược  Chúng ta thực sự có hạnh phúc không? Chúng ta có đang sống cuộc đời mình không? Chúng ta có dám dũng cảm chiến thắng mọi khuôn mẫu, định kiến, đi ngược đám đông để khẳng định bản sắc riêng của mình không?. Có bao giờ bạn tự hỏi như thế, rồi có câu trả lời cho chính mình?  Tôi biết biết, không phải ai cũng đang sống cuộc đời của mình, không phải ai cũng dám vượt qua mọi lối mòn để sáng tạo và thành công… Dựa trên việc nghiên cứu, tìm hiểu, chắt lọc, tìm kiếm, ghi chép từ các câu chuyện trong đời sống, cũng như trải nghiệm của bản thân, tôi viết cuốn sách này.  Cuốn sách sẽ giải mã bạn là ai, bạn cần Tư duy ngược để thành công và hạnh phúc như thế nào và các phương pháp giúp bạn dũng cảm sống cuộc đời mà bạn muốn.', 2021, 214, '200 x 130', 242, '/assets/img/books/1749216759_TuDuyNguoc.jpg', 'vi', 125000, 7, 2, '2025-06-06 22:33:22', 26),
('9786045541401', 'Biên niên sử phong trào thơ mới Hà Nội (1932-1945) - Tập 1', 'Đã hơn tám mươi năm trôi qua, kể từ ngày Thơ mới chính thức bước lên văn đàn - gần một thế kỷ của biết bao biến động, đổi thay của lịch sử, thời cuộc, phong trào Thơ mới vẫn còn vẹn nguyên giá trị của “một thời đại trong thi ca”.  Lịch sử nghiên cứu về Thơ mới từ trước đến nay cho thấy sức hút mạnh mẽ của phong trào thi ca có vai trò đặc biệt quan trọng trong tiến trình hiện đại hóa nền thơ dân tộc, từ đó, diện mạo Thơ mới đã trở nên khá toàn diện, phong phú. Nhưng, nghiên cứu về một hiện tượng, sự kiện, nhất là với một hiện tượng văn học xuất hiện từ cách đây gần một thế kỷ, sẽ là thiêu sót nếu thiếu đi những nghiên cứu, đánh giá cùng thời, những tiếng nói, cách nhìn của ngươi trong cuộc. Ấp ủ và công phu chuẩn bị, khảo sát, sưu tầm, tập hợp tư liệu qua hơn hai thập kỷ, PGS.TS. Nguyễn Hữu Sơn cùng các cộng sự đã hoàn thành ý tưởng về một cuốn sách “thời Thơ mới nói về Thơ mới” - công trình mang tên “Biên niên sử phong trào Thơ mới Hà Nội (1932 - 1945)” được biên soạn, xuất bản trong khuôn khổ Dự án Tủ sách Thăng Long ngàn năm văn hiến (giai đoạn II).  Cuốn sách sưu tập, tổng hợp, thống kê các nguồn tài liệu trên sách báo, ấn phẩm xuất bản trước năm 1945 nhằm đưa đến một cái nhìn hệ thống, toàn cảnh về tất cả các vấn đề, sự kiện, hiện tượng liên quan đến phong trào Thơ mới Hà Nội. Với định hướng đó, đúng như tên gọi, cuốn sách lựa chọn cách trình bày tư liệu theo thể thức biên niên với 14 mục tương ứng với 14 năm - quãng thời gian Thơ mới xuất hiện và thoái trào, từ 1932 đến 1945. Trong mỗi năm, sự kiện sẽ được sắp xếp, trình bày theo cấp độ từng tháng, từng ngày theo đúng trật tự xuất hiện là thời điểm được xuất bản trên các ấn phẩm.  Với cách bố cục này, với sự phong phú của khốỉ lượng tư liệu được lựa chọn, cuốn sách thực sự như “một cuốn phim quay chậm” toàn cảnh phong trào Thơ mới Hà Nội. Ở đó, bức tranh lịch sử phong trào được phục hiện một cách chân thực, sinh động, toàn diện: bối cảnh xuất hiện; quá trình “đấu tranh', 2019, 800, '160 x 240', 782, '/assets/img/books/1749379120_BienNienSuPhongTraoThoHN.jpg', 'vi', 490000, 3, 10, '2025-06-08 17:42:10', 24),
('9786047703586', 'Lịch Sử và Văn Hóa Việt Nam - Tiếp Cận Bộ Phận', 'Lịch sử và văn hoá là yếu tố tạo nên bản sắc riêng biệt vốn có của bất kì quốc gia, dân tộc. Và dân tộc Việt Nam cũng có một lịch sử mấy ngàn năm dựng và giữ nước oai hùng và một nền văn hoá đặc sắc. Cuốn sách dày hơn một nghìn trang của giáo sư Phan Huy Lê đã cung cấp những tri thức về lịch sử văn hoá Việt Nam với những cách tiếp cận mới để trả lời cho câu hỏi: Chúng ta là ai?', 2016, 1340, '169 x 240', 1000, '/assets/img/books/1749217982_LichSuVHVNTiepCanBoPhan.jpg', 'vi', 265000, 4, 8, '2025-06-06 22:30:18', 21),
('9796055541421', 'Tuổi thanh xuân còn mãi', 'Thể loại: Hồi ức Tác giả: Các cựu lưu học sinh học các năm 1980 – 1986, 1987 tại Liên Xô (cũ) và các nước Đông Âu Chủ biên và đồng tác giả: nhà thơ Hữu Việt Số trang: 450 trang, khổ sách 13,5 x 20,5 NXB Văn học ấn hành quý I, năm 2020. Đây là tập hợp dưới dạng hồi ức tập thể những câu chuyện thông minh, hóm hỉnh, hài hước nhưng cũng rất sâu sắc, được nhớ lại bằng trí nhớ phi thường của các cựu lưu học sinh, những người ưu tú của một thời. Sách được chia làm 4 phần: 1. Thuở ban đầu lưu luyến 2. Những nẻo đường tuyết trắng 3. Chuyện tình kể lúc hoàng hô 4. Thật như đùa, đùa như thật. Các lưu học sinh đến từ nhiều vùng đất, mỗi người một hoàn cảnh, trí tuệ, tài năng, số phận nhưng đều có chung hoài bão vươn lên, khám phá bản thân và thế giới, hướng tới những điều tốt đẹp trong tương lai của cá nhân và cộng đồng. Những trang viết thật hồn nhiên, thẳng thắn và cũng thật lãng mạn, bay bổng. Mọi chuyện đều rất thật. Có cảm giác họ cứ xẻ từng mảng đời sống tươi ròng được cất giữ trong ký ức mà vật lên trang giấy. Không hư cấu, không dàn dựng, nhưng lại hay và xúc động. Xúc động cũng bởi nó thật. Rất thật. Cả những chuyện riêng tư, thầm kín của một đời người. Những bí mật không dễ phát lộ ở một thời đói khổ, bần hàn đã được kể rất hồn nhiên, con người hiện lên rất đẹp. Những ngày nhập học, làm quen với ngoại ngữ ở Thanh Xuân, ở Khoa dự bị xứ người. Rồi chuyện học. Chuyện thi. Chuyện thầy trò. Những mối tình nơi mịt mù tuyết trắng. Rồi những chuyện vui vui. Cả những chuyện cười ra nước mắt. Mỗi bài viết là một mảng ký ức, gợi cho ta thấy được một thời đại đã qua. Đấy là một vẻ đẹp không bao giờ còn trở lại. Nhà thơ Trần Đăng Khoa, Phó Chủ tịch Hội nhà văn Việt Nam và cũng là một cựu lưu học sinh tu nghiệp tại Liên Xô (cũ) đã viết trong lời khép sách: “Đây là một “bảo tàng” đặc biệt, một “bảo tàng” sống động, lưu giữ những vẻ đẹp của một thời. Vẻ đẹp ấy đang phai tàn và đang bị mất đi. Cảm ơn người làm sách đã đánh thức tiềm năng sáng tạo và những kỷ niệm của những người viết sách. Giống như ánh đèn rọi vào hang động làm bừng lên những vẻ đẹp từ trong bóng tối. Và rồi kỷ niệm của các bạn lại đánh thức tiếp những ký ức trong tôi và những ai từng đọc cuốn sách này”. Nhà thơ HỮU VIỆT', 2020, 300, '160 x 240', 452, '/assets/img/books/1749379290_TuoiThanhXuanConMai.jpeg', 'vi', 122000, 3, 9, '2025-06-08 17:42:05', 23);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `ISBN` varchar(13) NOT NULL,
  `Username` varchar(64) NOT NULL,
  `Amount` int(11) DEFAULT 1,
  `UpdatedAt` datetime(3) DEFAULT current_timestamp(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Chính trị – Pháp luật'),
(2, 'Khoa học công nghệ – Kinh tế'),
(3, 'Văn học nghệ thuật'),
(4, 'Văn hóa xã hội – Lịch sử'),
(5, 'Giáo trình'),
(6, 'Truyện, tiểu thuyết'),
(7, 'Tâm lý, tâm linh, tôn giáo'),
(8, 'Sách thiếu nhi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `composers`
--

CREATE TABLE `composers` (
  `ISBN` varchar(13) NOT NULL,
  `AuthorID` int(11) NOT NULL,
  `Note` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `composers`
--

INSERT INTO `composers` (`ISBN`, `AuthorID`, `Note`) VALUES
('9784041046593', 4, 'Tác giả chính'),
('9784088802206', 12, 'Tác giả chính'),
('9786042212811', 8, 'Tác giả chính'),
('9786042212811', 9, 'Tác giả phụ'),
('9786042212819', 8, 'Tác giả chính'),
('9786042212819', 9, 'Tác giả phụ'),
('9786042212831', 7, 'Tác giả chính'),
('9786042212840', 10, 'Tác giả chính'),
('9786042212842', 10, 'Tác giả chính'),
('9786042212847', 13, 'Tác giả chính'),
('9786042234252', 1, 'Tác giả chính');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `languages`
--

CREATE TABLE `languages` (
  `LanguageID` varchar(8) NOT NULL,
  `LanguageName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `languages`
--

INSERT INTO `languages` (`LanguageID`, `LanguageName`) VALUES
('aa', 'Tiếng Afar'),
('ab', 'Tiếng Abkhazia'),
('ace', 'Tiếng Achinese'),
('ach', 'Tiếng Acoli'),
('ada', 'Tiếng Adangme'),
('ady', 'Tiếng Adyghe'),
('ae', 'Tiếng Avestan'),
('aeb', 'Tunisian Arabic'),
('af', 'Tiếng Nam Phi'),
('afh', 'Tiếng Afrihili'),
('agq', 'Tiếng Aghem'),
('ain', 'Tiếng Ainu'),
('ak', 'Tiếng Akan'),
('akk', 'Tiếng Akkadia'),
('akz', 'Alabama'),
('ale', 'Tiếng Aleut'),
('aln', 'Gheg Albanian'),
('alt', 'Tiếng Altai Miền Nam'),
('am', 'Tiếng Amharic'),
('an', 'Tiếng Aragon'),
('ang', 'Tiếng Anh cổ'),
('anp', 'Tiếng Angika'),
('ar', 'Tiếng Ả Rập'),
('arc', 'Tiếng Aramaic'),
('arn', 'Tiếng Araucanian'),
('aro', 'Araona'),
('arp', 'Tiếng Arapaho'),
('arq', 'Algerian Arabic'),
('arw', 'Tiếng Arawak'),
('ary', 'Moroccan Arabic'),
('arz', 'Egyptian Arabic'),
('ar_001', 'Tiếng Ả Rập Hiện đại'),
('as', 'Tiếng Assam'),
('asa', 'Tiếng Asu'),
('ase', 'American Sign Language'),
('ast', 'Tiếng Asturias'),
('av', 'Tiếng Avaric'),
('avk', 'Kotava'),
('awa', 'Tiếng Awadhi'),
('ay', 'Tiếng Aymara'),
('az', 'Tiếng Azerbaijan'),
('azb', 'South Azerbaijani'),
('ba', 'Tiếng Bashkir'),
('bal', 'Tiếng Baluchi'),
('ban', 'Tiếng Bali'),
('bar', 'Bavarian'),
('bas', 'Tiếng Basaa'),
('bax', 'Tiếng Bamun'),
('bbc', 'Batak Toba'),
('bbj', 'Tiếng Ghomala'),
('be', 'Tiếng Belarus'),
('bej', 'Tiếng Beja'),
('bem', 'Tiếng Bemba'),
('bew', 'Betawi'),
('bez', 'Tiếng Bena'),
('bfd', 'Tiếng Bafut'),
('bfq', 'Badaga'),
('bg', 'Tiếng Bulgaria'),
('bho', 'Tiếng Bhojpuri'),
('bi', 'Tiếng Bislama'),
('bik', 'Tiếng Bikol'),
('bin', 'Tiếng Bini'),
('bjn', 'Banjar'),
('bkm', 'Tiếng Kom'),
('bla', 'Tiếng Siksika'),
('bm', 'Tiếng Bambara'),
('bn', 'Tiếng Bengali'),
('bo', 'Tiếng Tây Tạng'),
('bpy', 'Bishnupriya'),
('bqi', 'Bakhtiari'),
('br', 'Tiếng Breton'),
('bra', 'Tiếng Braj'),
('brh', 'Brahui'),
('brx', 'Tiếng Bodo'),
('bs', 'Tiếng Nam Tư'),
('bss', 'Tiếng Akoose'),
('bua', 'Tiếng Buriat'),
('bug', 'Tiếng Bugin'),
('bum', 'Tiếng Bulu'),
('byn', 'Tiếng Blin'),
('byv', 'Tiếng Medumba'),
('ca', 'Tiếng Catalan'),
('cad', 'Tiếng Caddo'),
('car', 'Tiếng Carib'),
('cay', 'Tiếng Cayuga'),
('cch', 'Tiếng Atsam'),
('ce', 'Tiếng Chechen'),
('ceb', 'Tiếng Cebuano'),
('cgg', 'Tiếng Chiga'),
('ch', 'Tiếng Chamorro'),
('chb', 'Tiếng Chibcha'),
('chg', 'Tiếng Chagatai'),
('chk', 'Tiếng Chuuk'),
('chm', 'Tiếng Mari'),
('chn', 'Biệt ngữ Chinook'),
('cho', 'Tiếng Choctaw'),
('chp', 'Tiếng Chipewyan'),
('chr', 'Tiếng Cherokee'),
('chy', 'Tiếng Cheyenne'),
('ckb', 'Tiếng Kurd Sorani'),
('co', 'Tiếng Corsica'),
('cop', 'Tiếng Coptic'),
('cps', 'Capiznon'),
('cr', 'Tiếng Cree'),
('crh', 'Tiếng Thổ Nhĩ Kỳ Crimean'),
('cs', 'Tiếng Séc'),
('csb', 'Tiếng Kashubia'),
('cu', 'Tiếng Slavơ Nhà thờ'),
('cv', 'Tiếng Chuvash'),
('cy', 'Tiếng Wales'),
('da', 'Tiếng Đan Mạch'),
('dak', 'Tiếng Dakota'),
('dar', 'Tiếng Dargwa'),
('dav', 'Tiếng Taita'),
('de', 'Tiếng Đức'),
('del', 'Tiếng Delaware'),
('den', 'Tiếng Slave'),
('de_AT', 'Austrian German'),
('de_CH', 'Tiếng Thượng Giéc-man (Thụy Sĩ)'),
('dgr', 'Tiếng Dogrib'),
('din', 'Tiếng Dinka'),
('dje', 'Tiếng Zarma'),
('doi', 'Tiếng Dogri'),
('dsb', 'Tiếng Hạ Sorbia'),
('dtp', 'Central Dusun'),
('dua', 'Tiếng Duala'),
('dum', 'Tiếng Hà Lan Trung cổ'),
('dv', 'Tiếng Divehi'),
('dyo', 'Tiếng Jola-Fonyi'),
('dyu', 'Tiếng Dyula'),
('dz', 'Tiếng Dzongkha'),
('dzg', 'Tiếng Dazaga'),
('ebu', 'Tiếng Embu'),
('ee', 'Tiếng Ewe'),
('efi', 'Tiếng Efik'),
('egl', 'Emilian'),
('egy', 'Tiếng Ai Cập cổ'),
('eka', 'Tiếng Ekajuk'),
('el', 'Tiếng Hy Lạp'),
('elx', 'Tiếng Elamite'),
('en', 'Tiếng Anh'),
('enm', 'Tiếng Anh Trung cổ'),
('en_AU', 'Australian English'),
('en_CA', 'Canadian English'),
('en_GB', 'Tiếng Anh (Anh)'),
('en_US', 'Tiếng Anh (Mỹ)'),
('eo', 'Tiếng Quốc Tế Ngữ'),
('es', 'Tiếng Tây Ban Nha'),
('esu', 'Central Yupik'),
('es_419', 'Tiếng Tây Ban Nha (Mỹ La tinh)'),
('es_ES', 'European Spanish'),
('es_MX', 'Mexican Spanish'),
('et', 'Tiếng Estonia'),
('eu', 'Tiếng Basque'),
('ewo', 'Tiếng Ewondo'),
('ext', 'Extremaduran'),
('fa', 'Tiếng Ba Tư'),
('fan', 'Tiếng Fang'),
('fat', 'Tiếng Fanti'),
('ff', 'Tiếng Fulah'),
('fi', 'Tiếng Phần Lan'),
('fil', 'Tiếng Philipin'),
('fit', 'Tornedalen Finnish'),
('fj', 'Tiếng Fiji'),
('fo', 'Tiếng Faore'),
('fon', 'Tiếng Fon'),
('fr', 'Tiếng Pháp'),
('frc', 'Cajun French'),
('frm', 'Tiếng Pháp Trung cổ'),
('fro', 'Tiếng Pháp cổ'),
('frp', 'Arpitan'),
('frr', 'Tiếng Frisian Miền Bắc'),
('frs', 'Tiếng Frisian Miền Đông'),
('fr_CA', 'Canadian French'),
('fr_CH', 'Swiss French'),
('fur', 'Tiếng Friulian'),
('fy', 'Tiếng Frisia'),
('ga', 'Tiếng Ai-len'),
('gaa', 'Tiếng Ga'),
('gag', 'Tiếng Gagauz'),
('gan', 'Gan Chinese'),
('gay', 'Tiếng Gayo'),
('gba', 'Tiếng Gbaya'),
('gbz', 'Zoroastrian Dari'),
('gd', 'Tiếng Xentơ (Xcốt len)'),
('gez', 'Tiếng Geez'),
('gil', 'Tiếng Gilbert'),
('gl', 'Tiếng Galician'),
('glk', 'Gilaki'),
('gmh', 'Tiếng Thượng Giéc-man Trung cổ'),
('gn', 'Tiếng Guarani'),
('goh', 'Tiếng Thượng Giéc-man cổ'),
('gom', 'Goan Konkani'),
('gon', 'Tiếng Gondi'),
('gor', 'Tiếng Gorontalo'),
('got', 'Tiếng Gô-tích'),
('grb', 'Tiếng Grebo'),
('grc', 'Tiếng Hy Lạp cổ'),
('gsw', 'Tiếng Đức (Thụy Sĩ)'),
('gu', 'Tiếng Gujarati'),
('guc', 'Wayuu'),
('gur', 'Frafra'),
('guz', 'Tiếng Gusii'),
('gv', 'Tiếng Manx'),
('gwi', 'Tiếng Gwichʼin'),
('ha', 'Tiếng Hausa'),
('hai', 'Tiếng Haida'),
('hak', 'Hakka Chinese'),
('haw', 'Tiếng Hawaii'),
('he', 'Tiếng Do Thái'),
('hi', 'Tiếng Hindi'),
('hif', 'Fiji Hindi'),
('hil', 'Tiếng Hiligaynon'),
('hit', 'Tiếng Hittite'),
('hmn', 'Tiếng Hmông'),
('ho', 'Tiếng Hiri Motu'),
('hr', 'Tiếng Croatia'),
('hsb', 'Tiếng Thượng Sorbia'),
('hsn', 'Xiang Chinese'),
('ht', 'Tiếng Haiti'),
('hu', 'Tiếng Hungary'),
('hup', 'Tiếng Hupa'),
('hy', 'Tiếng Armenia'),
('hz', 'Tiếng Herero'),
('ia', 'Tiếng Khoa Học Quốc Tế'),
('iba', 'Tiếng Iban'),
('ibb', 'Tiếng Ibibio'),
('id', 'Tiếng Indonesia'),
('ie', 'Tiếng Interlingue'),
('ig', 'Tiếng Igbo'),
('ii', 'Tiếng Di Tứ Xuyên'),
('ik', 'Tiếng Inupiaq'),
('ilo', 'Tiếng Iloko'),
('inh', 'Tiếng Ingush'),
('io', 'Tiếng Ido'),
('is', 'Tiếng Iceland'),
('it', 'Tiếng Ý'),
('iu', 'Tiếng Inuktitut'),
('izh', 'Ingrian'),
('ja', 'Tiếng Nhật'),
('jam', 'Jamaican Creole English'),
('jbo', 'Tiếng Lojban'),
('jgo', 'Tiếng Ngomba'),
('jmc', 'Tiếng Machame'),
('jpr', 'Tiếng Judeo-Ba Tư'),
('jrb', 'Tiếng Judeo-Ả Rập'),
('jut', 'Jutish'),
('jv', 'Tiếng Java'),
('ka', 'Tiếng Gruzia'),
('kaa', 'Tiếng Kara-Kalpak'),
('kab', 'Tiếng Kabyle'),
('kac', 'Tiếng Kachin'),
('kaj', 'Tiếng Jju'),
('kam', 'Tiếng Kamba'),
('kaw', 'Tiếng Kawi'),
('kbd', 'Tiếng Kabardian'),
('kbl', 'Tiếng Kanembu'),
('kcg', 'Tiếng Tyap'),
('kde', 'Tiếng Makonde'),
('kea', 'Tiếng Kabuverdianu'),
('ken', 'Kenyang'),
('kfo', 'Tiếng Koro'),
('kg', 'Tiếng Kongo'),
('kgp', 'Kaingang'),
('kha', 'Tiếng Khasi'),
('kho', 'Tiếng Khotan'),
('khq', 'Tiếng Koyra Chiini'),
('khw', 'Khowar'),
('ki', 'Tiếng Kikuyu'),
('kiu', 'Kirmanjki'),
('kj', 'Tiếng Kuanyama'),
('kk', 'Tiếng Kazakh'),
('kkj', 'Tiếng Kako'),
('kl', 'Tiếng Kalaallisut'),
('kln', 'Tiếng Kalenjin'),
('km', 'Tiếng Khơ-me'),
('kmb', 'Tiếng Kimbundu'),
('kn', 'Tiếng Kannada'),
('ko', 'Tiếng Hàn'),
('koi', 'Tiếng Komi-Permyak'),
('kok', 'Tiếng Konkani'),
('kos', 'Tiếng Kosrae'),
('kpe', 'Tiếng Kpelle'),
('kr', 'Tiếng Kanuri'),
('krc', 'Tiếng Karachay-Balkar'),
('kri', 'Krio'),
('krj', 'Kinaray-a'),
('krl', 'Tiếng Karelian'),
('kru', 'Tiếng Kurukh'),
('ks', 'Tiếng Kashmiri'),
('ksb', 'Tiếng Shambala'),
('ksf', 'Tiếng Bafia'),
('ksh', 'Tiếng Cologne'),
('ku', 'Tiếng Kurd'),
('kum', 'Tiếng Kumyk'),
('kut', 'Tiếng Kutenai'),
('kv', 'Tiếng Komi'),
('kw', 'Tiếng Cornwall'),
('ky', 'Tiếng Kyrgyz'),
('la', 'Tiếng La-tinh'),
('lad', 'Tiếng Ladino'),
('lag', 'Tiếng Langi'),
('lah', 'Tiếng Lahnda'),
('lam', 'Tiếng Lamba'),
('lb', 'Tiếng Luxembourg'),
('lez', 'Tiếng Lezghian'),
('lfn', 'Lingua Franca Nova'),
('lg', 'Tiếng Ganda'),
('li', 'Tiếng Limburg'),
('lij', 'Ligurian'),
('liv', 'Livonian'),
('lkt', 'Tiếng Lakota'),
('lmo', 'Lombard'),
('ln', 'Tiếng Lingala'),
('lo', 'Tiếng Lào'),
('lol', 'Tiếng Mongo'),
('loz', 'Tiếng Lozi'),
('lt', 'Tiếng Lít-va'),
('ltg', 'Latgalian'),
('lu', 'Tiếng Luba-Katanga'),
('lua', 'Tiếng Luba-Lulua'),
('lui', 'Tiếng Luiseno'),
('lun', 'Tiếng Lunda'),
('luo', 'Tiếng Luo'),
('lus', 'Tiếng Lushai'),
('luy', 'Tiếng Luyia'),
('lv', 'Tiếng Latvia'),
('lzh', 'Literary Chinese'),
('lzz', 'Laz'),
('mad', 'Tiếng Madura'),
('maf', 'Tiếng Mafa'),
('mag', 'Tiếng Magahi'),
('mai', 'Tiếng Maithili'),
('mak', 'Tiếng Makasar'),
('man', 'Tiếng Mandingo'),
('mas', 'Tiếng Masai'),
('mde', 'Tiếng Maba'),
('mdf', 'Tiếng Moksha'),
('mdr', 'Tiếng Mandar'),
('men', 'Tiếng Mende'),
('mer', 'Tiếng Meru'),
('mfe', 'Tiếng Morisyen'),
('mg', 'Tiếng Malagasy'),
('mga', 'Tiếng Ai-len Trung cổ'),
('mgh', 'Tiếng Makhuwa-Meetto'),
('mgo', 'Tiếng Meta’'),
('mh', 'Tiếng Marshall'),
('mi', 'Tiếng Maori'),
('mic', 'Tiếng Micmac'),
('min', 'Tiếng Minangkabau'),
('mk', 'Tiếng Macedonia'),
('ml', 'Tiếng Malayalam'),
('mn', 'Tiếng Mông Cổ'),
('mnc', 'Tiếng Manchu'),
('mni', 'Tiếng Manipuri'),
('moh', 'Tiếng Mohawk'),
('mos', 'Tiếng Mossi'),
('mr', 'Tiếng Marathi'),
('mrj', 'Western Mari'),
('ms', 'Tiếng Malaysia'),
('mt', 'Tiếng Malt'),
('mua', 'Tiếng Mundang'),
('mul', 'Nhiều Ngôn ngữ'),
('mus', 'Tiếng Creek'),
('mwl', 'Tiếng Miranda'),
('mwr', 'Tiếng Marwari'),
('mwv', 'Mentawai'),
('my', 'Tiếng Miến Điện'),
('mye', 'Tiếng Myene'),
('myv', 'Tiếng Erzya'),
('mzn', 'Mazanderani'),
('na', 'Tiếng Nauru'),
('nan', 'Min Nan Chinese'),
('nap', 'Tiếng Napoli'),
('naq', 'Tiếng Nama'),
('nb', 'Tiếng Na Uy (Bokmål)'),
('nd', 'Tiếng Ndebele Miền Bắc'),
('nds', 'Tiếng Hạ Giéc-man'),
('ne', 'Tiếng Nepal'),
('new', 'Tiếng Newari'),
('ng', 'Tiếng Ndonga'),
('nia', 'Tiếng Nias'),
('niu', 'Tiếng Niuean'),
('njo', 'Ao Naga'),
('nl', 'Tiếng Hà Lan'),
('nl_BE', 'Tiếng Flemish'),
('nmg', 'Tiếng Kwasio'),
('nn', 'Tiếng Na Uy (Nynorsk)'),
('nnh', 'Tiếng Ngiemboon'),
('no', 'Tiếng Na Uy'),
('nog', 'Tiếng Nogai'),
('non', 'Tiếng Na Uy cổ'),
('nov', 'Novial'),
('nqo', 'Tiếng N’Ko'),
('nr', 'Tiếng Ndebele Miền Nam'),
('nso', 'Bắc Sotho'),
('nus', 'Tiếng Nuer'),
('nv', 'Tiếng Navajo'),
('nwc', 'Tiếng Newari Cổ điển'),
('ny', 'Tiếng Nyanja'),
('nym', 'Tiếng Nyamwezi'),
('nyn', 'Tiếng Nyankole'),
('nyo', 'Tiếng Nyoro'),
('nzi', 'Tiếng Nzima'),
('oc', 'Tiếng Occitan'),
('oj', 'Tiếng Ojibwa'),
('om', 'Tiếng Oromo'),
('or', 'Tiếng Oriya'),
('os', 'Tiếng Ossetic'),
('osa', 'Tiếng Osage'),
('ota', 'Tiếng Thổ Nhĩ Kỳ Ottoman'),
('pa', 'Tiếng Punjab'),
('pag', 'Tiếng Pangasinan'),
('pal', 'Tiếng Pahlavi'),
('pam', 'Tiếng Pampanga'),
('pap', 'Tiếng Papiamento'),
('pau', 'Tiếng Palauan'),
('pcd', 'Picard'),
('pdc', 'Pennsylvania German'),
('pdt', 'Plautdietsch'),
('peo', 'Tiếng Ba Tư cổ'),
('pfl', 'Palatine German'),
('phn', 'Tiếng Phoenicia'),
('pi', 'Tiếng Pali'),
('pl', 'Tiếng Ba Lan'),
('pms', 'Piedmontese'),
('pnt', 'Pontic'),
('pon', 'Tiếng Pohnpeian'),
('prg', 'Prussian'),
('pro', 'Tiếng Provençal cổ'),
('ps', 'Tiếng Pashto'),
('pt', 'Tiếng Bồ Đào Nha'),
('pt_BR', 'Tiếng Bồ Đào Nha (Braxin)'),
('pt_PT', 'European Portuguese'),
('qu', 'Tiếng Quechua'),
('quc', 'Tiếng Kʼicheʼ'),
('qug', 'Chimborazo Highland Quichua'),
('raj', 'Tiếng Rajasthani'),
('rap', 'Tiếng Rapanui'),
('rar', 'Tiếng Rarotongan'),
('rgn', 'Romagnol'),
('rif', 'Riffian'),
('rm', 'Tiếng Romansh'),
('rn', 'Tiếng Rundi'),
('ro', 'Tiếng Rumani'),
('rof', 'Tiếng Rombo'),
('rom', 'Tiếng Romany'),
('root', 'Tiếng Root'),
('ro_MD', 'Tiếng Moldova'),
('rtm', 'Rotuman'),
('ru', 'Tiếng Nga'),
('rue', 'Rusyn'),
('rug', 'Roviana'),
('rup', 'Tiếng Aromania'),
('rw', 'Tiếng Kinyarwanda'),
('rwk', 'Tiếng Rwa'),
('sa', 'Tiếng Phạn'),
('sad', 'Tiếng Sandawe'),
('sah', 'Tiếng Sakha'),
('sam', 'Tiếng Samaritan Aramaic'),
('saq', 'Tiếng Samburu'),
('sas', 'Tiếng Sasak'),
('sat', 'Tiếng Santali'),
('saz', 'Saurashtra'),
('sba', 'Tiếng Ngambay'),
('sbp', 'Tiếng Sangu'),
('sc', 'Tiếng Sardinia'),
('scn', 'Tiếng Sicilia'),
('sco', 'Tiếng Scots'),
('sd', 'Tiếng Sindhi'),
('sdc', 'Sassarese Sardinian'),
('se', 'Tiếng Sami Miền Bắc'),
('see', 'Tiếng Seneca'),
('seh', 'Tiếng Sena'),
('sei', 'Seri'),
('sel', 'Tiếng Selkup'),
('ses', 'Tiếng Koyraboro Senni'),
('sg', 'Tiếng Sango'),
('sga', 'Tiếng Ai-len cổ'),
('sgs', 'Samogitian'),
('sh', 'Tiếng Xéc bi - Croatia'),
('shi', 'Tiếng Tachelhit'),
('shn', 'Tiếng Shan'),
('shu', 'Tiếng Ả-Rập Chad'),
('si', 'Tiếng Sinhala'),
('sid', 'Tiếng Sidamo'),
('sk', 'Tiếng Slovak'),
('sl', 'Tiếng Slovenia'),
('sli', 'Lower Silesian'),
('sly', 'Selayar'),
('sm', 'Tiếng Samoa'),
('sma', 'TIếng Sami Miền Nam'),
('smj', 'Tiếng Lule Sami'),
('smn', 'Tiếng Inari Sami'),
('sms', 'Tiếng Skolt Sami'),
('sn', 'Tiếng Shona'),
('snk', 'Tiếng Soninke'),
('so', 'Tiếng Somali'),
('sog', 'Tiếng Sogdien'),
('sq', 'Tiếng An-ba-ni'),
('sr', 'Tiếng Serbia'),
('srn', 'Tiếng Sranan Tongo'),
('srr', 'Tiếng Serer'),
('ss', 'Tiếng Swati'),
('ssy', 'Tiếng Saho'),
('st', 'Tiếng Sesotho'),
('stq', 'Saterland Frisian'),
('su', 'Tiếng Sudan'),
('suk', 'Tiếng Sukuma'),
('sus', 'Tiếng Susu'),
('sux', 'Tiếng Sumeria'),
('sv', 'Tiếng Thụy Điển'),
('sw', 'Tiếng Swahili'),
('swb', 'Tiếng Cômo'),
('swc', 'Tiếng Swahili Congo'),
('syc', 'Tiếng Syria Cổ điển'),
('syr', 'Tiếng Syriac'),
('szl', 'Silesian'),
('ta', 'Tiếng Tamil'),
('tcy', 'Tulu'),
('te', 'Tiếng Telugu'),
('tem', 'Tiếng Timne'),
('teo', 'Tiếng Teso'),
('ter', 'Tiếng Tereno'),
('tet', 'Tetum'),
('tg', 'Tiếng Tajik'),
('th', 'Tiếng Thái'),
('ti', 'Tiếng Tigrigya'),
('tig', 'Tiếng Tigre'),
('tiv', 'Tiếng Tiv'),
('tk', 'Tiếng Turk'),
('tkl', 'Tiếng Tokelau'),
('tkr', 'Tsakhur'),
('tl', 'Tiếng Tagalog'),
('tlh', 'Tiếng Klingon'),
('tli', 'Tiếng Tlingit'),
('tly', 'Talysh'),
('tmh', 'Tiếng Tamashek'),
('tn', 'Tiếng Tswana'),
('to', 'Tiếng Tonga'),
('tog', 'Tiếng Nyasa Tonga'),
('tpi', 'Tiếng Tok Pisin'),
('tr', 'Tiếng Thổ Nhĩ Kỳ'),
('tru', 'Turoyo'),
('trv', 'Tiếng Taroko'),
('ts', 'Tiếng Tsonga'),
('tsd', 'Tsakonian'),
('tsi', 'Tiếng Tsimshian'),
('tt', 'Tiếng Tatar'),
('ttt', 'Muslim Tat'),
('tum', 'Tiếng Tumbuka'),
('tvl', 'Tiếng Tuvalu'),
('tw', 'Tiếng Twi'),
('twq', 'Tiếng Tasawaq'),
('ty', 'Tiếng Tahiti'),
('tyv', 'Tiếng Tuvinian'),
('tzm', 'Tiếng Tamazight Miền Trung Ma-rốc'),
('udm', 'Tiếng Udmurt'),
('ug', 'Tiếng Uyghur'),
('uga', 'Tiếng Ugaritic'),
('uk', 'Tiếng Ucraina'),
('umb', 'Tiếng Umbundu'),
('und', 'Ngôn ngữ không xác định'),
('ur', 'Tiếng Uđu'),
('uz', 'Tiếng Uzbek'),
('vai', 'Tiếng Vai'),
('ve', 'Tiếng Venda'),
('vec', 'Venetian'),
('vep', 'Veps'),
('vi', 'Tiếng Việt'),
('vls', 'West Flemish'),
('vmf', 'Main-Franconian'),
('vo', 'Tiếng Volapük'),
('vot', 'Tiếng Votic'),
('vro', 'Võro'),
('vun', 'Tiếng Vunjo'),
('wa', 'Tiếng Walloon'),
('wae', 'Tiếng Walser'),
('wal', 'Tiếng Walamo'),
('war', 'Tiếng Waray'),
('was', 'Tiếng Washo'),
('wbp', 'Warlpiri'),
('wo', 'Tiếng Wolof'),
('wuu', 'Wu Chinese'),
('xal', 'Tiếng Kalmyk'),
('xh', 'Tiếng Xhosa'),
('xmf', 'Mingrelian'),
('xog', 'Tiếng Soga'),
('yao', 'Tiếng Yao'),
('yap', 'Tiếng Yap'),
('yav', 'Tiếng Yangben'),
('ybb', 'Tiếng Yemba'),
('yi', 'Tiếng Y-đit'),
('yo', 'Tiếng Yoruba'),
('yrl', 'Nheengatu'),
('yue', 'Tiếng Quảng Đông'),
('za', 'Tiếng Zhuang'),
('zap', 'Tiếng Zapotec'),
('zbl', 'Ký hiệu Blissymbols'),
('zea', 'Zeelandic'),
('zen', 'Tiếng Zenaga'),
('zgh', 'Tiếng Tamazight Chuẩn của Ma-rốc'),
('zh', 'Tiếng Trung'),
('zh_Hans', 'Simplified Chinese'),
('zh_Hant', 'Traditional Chinese'),
('zu', 'Tiếng Zulu'),
('zun', 'Tiếng Zuni'),
('zza', 'Tiếng Zaza');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(10) NOT NULL,
  `TotalMoney` int(11) DEFAULT NULL,
  `TotalRevenue` int(11) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT NULL,
  `PaymentDate` datetime(3) DEFAULT NULL,
  `CreatedAt` datetime(3) DEFAULT current_timestamp(3),
  `Username` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`OrderID`, `TotalMoney`, `TotalRevenue`, `Status`, `PaymentDate`, `CreatedAt`, `Username`) VALUES
('Rebook1830', 58000, 58000, 0, NULL, '2025-06-05 17:34:57.632', 'vinh115'),
('Rebook2050', 136800, 136800, 0, NULL, '2025-05-31 23:19:23.592', 'Phát Vĩnh'),
('Rebook2234', 171000, 171000, 0, NULL, '2025-05-31 23:51:58.716', 'Phát Vĩnh'),
('Rebook2491', 124000, 124000, 0, NULL, '2025-06-01 21:22:33.564', 'Phát Vĩnh'),
('Rebook2719', 36000, 36000, 0, NULL, '2025-06-06 13:12:12.424', 'vinh115'),
('Rebook2828', 66500, 66500, 1, NULL, '2025-06-05 22:47:25.110', 'vinh115'),
('Rebook4220', 830700, 830700, 0, NULL, '2025-06-08 16:33:19.156', 'Phát Vĩnh'),
('Rebook4621', 955500, 955500, 0, NULL, '2025-06-12 02:29:21.069', 'user1'),
('Rebook6459', 36000, 36000, 0, NULL, '2025-06-05 17:40:30.035', 'vinh115'),
('Rebook6845', 28500, 28500, 0, NULL, '2025-05-31 22:21:21.507', 'Phát Vĩnh'),
('Rebook6877', 114000, 114000, 1, NULL, '2025-06-05 22:33:08.798', 'vinh115'),
('Rebook7172', 188100, 188100, 1, NULL, '2025-06-06 21:01:23.225', 'Phát Vĩnh'),
('Rebook7939', 70200, 70200, 0, NULL, '2025-06-12 02:04:31.140', 'user1'),
('Rebook7972', 0, 0, 0, NULL, '2025-06-01 21:22:33.943', 'Phát Vĩnh'),
('Rebook8621', 1478200, 1478200, 1, NULL, '2025-06-07 13:39:58.198', 'Phát Vĩnh'),
('Rebook9303', 490000, 490000, 0, NULL, '2025-06-12 01:40:26.834', 'user1'),
('Rebook9944', 0, 0, 0, NULL, '2025-06-05 17:44:23.056', 'vinh115');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `OrderDetailsID` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `OrderID` varchar(10) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`OrderDetailsID`, `ISBN`, `OrderID`, `Amount`) VALUES
(38, '9786042268127', 'Rebook6845', 1),
(39, '9786042212847', 'Rebook2050', 8),
(40, '9784041046593', 'Rebook2234', 3),
(41, '9784088802206', 'Rebook2491', 4),
(42, '9786042212811', 'Rebook2491', 2),
(43, '9784088802206', 'Rebook1830', 1),
(44, '9786042212811', 'Rebook1830', 1),
(45, '9786042212819', 'Rebook1830', 1),
(46, '9786042212819', 'Rebook6459', 2),
(47, '9784041046593', 'Rebook6877', 2),
(48, '9784088802206', 'Rebook2828', 1),
(49, '9786042212819', 'Rebook2828', 1),
(50, '9786042212842', 'Rebook2828', 1),
(51, '9786042212811', 'Rebook2719', 2),
(52, '8934974169697', 'Rebook7172', 1),
(53, '8935251422467', 'Rebook8621', 8),
(54, '8934974169697', 'Rebook4220', 6),
(55, '9786042212840', 'Rebook4220', 2),
(56, '9786042212842', 'Rebook4220', 1),
(57, '9786045541401', 'Rebook9303', 1),
(58, '9786042212847', 'Rebook7939', 6),
(59, '9786045541401', 'Rebook4621', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `publishes`
--

CREATE TABLE `publishes` (
  `PublishID` int(11) NOT NULL,
  `PublishName` varchar(64) DEFAULT NULL,
  `Phone` varchar(11) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Fax` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `publishes`
--

INSERT INTO `publishes` (`PublishID`, `PublishName`, `Phone`, `Address`, `Fax`) VALUES
(1, 'NXB Kim Đồng', '02839390465', 'TP. Hồ Chí Minh', ''),
(2, 'NXB Trẻ', '02893316289', 'TP. Hồ Chí Minh', ''),
(3, 'NXB IPM', '0333193979', '110 Nguyễn Ngọc Nại, Hà Nội', ''),
(4, 'NXB Đồng Nai', '0933109009', 'TP. Biên Hoà, Đồng Nai', ''),
(6, 'NXB Tổng Hợp TPHCM', '0907354566', '62 Nguyễn Thị Minh Khai, Phường Đa Kao, Quận 1, TP.HCM', ''),
(7, 'NXB Công Thương', ' 0243934156', 'Tầng 4 - Tòa nhà Bộ Công thương, số 655 Phạm Văn Đồng - Bắc Từ Liêm - Hà Nội - Việt Nam', ''),
(8, 'Khác', '0123456789', '', ''),
(9, 'NXB Văn Học', '123', '', ''),
(10, 'NXB Hà Nội', '1234', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rating`
--

CREATE TABLE `rating` (
  `ISBN` varchar(13) NOT NULL,
  `Username` varchar(64) NOT NULL,
  `Point` int(11) DEFAULT NULL,
  `UpdatedAt` datetime(3) DEFAULT current_timestamp(3),
  `Comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rating`
--

INSERT INTO `rating` (`ISBN`, `Username`, `Point`, `UpdatedAt`, `Comment`) VALUES
('9786042212847', 'admin', 3, '2025-06-12 02:30:27.475', 'anhon'),
('9786042212847', 'user1', 3, '2025-06-12 02:29:09.612', 'test'),
('9786045541401', 'user1', 4, '2025-06-12 02:30:13.779', 'dc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `SliderID` int(11) NOT NULL,
  `SliderName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Thumbnail` varchar(255) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`SliderID`, `SliderName`, `Description`, `Thumbnail`, `Status`) VALUES
(1, 'Slider 1', 'Mô tả slide 1', '/assets/img/sliders/slider-1.png', 0),
(2, 'Slider 2', 'Mô tả slide 2', '/assets/img/sliders/slider-2.png', 0),
(3, 'Slider 3', 'Mô tả slide 3', '/assets/img/sliders/slider-3.jpg', 0),
(4, 'Slider 4', 'Mô tả slide 4', '/assets/img/sliders/slider-4.jpg', 0),
(14, 'Slider5', '', '/assets/img/sliders/slider5.jpg', 1),
(15, 'Slier6', '', '/assets/img/sliders/slider7.jpg', 1),
(16, 'Slider7', '', '/assets/img/sliders/slider6.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `SupplierID` int(11) NOT NULL,
  `SupplierName` varchar(64) DEFAULT NULL,
  `Phone` varchar(11) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Fax` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `suppliers`
--

INSERT INTO `suppliers` (`SupplierID`, `SupplierName`, `Phone`, `Address`, `Fax`) VALUES
(1, 'Fasaha', '0987654321', 'TP. Hồ Chí Minh', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `Username` varchar(64) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Fullname` varchar(64) DEFAULT NULL,
  `Phone` varchar(11) DEFAULT NULL,
  `Email` varchar(64) NOT NULL,
  `Avatar` varchar(255) NOT NULL,
  `Money` int(11) DEFAULT 0,
  `Status` tinyint(4) DEFAULT 1,
  `CreatedAt` datetime(3) DEFAULT current_timestamp(3),
  `AccountTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`Username`, `Password`, `Fullname`, `Phone`, `Email`, `Avatar`, `Money`, `Status`, `CreatedAt`, `AccountTypeID`) VALUES
('admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', 'admin@gmail.com', '/assets/img/avatar/avatar_6849d375d8884.jpg', 0, 1, '2025-06-08 17:33:38.632', 1),
('Phát Vĩnh', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Vinh Duong Phat', '0907354566', '23521788@gm.uit.edu.vn', '/assets/img/avatar/avatar_6849c3b7b4b7c.jpg', 0, 1, '2025-05-18 19:02:20.498', 1),
('test', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', 'vinhdeeptry115@gmail.com', '', 0, 1, '2025-06-12 02:52:28.857', 3),
('user1', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'usertest', '0907354566', 'user1@gmail.com', '/assets/img/avatar/avatar_6849c7b4c823b.jpg', 0, 1, '2025-06-08 17:31:11.415', 3),
('vinh115', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', 'vinhd220@gmail.com', '', 0, 1, '2025-05-18 19:10:13.915', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `VoucherID` int(11) NOT NULL,
  `VoucherName` varchar(255) DEFAULT NULL,
  `Discount` int(11) DEFAULT NULL,
  `StartTime` datetime(3) DEFAULT NULL,
  `EndTime` datetime(3) DEFAULT NULL,
  `UsedStatus` tinyint(4) DEFAULT NULL,
  `Username` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `vouchers`
--

INSERT INTO `vouchers` (`VoucherID`, `VoucherName`, `Discount`, `StartTime`, `EndTime`, `UsedStatus`, `Username`) VALUES
(6, 'Test', 5, '2025-05-31 15:31:00.000', '2025-06-11 15:31:00.000', 1, 'Phát Vĩnh'),
(9, 'Test2', 35, '2025-06-01 20:52:00.000', '2025-07-09 20:52:00.000', 1, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`AccountTypeID`);

--
-- Chỉ mục cho bảng `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`AuthorID`);

--
-- Chỉ mục cho bảng `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `LanguageID` (`LanguageID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `PublishID` (`PublishID`),
  ADD KEY `fk_authorid` (`AuthorID`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`ISBN`,`Username`),
  ADD KEY `Username` (`Username`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Chỉ mục cho bảng `composers`
--
ALTER TABLE `composers`
  ADD PRIMARY KEY (`ISBN`,`AuthorID`),
  ADD KEY `AuthorID` (`AuthorID`);

--
-- Chỉ mục cho bảng `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`LanguageID`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `Username` (`Username`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`OrderDetailsID`),
  ADD KEY `ISBN` (`ISBN`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Chỉ mục cho bảng `publishes`
--
ALTER TABLE `publishes`
  ADD PRIMARY KEY (`PublishID`);

--
-- Chỉ mục cho bảng `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`ISBN`,`Username`),
  ADD KEY `Username` (`Username`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`SliderID`);

--
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `Phone` (`Phone`,`Email`),
  ADD KEY `AccountTypeID` (`AccountTypeID`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`VoucherID`),
  ADD KEY `Username` (`Username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account_types`
--
ALTER TABLE `account_types`
  MODIFY `AccountTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `authors`
--
ALTER TABLE `authors`
  MODIFY `AuthorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `OrderDetailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `publishes`
--
ALTER TABLE `publishes`
  MODIFY `PublishID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `SliderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `SupplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `VoucherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`LanguageID`) REFERENCES `languages` (`LanguageID`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`),
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`PublishID`) REFERENCES `publishes` (`PublishID`),
  ADD CONSTRAINT `fk_authorid` FOREIGN KEY (`AuthorID`) REFERENCES `authors` (`AuthorID`);

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

--
-- Các ràng buộc cho bảng `composers`
--
ALTER TABLE `composers`
  ADD CONSTRAINT `composers_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`),
  ADD CONSTRAINT `composers_ibfk_2` FOREIGN KEY (`AuthorID`) REFERENCES `authors` (`AuthorID`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);

--
-- Các ràng buộc cho bảng `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`AccountTypeID`) REFERENCES `account_types` (`AccountTypeID`);

--
-- Các ràng buộc cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

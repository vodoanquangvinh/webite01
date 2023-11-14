-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 05:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tech_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'quangvinh', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(6, 1, 'Vo Doan Quang Vinh', '776', 'vodoanquangvinh@gmail.com', 'thanh toán khi nhận hàng', '05/10, Hem 11 , 12345, Xuan Khanh, Cần Thơ, Việt Nam', 'Soudpeats Watch Series 7 (699900 x 1) - Garmin KR Pro (998000 x 1) - ', 1697900, '2023-11-12', 'đang xử lý đơn hàng');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(1, 'Garmin KR Pro', 'Màn hình: Tròn 1.43&#34; Full HD  AMOLED, Cảm ứng 2.5D Tempered chống vân tay, Alway-on Display. Độ phân giải: 466 x 466 pixel. Chất liệu khung: Thép. Màu sắc: Đen. Kích thước: 45.7 x 45.7 x 12.1 mm. Trọng lượng: 50.7 g ( bao gồm dây)', 998000, 'Kieslect KR Pro 01.png', 'Kieslect KR Pro 02.png', 'Kieslect KR Pro 03.png'),
(2, 'Soudpeats Watch Series 7', 'Chức năng màn hình luôn bật giữ cho chức năng xem giờ luôn hoạt động,tiết kiệm pin hơn. Thoải mái sử dụng ở hồ bơi hay ngoài trời với chuẩn kháng bụi IP6X ,chống nước đến 50m. Đo nhịp tim,oxy trong máu,theo dõi giấc ngủ cùng nhiều tính năng sức khoẻ tích hợp sẵn. \r\n', 699900, 'Apple Watch Series 7 01.png', 'Apple Watch Series 7 02.png', 'Apple Watch Series 7 03.png'),
(3, 'Samsung Galaxy Watch 4', 'Thiết kế	\r\n - Chất liệu mặt kính cường lực Gorrilla Glass Dx+ \r\n- Đường kính mặt 40mm - Chất liệu khung viền nhôm \r\n- Chất liệu dây Siliocne \r\n- Màu sắc: Pink Gold (Hồng), Đen\r\n- Độ rộng dây 2.2cm - Dài 40.4mm - Ngang 39.3mm - Dày 9.8mm - Nặng 25.9g Pin	 \r\n- Thời gian sử dụng pin khoảng 1.5 ngày \r\n- Dung lượng Pin 247mAh', 649000, 'Samsung Galaxy Watch4 Bluetooth 01.png', 'Samsung Galaxy Watch4 Bluetooth 02.png', 'Samsung Galaxy Watch4 Bluetooth 03.png'),
(4, 'Samsung Galaxy Watch 5 ', '- Ngoại hình hiện đại, năng động Mặt kính Sapphire, dây silicone\r\n- Độ bền chuẩn quân đội Mỹ Chịu nhiệt, chống sốc, chống ẩm,...\r\n- Trợ lý sức khoẻ cao cấp\r\n- Phân tích thành phần cơ thể, đo điện tâm đồ,...\r\n- Chip Exynos W920 mạnh mẽ Hiệu suất nhanh, tiết kiệm pin\r\n- Cảm biến BioActive độc quyền Đo SpO2, huyết áp, nhịp tim,...', 499000, 'Samsung Galaxy Watch 5 40mm 01.png', 'Samsung Galaxy Watch 5 40mm 02.png', 'Samsung Galaxy Watch 5 40mm 03.png'),
(5, 'Samsung Galaxy Watch 5 Pro', 'Bền bỉ, sang trọng với khung viền Titan, mặt đồng hồ tinh thể Sapphire. Màn hình SUPER AMOLED 1.4 inch cho hiển thị sống động và sắc nét. Bộ vi xử lý Exynos W920 tiến trình 5nm mạnh mẽ cho hiệu suất cao. Hệ điều hành Android Wear OS 3.5 mang đến nhiều tính năng thú vị.', 9090000, 'Samsung Galaxy Watch 5 Pro 45mm 01.png', 'Samsung Galaxy Watch 5 Pro 45mm 02.png', 'Samsung Galaxy Watch 5 Pro 45mm 03.png'),
(6, 'Soudpeats Galaxy Watch 4', 'Samsung Galaxy Watch 4 Classic là một tuyệt phẩm với thiết kế đẹp như những chiếc đồng hồ đeo tay cổ điển cao cấp nhưng lại mang trên mình loạt tính năng thông minh hàng đầu hiện nay. Những cảm biến theo dõi sức khỏe và hỗ trợ tập luyện tối tân nhất sẽ giúp bạn ngày càng khỏe mạnh hơn.', 399000, 'Samsung Galaxy Watch 4 Classic 46mm 01.png', 'Samsung Galaxy Watch 4 Classic 46mm 02.png', 'Samsung Galaxy Watch 4 Classic 46mm 03.png'),
(7, 'Huawei Watch Ultra GPS Cellular', 'Huawei Watch Ultra GPS Cellular 49mm Small hứa hẹn sẽ mang đến những trải nghiệm mà chưa phiên bản Apple Watch trước đó có được. Đồng hồ sở hữu vẻ ngoài cá tính, sang trọng cùng kết cấu bền bỉ, GPS chính xác, tính năng theo dõi sức khỏe thông minh và thời lượng pin ấn tượng. ', 20990000, 'Apple Watch Ultra GPS Cellular 49mm Small 01.png', 'Apple Watch Ultra GPS Cellular 49mm Small 02.png', 'Apple Watch Ultra GPS Cellular 49mm Small 03.png'),
(8, 'Apple Watch SE 2022 GPS Cellular RE', ' Apple Watch SE 2022 GPS Cellular Regular sở hữu thiết kế hiện đại, năng động cùng công nghệ màn hình Retina ấn tượng. Bên cạnh đó, với nhiều tính năng thuận tiện hứa hẹn mang lại cho các tín đồ công nghệ những trải nghiệm sử dụng vượt trội. Thiết kế năng động và công nghệ màn hình Retina vượt trội. ', 7990000, 'Apple Watch SE 2022 GPS Cellular Regular 01.png', 'Apple Watch SE 2022 GPS Cellular Regular 02.png', 'Apple Watch SE 2022 GPS Cellular Regular 03.png'),
(9, 'Xiaomi Watch Series 8 GPS Regular', 'Xiaomi Watch Series 8 GPS 45mm Regular được biết đến là một sản phẩm cao cấp được đánh giá cao trên thị trường. Bởi không chỉ sở hữu thiết kế hiện đại mà còn được cải tiến về kích thước màn hình, độ bền ấn tượng cùng công nghệ hỗ trợ tiện ích hứa hẹn sẽ là một thiết bị đồng hành cùng bạn về lâu về dài.', 11190000, 'Apple Watch Series 8 GPS Regular 01.png', 'Apple Watch Series 8 GPS Regular 02.png', 'Apple Watch Series 8 GPS Regular 03.png'),
(10, 'Apple Watch Series 8 GPS Cellular RE', 'Apple Watch Series 8 GPS Cellular 41mm Regular với thiết kế trẻ trung, sang trọng cùng chất liệu cao cấp cho độ bền ấn tượng. Thiết bị còn sở hữu các tính năng thông minh để theo dõi sức khỏe toàn diện, gọi điện qua eSim dễ dàng, nếu bạn đang muốn sở hữu đồng hồ thông minh thì đây là gợi ý tuyệt vời dành cho bạn.', 18390000, 'Apple Watch Series 8 GPS Cellular Regular 01.png', 'Apple Watch Series 8 GPS Cellular Regular 02.png', 'Apple Watch Series 8 GPS Cellular Regular 03.png'),
(11, 'Apple Watch Ultra GPS Cellular 49mm Large', 'Apple Watch Ultra GPS Cellular 49mm Large ấn tượng với vẻ ngoài được thiết kế đẳng cấp sang trọng, chất liệu cao cấp bền bỉ cùng công nghệ màn hình Retina cho hiển thị hình ảnh với chất lượng sắc nét. Apple Watch này còn được tích hợp thêm các tính năng mới mẻ thú vị giúp bạn có thể theo dõi được tình trạng sức khỏe, định vị và gọi điện dễ dàng cho bạn có được những trải nghiệm tuyệt vời nhất.', 20990000, 'Apple Watch Ultra GPS Cellular 49mm Large 01.png', 'Apple Watch Ultra GPS Cellular 49mm Large 02.png', 'Apple Watch Ultra GPS Cellular 49mm Large 03.png'),
(12, 'Huawei Watch Ultra GPS Cellular 49mm M-L', 'Huawei Watch Ultra GPS Cellular 49mm M-L được thiết kế sang trọng, tinh tế với 3 band màu là starlight, green và orange mang đến cho bạn nhiều sự lựa chọn. Bên cạnh đó, Apple Watch còn có đa dạng các tính năng hiện đại giúp hỗ trợ người dùng trong quá trình sử dụng, cho phép hoạt động như một chiếc điện thoại thu nhỏ. Sau đây hãy cùng Phong Vũ đi tìm hiểu ưu điểm của chiếc đồng hồ này!', 2529000, 'Apple Watch Ultra GPS Cellular 49mm M-L 01.png', 'Apple Watch Ultra GPS Cellular 49mm M-L 02.png', 'Apple Watch Ultra GPS Cellular 49mm M-L 03.png'),
(13, 'Apple Watch Ultra GPS Cellular 49mm S-M', 'Apple Watch Ultra GPS Cellular 49mm sở hữu thiết kế sang trọng, chất liệu có độ bền cao cùng màn hình Retina cho không gian hiển thị lớn cùng chất lượng sắc nét. Đồng hồ thông minh này còn có các tính năng thông minh giúp theo dõi sức khỏe, gọi điện tiện lợi, định vị chính xác cùng thời lượng pin ấn tượng cho trải nghiệm tuyệt vời.', 21990000, 'Apple Watch Ultra GPS Cellular 49mm S-M 01.png', 'Apple Watch Ultra GPS Cellular 49mm S-M 02.png', 'Apple Watch Ultra GPS Cellular 49mm S-M 03.png'),
(14, 'Apple Watch SE 2022 GPS Regular', 'Apple Watch SE 2022 GPS Cellular 40mm Regular sở hữu vẻ ngoài đẹp mắt, hiện đại cùng với nhiều tính năng hữu ích giúp việc luyện tập của bạn trở nên dễ dàng hơn như đo nhịp tim, hỗ trợ tạo cho bạn thói quen ngủ phù hợp Đây chắc chắn sẽ là một người bạn đồng hành không thể thiếu đối với quá trình rèn luyện sức khỏe của bạn. ', 6690000, 'Apple Watch SE 2022 GPS Regular 01.png', 'Apple Watch SE 2022 GPS Regular 02.png', 'Apple Watch SE 2022 GPS Regular 03.png'),
(15, 'Apple Watch Series 8 GPS Cellular', 'Apple Watch Series 8 GPS Cellular 41mm Loop được biết đến là một chiếc đồng hồ thông minh thế hệ mới thừa hưởng toàn bộ những ưu điểm nổi trội của những thế hệ trước. Sở hữu những công nghệ mới cùng hiệu suất vượt trội hứa hẹn sẽ mang đến cho bạn những trải nghiệm mới mẻ chưa từng có. Được trang bị khung vỏ thép không gỉ cùng thiết kế mặt tròn vô cùng sang trọng.', 19790000, 'Apple Watch Series 8 GPS Cellular 01.png', 'Apple Watch Series 8 GPS Cellular 02.png', 'Apple Watch Series 8 GPS Cellular 03.png'),
(16, 'Asus VivoWatch 5', 'Asus Vivowatch 5 là sản phẩm đồng hồ thông minh chất lượng đến từ thương hiệu Asus chất lượng. Đồng hồ được trang bị nhiều tính năng theo dõi sức khỏe thông minh mang lại trải nghiệm dùng ấn tượng cho người dùng. Trang bị công nghệ ASUS HealthAI độc quyền giúp theo dõi các chỉ số sức khỏe như nồng độ oxy máu, huyết áp, nhịp tim,…', 6190000, 'Asus VivoWatch 5 01.png', 'Asus VivoWatch 5 02.png', 'Asus VivoWatch 5 03.png'),
(17, 'Asus VivoWatch BP (HC-A04)', 'Asus VivoWatch BP (HC-A04) được thiết kế chuyên dùng cho việc tập luyện thể thao cũng như tận hưởng mọi khoảng khắc cho người dùng với các tính năng hỗ trợ tiện lợi, mang đến cho người dùng trải nghiệm tập luyện hiện đại, liền mạch.', 2790000, 'Asus VivoWatch BP (HC-A04) 01.png', 'Asus VivoWatch BP (HC-A04) 02.png', 'Asus VivoWatch BP (HC-A04) 03.png'),
(18, 'ASUS VivoWatch SP (HC-A05)', 'ASUS VivoWatch SP (HC-A05) với thiết kế tinh xảo, đẹp mắt với thiết kế mặt vuông bo tròn với thiết kế vỏ nhôm Aluminium đem tới độ bền, sang trọng và thoải mái cho người sử dụng. Nhiều tính năng theo dõi sức khỏe: Đo nhịp tim, theo dõi giấc ngủ.', 7490000, 'ASUS VivoWatch SP (HC-A05) 01.png', 'ASUS VivoWatch SP (HC-A05) 02.png', 'ASUS VivoWatch SP (HC-A05) 03.png'),
(19, 'AMAZFIT WATCH GTS (Đen)', 'Màn hình vuông phong cách 1,65 inch tùy chỉnh cung cấp diện tích hiển thị lớn hơn mặt đồng hồ tròn có cùng chiều rộng, do đó nó có thể mang nhiều thông tin hơn. Ngoài ra, chúng tôi đã phát hành hai mặt đồng hồ mô-đun cải tiến có thể được tùy chỉnh để hiển thị thông tin cần thiết như nhịp tim, lịch, thời tiết và các sự kiện bạn quan tâm nhất, tất cả trong một mặt đồng hồ dễ kiểm tra. Tổng cộng, bạn có thể tùy chỉnh tối đa 7 widget trong số 17 chức năng.', 2990000, 'AMAZFIT WATCH GTS (Đen) 01.png', 'AMAZFIT WATCH GTS (Đen) 02.png', 'AMAZFIT WATCH GTS (Đen) 03.png'),
(20, 'AMAZFIT GTS VERMILION OR', 'Thông tin chính được hiển thị tập trung, tập trung vào những gì quan trọng nhất với bạn. Ngoại trừ thời gian ở góc trên bên trái, có năm mô-đun nội dung hiển thị (widget) có thể được tùy chỉnh. Ở khu vực giữa, bạn có thể có thời tiết, nhịp tim hoặc lời nhắc được hiển thị; ở các khu vực thấp hơn, bạn có thể chuyển sang đồng hồ bấm giờ, đồng hồ báo thức, chỉ báo pin hoặc bất kỳ tùy chọn nào khác trong số 16 tùy chọn có sẵn.', 1490000, 'AMAZFIT GTS VERMILION ORANGE 01.png', 'AMAZFIT GTS VERMILION ORANGE 02.png', 'AMAZFIT WATCH GTS (Đen) 03.png'),
(21, 'Đồng hồ Garmin Instinct 2', 'Đồng hồ thông minh Instinct 2 là một trong những dòng sản phẩm ấn tượng đến từ nhà Garmin. Không chỉ thu hút người dùng với thiết kế mang đậm phong cách thể thao, cá tính mà còn vô cùng bền bỉ và cứng cáp. Nếu như bạn đang tìm kiếm một chiếc đồng hồ có thể sử dụng cho việc theo dõi các chỉ số sức khỏe hay cho các hoạt động ngoài trời thì đây sẽ là lựa chọn hoàn hảo. ', 8390000, 'Đồng hồ thông minh Garmin Instinct 2 01.png', 'Đồng hồ thông minh Garmin Instinct 2 02.png', 'Đồng hồ thông minh Garmin Instinct 2 03.png'),
(22, 'Đồng hồ Garmin Forerunner 955', 'Garmin là một trong những hãng sản xuất vòng đeo tay và đồng hồ thông minh được nhiều người dùng tin tưởng và lựa chọn các sản phẩm của hãng với thiết kế đẹp mắt sang trọng phù hợp với nhiều đối tượng sử dụng và tính năng đa dạng Trong đó sản phẩm Đồng hồ thông minh Garmin Forerunner 955 thuộc dòng đồng hồ tiêu chuẩn quân sự hoa kỳ được người sử dụng tin tưởng và sử dụng.', 13490000, 'Đồng hồ thông minh Garmin Forerunner 955 01.png', 'Đồng hồ thông minh Garmin Forerunner 955 02.png', 'Đồng hồ thông minh Garmin Forerunner 955 03.png'),
(23, 'Đồng hồ GPS Garmin fenix 7', ' Đồng hồ thông minh GPS Garmin fenix 7 là một sản phẩm thuộc phân khúc cao cấp, sở hữu kiểu dáng sang trọng cùng màu sắc hiện đại, siêu phẩm này hứa hẹn sẽ được đông đảo người dùng đón nhận. Thiết bị với nhiều tính năng thông minh cùng chất liệu bền bỉ luôn sẵn sàng đồng hành cùng người dùng mọi lúc mọi nơi.', 14490000, 'Đồng hồ thông minh GPS Garmin fenix 7 01.png', 'Đồng hồ thông minh GPS Garmin fenix 7 02.png', 'Đồng hồ thông minh GPS Garmin fenix 7 03.png'),
(24, 'Smartwatch Garmin Instinct', 'Đồng hồ thông minh - Smartwatch Garmin Instinct, GPS, Lakeside với thiết kế tinh xảo, đẹp mắt với trọng lượng nhẹ chỉ 52g mặt tròn đem đến sự sang trọng và thoải mái cho người sử dụng. Garmin Instinct được cấu tạo bởi sợi polyme giúp tăng khả năng chống chịu và độ bền cao cho sản phẩm.', 7590000, 'Smartwatch Garmin Instinct, GPS, Lakeside 01.png', 'Smartwatch Garmin Instinct, GPS, Lakeside 02.png', 'Smartwatch Garmin Instinct, GPS, Lakeside 03.png');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `rating` varchar(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `post_id`, `user_id`, `rating`, `title`, `description`, `date`) VALUES
(6, 2, 1, '3', 'quangvinh', '122', '2023-11-14'),
(13, 2, 4, '1', 'h', 'hhj', '2023-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'quangvinh', 'vodoanquangvinh@gmail.com', '12345'),
(4, 'user A', 'user01@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

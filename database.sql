-- Database SQL: web_ao_bong_da
-- Tạo cơ sở dữ liệu nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS `web_ao_bong_da` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `web_ao_bong_da`;

-- 1. Bảng categories (Danh mục áo bóng đá)
DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `banners`;
DROP TABLE IF EXISTS `posts`;

CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `image` VARCHAR(255) DEFAULT 'default_cat.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Bảng products (Sản phẩm áo bóng đá)
CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `price` DECIMAL(10,0) NOT NULL,
  `sale_price` DECIMAL(10,0) DEFAULT 0,
  `image` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `fabric` VARCHAR(100) DEFAULT 'Thun lạnh mộc co giãn 4 chiều',
  `is_featured` TINYINT(1) DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Bảng banners (Quản lý Banner quảng cáo theo vị trí - Bài 1)
CREATE TABLE `banners` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `subtitle` VARCHAR(255),
  `image` VARCHAR(255) NOT NULL,
  `link` VARCHAR(255) DEFAULT '#',
  `position` VARCHAR(50) NOT NULL DEFAULT 'hero',
  `status` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Bảng posts (Quản lý bài viết / tin tức mới - Bài 1)
CREATE TABLE `posts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `summary` TEXT,
  `content` TEXT,
  `image` VARCHAR(255) DEFAULT 'default_news.jpg',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Bảng users (Tài khoản người dùng - Bài 1)
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fullname` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20) DEFAULT '',
  `address` VARCHAR(255) DEFAULT '',
  `role` VARCHAR(20) DEFAULT 'user',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Bảng comments (Bình luận theo sản phẩm - Bài 2)
CREATE TABLE `comments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `user_name` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `rating` INT DEFAULT 5,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Chèn dữ liệu mẫu Categories
INSERT INTO `categories` (`id`, `name`, `description`, `image`) VALUES
(1, 'Áo Câu Lạc Bộ (CLB)', 'Áo đấu chính thức của các CLB hàng đầu Châu Âu như Real Madrid, Man Utd, Arsenal, Barca...', 'cat_clb.jpg'),
(2, 'Áo Đội Tuyển Quốc Gia', 'Áo đấu các ĐTQG nổi tiếng như ĐT Việt Nam, Argentina, Pháp, Đức, Anh, Brazil...', 'cat_dtqg.jpg'),
(3, 'Áo Bóng Đá Không Logo', 'Áo bóng đá thiết kế độc lạ, không logo phục vụ in ấn tên số theo đội nhóm', 'cat_nologo.jpg'),
(4, 'Áo Bóng Đá Dài Tay', 'Mẫu áo giữ nhiệt và áo đấu dài tay cao cấp cho mùa đông', 'cat_daitay.jpg');

-- Chèn dữ liệu mẫu Products
INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `sale_price`, `image`, `description`, `fabric`, `is_featured`) VALUES
(1, 1, 'Áo Real Madrid Sân Nhà 2024/25', 220000, 185000, 'real_home.jpg', 'Áo đấu sân nhà Real Madrid mùa giải 2024/25 tông màu trắng hoàng gia thanh lịch, tích hợp công nghệ thấm hút mồ hôi tối đa.', 'Thun lạnh Hàn Quốc co giãn 4 chiều', 1),
(2, 1, 'Áo Manchester United Sân Nhà 2024/25', 220000, 190000, 'mu_home.jpg', 'Áo đấu Quỷ Đỏ Manchester United sắc đỏ truyền thống, logo thêu sắc nét, phong cách mạnh mẽ bản lĩnh.', 'Thun lạnh cao cấp thoáng khí', 1),
(3, 1, 'Áo Arsenal Sân Nhà 2024/25', 210000, 180000, 'arsenal_home.jpg', 'Mẫu áo Arsenal Pháo Thủ London thiết kế trẻ trung với phối màu đỏ trắng tinh tế, chuẩn phom ôm body thể thao.', 'Polyester cao cấp co giãn', 1),
(4, 1, 'Áo Barcelona Sân Nhà 2024/25', 230000, 195000, 'barca_home.jpg', 'Áo Barca sọc xanh đỏ lamgrana kiêu hãnh kỷ niệm truyền thống CLB, vải mịn màng cực mát.', 'Thun lạnh Thái Lan xịn', 1),
(5, 2, 'Áo ĐT Việt Nam Sân Nhà 2024/25 Red Dragon', 250000, 210000, 'vietnam_home.jpg', 'Áo đấu chính thức Đội tuyển Quốc gia Việt Nam đỏ thắm kiêu hãnh, họa tiết rồng chìm sang trọng độc đáo.', 'Mè cao cấp xịn sò siêu thoáng', 1),
(6, 2, 'Áo ĐT Argentina Vô Địch World Cup 3 Sao', 240000, 200000, 'argentina_home.jpg', 'Áo sọc xanh trắng Argentina gắn 3 ngôi sao vàng thế giới, áo thi đấu của siêu sao Lionel Messi.', 'Thun lạnh mộc 4 chiều', 1);

-- Chèn dữ liệu mẫu Banners
INSERT INTO `banners` (`id`, `title`, `subtitle`, `image`, `link`, `position`, `status`) VALUES
(1, 'BỘ SƯU TẬP ÁO BÓNG ĐÁ 2024/25', 'Kho áo đấu Câu Lạc Bộ, Đội Tuyển Quốc Gia cao cấp. Vải thun lạnh thoáng khí, in tên số theo yêu cầu cực đẹp.', 'banner_hero_1.jpg', 'index.php?controller=product', 'hero', 1),
(2, 'SIÊU KHUYẾN MÃI ÁO ĐỘI BÓNG', 'Giảm ngay 15% cho đơn hàng đặt in áo đội từ 10 bộ trở lên', 'banner_sub_1.jpg', 'index.php?controller=product', 'sub', 1),
(3, 'DỊCH VỤ IN ẤN LẤY NGAY 24H', 'Công nghệ in chuyển nhiệt 3D hiện đại - Không bong tróc khi giặt máy', 'banner_promo_1.jpg', 'index.php?controller=page&action=contact', 'promo', 1);

-- Chèn dữ liệu mẫu Posts
INSERT INTO `posts` (`id`, `title`, `summary`, `content`, `image`) VALUES
(1, 'Hướng dẫn chọn size áo bóng đá chuẩn vóc dáng người Việt', 'Bảng quy đổi size S, M, L, XL, XXL chi tiết theo chiều cao và cân nặng để bạn chọn được bộ áo vừa vặn nhất.', 'Nội dung hướng dẫn chi tiết cách đo vòng ngực, chiều dài thân áo...', 'news_size.jpg'),
(2, 'Top 5 mẫu áo đấu CLB đẹp nhất mùa giải 2024/25', 'Điểm qua những siêu phẩm áo đấu sân nhà của Real Madrid, Man Utd, Arsenal, Barca được cộng đồng fan đón nhận nồng nhiệt.', 'Đánh giá chi tiết đường nét thiết kế, hoa văn chìm...', 'news_top5.jpg');

-- Chèn dữ liệu mẫu Users (Bài 1) (Mật khẩu mặc định: 123456)
INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `address`, `role`) VALUES
(1, 'Nguyễn Văn Minh', 'minh.nguyen@gmail.com', '$2y$10$vYqF2j4F8s1k.5kH5E/vvu70k4V7p0y7p0y7p0y7p0y7p0y7p0y7p', '0912345678', '123 Nguyễn Trãi, Quận 5, TP.HCM', 'user'),
(2, 'Trần Thị Mai', 'mai.tran@gmail.com', '$2y$10$vYqF2j4F8s1k.5kH5E/vvu70k4V7p0y7p0y7p0y7p0y7p0y7p0y7p', '0987654321', '456 Lê Lợi, Quận 1, TP.HCM', 'user'),
(3, 'Lê Danh Tuấn', 'danhtuanle714@gmail.com', '$2y$10$vYqF2j4F8s1k.5kH5E/vvu70k4V7p0y7p0y7p0y7p0y7p0y7p0y7p', '0988776655', '789 Trần Hưng Đạo, Quận 5, TP.HCM', 'user');

-- Chèn dữ liệu mẫu Comments (Bài 2)
INSERT INTO `comments` (`id`, `product_id`, `user_name`, `content`, `rating`) VALUES
(1, 1, 'Nguyễn Văn Minh', 'Áo Real Madrid chất vải thun lạnh quá đẹp, mặc mát lạnh! In số 7 Ronaldo cực nét.', 5),
(2, 1, 'Trần Thị Mai', 'Shop giao hàng rất nhanh, đóng gói cẩn thận. Áo mặc vừa vặn chuẩn phom.', 5),
(3, 5, 'Phạm Quốc Cường', 'Áo Việt Nam màu đỏ rồng thắm sang xịn mịn! Rất tự hào khi mặc đi cổ vũ.', 5);

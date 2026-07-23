<?php
// Layout Header dùng chung cho tất cả các trang (Bài 1, 2, 3 & Session User)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentController = $_GET['controller'] ?? ($_GET['action'] ?? 'home');
$currentAction     = $_GET['action'] ?? 'index';
$searchKw          = $_GET['keyword'] ?? '';
$currentUser       = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'WEB ÁO BÓNG ĐÁ - Cửa hàng áo đấu thể thao'; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- TOP BAR -->
    <div class="top-bar">
        <div class="container top-bar-content">
            <div><i class="fa-solid fa-truck-fast"></i> Miễn phí giao hàng cho đơn hàng từ 500k | In tên số lấy ngay!</div>
            <div>Hotline hỗ trợ: <strong style="color: var(--accent-color);">0988.123.456</strong></div>
        </div>
    </div>

    <!-- MAIN HEADER -->
    <header class="header-main">
        <div class="container header-wrapper">
            <!-- LOGO -->
            <div class="logo">
                <a href="index.php">
                    <i class="fa-solid fa-futbol"></i> ÁO BÓNG <span>ĐÁ</span>
                </a>
            </div>

            <!-- SEARCH BAR TÌM KIẾM TRÊN HEADER -->
            <div class="header-search-box">
                <form action="index.php" method="GET" style="display: flex; gap: 5px; width: 100%;">
                    <input type="hidden" name="action" value="search">
                    <input type="text" name="keyword" class="header-search-input" placeholder="Tìm tên áo bóng đá (Real, MU, ĐT Việt Nam...)" value="<?php echo htmlspecialchars($searchKw); ?>" required>
                    <button type="submit" class="header-search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            <!-- NAVBAR -->
            <nav class="nav-menu">
                <ul>
                    <li><a href="index.php?action=home" class="<?php echo ($currentController === 'home') ? 'active' : ''; ?>"><i class="fa-solid fa-house"></i> Trang Chủ</a></li>
                    <li><a href="index.php?action=product" class="<?php echo ($currentController === 'product') ? 'active' : ''; ?>"><i class="fa-solid fa-shirt"></i> Sản Phẩm</a></li>
                    <li><a href="index.php?action=page&sub=about" class="<?php echo ($currentAction === 'about') ? 'active' : ''; ?>"><i class="fa-solid fa-circle-info"></i> Giới Thiệu</a></li>
                    <li><a href="index.php?action=page&sub=contact" class="<?php echo ($currentAction === 'contact') ? 'active' : ''; ?>"><i class="fa-solid fa-envelope"></i> Liên Hệ</a></li>
                </ul>
            </nav>

            <!-- AUTH ACTIONS / ĐĂNG NHẬP - ĐĂNG KÝ -->
            <div class="header-actions" style="display: flex; align-items: center; gap: 10px; margin-left: 15px;">
                <?php if ($currentUser): ?>
                    <a href="index.php?action=profile" style="background: #ffb703; color: #0d1b2a; font-weight:800; padding: 8px 14px; border-radius: 20px; text-decoration:none; font-size:13px; display:inline-flex; align-items:center; gap:6px;">
                        <i class="fa-solid fa-user-gear"></i> Hi, <?php echo htmlspecialchars($currentUser['fullname']); ?>
                    </a>
                    <a href="index.php?action=logout" style="background: #e63946; color: white; padding: 8px 12px; border-radius: 20px; text-decoration:none; font-size:13px;" title="Đăng xuất">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                <?php else: ?>
                    <a href="index.php?action=login" style="background: #ffb703; color: #0d1b2a; font-weight:800; padding: 8px 16px; border-radius: 20px; text-decoration:none; font-size:13px; display:inline-flex; align-items:center; gap:6px; box-shadow: 0 3px 10px rgba(255,183,3,0.3);">
                        <i class="fa-solid fa-right-to-bracket"></i> Đăng Nhập
                    </a>
                    <a href="index.php?action=register" style="background: #2ec4b6; color: white; font-weight:800; padding: 8px 16px; border-radius: 20px; text-decoration:none; font-size:13px; display:inline-flex; align-items:center; gap:6px; box-shadow: 0 3px 10px rgba(46,196,182,0.3);">
                        <i class="fa-solid fa-user-plus"></i> Đăng Ký
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- HÀM HELPER VẼ HÌNH ÁO BÓNG ĐÁ BẰNG SVG TRONG VIEW (Nếu chưa có ảnh) -->
    <?php
    if (!function_exists('renderJerseySvg')) {
        function renderJerseySvg($name) {
            $colorPrimary = "#0d1b2a";
            $colorSecondary = "#ffb703";
            $stripeColor = "#e63946";

            if (strpos($name, 'Real Madrid') !== false) {
                $colorPrimary = "#ffffff"; $colorSecondary = "#0d1b2a"; $stripeColor = "#ffb703";
            } elseif (strpos($name, 'Manchester United') !== false) {
                $colorPrimary = "#d90429"; $colorSecondary = "#ffffff"; $stripeColor = "#111111";
            } elseif (strpos($name, 'Arsenal') !== false) {
                $colorPrimary = "#e63946"; $colorSecondary = "#ffffff"; $stripeColor = "#ffb703";
            } elseif (strpos($name, 'Barcelona') !== false) {
                $colorPrimary = "#003049"; $colorSecondary = "#780000"; $stripeColor = "#ffb703";
            } elseif (strpos($name, 'Việt Nam') !== false) {
                $colorPrimary = "#da251d"; $colorSecondary = "#ffff00"; $stripeColor = "#da251d";
            } elseif (strpos($name, 'Argentina') !== false) {
                $colorPrimary = "#757bc8"; $colorSecondary = "#ffffff"; $stripeColor = "#ffb703";
            }

            return '<svg viewBox="0 0 100 100" width="160" height="160" xmlns="http://www.w3.org/2000/svg">
                <path d="M 30 20 L 15 35 L 25 45 L 30 40 L 30 85 L 70 85 L 70 40 L 75 45 L 85 35 L 70 20 C 60 28 40 28 30 20 Z" fill="'.$colorPrimary.'" stroke="#333" stroke-width="2"/>
                <path d="M 40 20 C 45 25 55 25 60 20" fill="none" stroke="'.$colorSecondary.'" stroke-width="3"/>
                <rect x="46" y="40" width="8" height="30" fill="'.$stripeColor.'" opacity="0.8"/>
                <circle cx="60" cy="35" r="4" fill="'.$colorSecondary.'"/>
            </svg>';
        }
    }
    ?>

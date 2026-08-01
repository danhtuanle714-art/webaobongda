<?php
// View Admin Báo Cáo Thống Kê (views/admin/statistics/index.php) - Giai đoạn 2 (5%)
?>

<div class="container section">
    <!-- BAR TIÊU ĐỀ ADMIN -->
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; background: #0d1b2a; padding: 15px 20px; border-radius: 10px; color: white; flex-wrap: wrap;">
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <a href="index.php?action=admin&sub=category_list" style="color: white; font-weight:600; text-decoration:none;"><i class="fa-solid fa-folder"></i> Quản Lý Danh Mục</a> | 
            <a href="index.php?action=admin&sub=product_list" style="color: white; font-weight:600; text-decoration:none;"><i class="fa-solid fa-shirt"></i> Quản Lý Sản Phẩm</a> | 
            <a href="index.php?action=admin&sub=statistics" style="color: var(--accent-color); font-weight:800; text-decoration:none;"><i class="fa-solid fa-chart-line"></i> Báo Cáo Thống Kê</a>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <?php if (isset($_SESSION['user'])): ?>
                <span style="color: #ffb703; font-size:14px; font-weight:700;"><i class="fa-solid fa-user-shield"></i> Admin: <?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></span>
                <a href="index.php?action=admin&sub=register" style="background:#2ec4b6; color:white; padding:6px 12px; border-radius:6px; font-size:13px; font-weight:700; text-decoration:none;"><i class="fa-solid fa-user-plus"></i> Tạo Thêm Admin</a>
                <a href="index.php?action=logout" style="background:#e63946; color:white; padding:6px 12px; border-radius:6px; font-size:13px; font-weight:700; text-decoration:none;"><i class="fa-solid fa-right-from-bracket"></i> Đăng Xuất</a>
            <?php else: ?>
                <a href="index.php?action=login" style="background:#ffb703; color:#0d1b2a; padding:6px 14px; border-radius:6px; font-size:13px; font-weight:800; text-decoration:none;"><i class="fa-solid fa-right-to-bracket"></i> Đăng Nhập Admin</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- TIÊU ĐỀ TRANG -->
    <div style="margin-bottom: 25px;">
        <h2 style="font-size: 26px; font-weight: 900; color: var(--primary-color);">
            <i class="fa-solid fa-chart-pie" style="color: var(--accent-color);"></i> BÁO CÁO THỐNG KÊ HỆ THỐNG
        </h2>
        <p style="color: var(--text-muted); font-size: 14px;">Tổng quan chỉ số kinh doanh, số lượng áo đấu theo giải đấu và lượt tương tác thành viên</p>
    </div>

    <!-- KHỐI KPI STATS CARDS -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px;">
        
        <!-- CARD 1: DANH MỤC -->
        <div style="background: linear-gradient(135deg, #0d1b2a, #1b263b); color: white; padding: 22px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 13px; text-transform: uppercase; font-weight: 700; color: #a0aec0; letter-spacing: 0.5px;">Tổng Danh Mục</div>
                    <div style="font-size: 32px; font-weight: 900; margin-top: 5px; color: #ffb703;"><?php echo $total_categories; ?></div>
                </div>
                <div style="font-size: 36px; color: rgba(255,255,255,0.2);"><i class="fa-solid fa-folder-open"></i></div>
            </div>
            <div style="font-size: 12px; margin-top: 10px; color: #cbd5e0;">Danh mục giải đấu & ĐTQG</div>
        </div>

        <!-- CARD 2: SẢN PHẨM -->
        <div style="background: linear-gradient(135deg, #1b263b, #415a77); color: white; padding: 22px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 13px; text-transform: uppercase; font-weight: 700; color: #a0aec0; letter-spacing: 0.5px;">Mẫu Áo Bóng Đá</div>
                    <div style="font-size: 32px; font-weight: 900; margin-top: 5px; color: #2ec4b6;"><?php echo $total_products; ?></div>
                </div>
                <div style="font-size: 36px; color: rgba(255,255,255,0.2);"><i class="fa-solid fa-shirt"></i></div>
            </div>
            <div style="font-size: 12px; margin-top: 10px; color: #cbd5e0;">Sản phẩm áo câu lạc bộ / ĐTQG</div>
        </div>

        <!-- CARD 3: THÀNH VIÊN -->
        <div style="background: linear-gradient(135deg, #0d1b2a, #2b2d42); color: white; padding: 22px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 13px; text-transform: uppercase; font-weight: 700; color: #a0aec0; letter-spacing: 0.5px;">Thành Viên</div>
                    <div style="font-size: 32px; font-weight: 900; margin-top: 5px; color: #ffb703;"><?php echo $total_users; ?></div>
                </div>
                <div style="font-size: 36px; color: rgba(255,255,255,0.2);"><i class="fa-solid fa-users"></i></div>
            </div>
            <div style="font-size: 12px; margin-top: 10px; color: #cbd5e0;">Tài khoản đã đăng ký thành công</div>
        </div>

        <!-- CARD 4: BÌNH LUẬN -->
        <div style="background: linear-gradient(135deg, #2b2d42, #8d99ae); color: white; padding: 22px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 13px; text-transform: uppercase; font-weight: 700; color: #edf2f4; letter-spacing: 0.5px;">Bình Luận / Rating</div>
                    <div style="font-size: 32px; font-weight: 900; margin-top: 5px; color: #ffb703;"><?php echo $total_comments; ?></div>
                </div>
                <div style="font-size: 36px; color: rgba(255,255,255,0.2);"><i class="fa-solid fa-comments"></i></div>
            </div>
            <div style="font-size: 12px; margin-top: 10px; color: #edf2f4;">Lượt đánh giá trực tiếp từ người dùng</div>
        </div>

    </div>

    <!-- BẢNG THỐNG KÊ SẢN PHẨM THEO DANH MỤC -->
    <div class="admin-card">
        <h3 style="font-size: 20px; font-weight: 800; color: var(--primary-color); margin-bottom: 20px;">
            <i class="fa-solid fa-list-check" style="color: var(--accent-color);"></i> Thống Kê Sản Phẩm Theo Danh Mục Giải Đấu
        </h3>

        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">STT</th>
                        <th>Mã Danh Mục</th>
                        <th>Tên Danh Mục Giải Đấu</th>
                        <th style="text-align: center;">Số Lượng Áo</th>
                        <th style="text-align: right;">Giá Thấp Nhất</th>
                        <th style="text-align: right;">Giá Cao Nhất</th>
                        <th style="text-align: right;">Giá Trung Bình</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($category_stats)): ?>
                        <?php $stt = 1; foreach ($category_stats as $stat): ?>
                            <tr>
                                <td style="text-align: center; font-weight: 700;"><?php echo $stt++; ?></td>
                                <td style="font-weight: 600; color: var(--text-muted);">#CAT-<?php echo sprintf('%03d', $stat['id']); ?></td>
                                <td style="font-weight: 800; color: var(--primary-color);">
                                    <i class="fa-solid fa-folder" style="color: #ffb703; margin-right: 6px;"></i>
                                    <?php echo htmlspecialchars($stat['category_name']); ?>
                                </td>
                                <td style="text-align: center;">
                                    <span style="background: #e2e8f0; color: #0d1b2a; padding: 4px 12px; border-radius: 20px; font-weight: 800; font-size: 13px;">
                                        <?php echo $stat['product_count']; ?> mẫu
                                    </span>
                                </td>
                                <td style="text-align: right; color: #2ec4b6; font-weight: 700;">
                                    <?php echo number_format($stat['min_price'], 0, ',', '.'); ?> đ
                                </td>
                                <td style="text-align: right; color: #e63946; font-weight: 700;">
                                    <?php echo number_format($stat['max_price'], 0, ',', '.'); ?> đ
                                </td>
                                <td style="text-align: right; color: #0d1b2a; font-weight: 800;">
                                    <?php echo number_format($stat['avg_price'], 0, ',', '.'); ?> đ
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 25px; color: var(--text-muted);">Chưa có dữ liệu thống kê danh mục.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

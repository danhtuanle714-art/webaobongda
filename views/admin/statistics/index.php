<?php
// View Admin Báo Cáo Thống Kê & Bảng Điều Khiển (views/admin/statistics/index.php)
?>

<div class="container section">
    <!-- BAR NAVIGATION MENU ADMIN CHUẨN CƠ CẤU -->
    <div style="background: #0d1b2a; padding: 15px 20px; border-radius: 12px; margin-bottom: 25px; color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 12px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 12px;">
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap; font-size: 14px; font-weight: 700;">
                <a href="index.php?action=admin&sub=product_list" style="color: white; text-decoration:none;"><i class="fa-solid fa-boxes-stacked"></i> Quản Lí Sản Phẩm</a>
                <a href="index.php?action=admin&sub=product_add" style="background:#2ec4b6; color:white; padding:4px 10px; border-radius:6px; font-size:12px; text-decoration:none;"><i class="fa-solid fa-plus-circle"></i> Thêm Sản Phẩm</a> | 
                <a href="index.php?action=admin&sub=statistics" style="color: #ffb703; font-weight:800; text-decoration:none;"><i class="fa-solid fa-chart-line"></i> Thống Kê</a> | 
                <a href="index.php?action=admin&sub=category_list" style="color: white; text-decoration:none;"><i class="fa-solid fa-folder"></i> Quản Lí Danh Mục</a> | 
                <a href="index.php?action=admin&sub=comment_list" style="color: white; text-decoration:none;"><i class="fa-solid fa-comments"></i> Quản Lí Bình Luận</a> | 
                <a href="index.php?action=admin&sub=user_list" style="color: white; text-decoration:none;"><i class="fa-solid fa-users"></i> Quản Lí Người Dùng</a>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <?php if (isset($_SESSION['user'])): ?>
                    <span style="color: #ffb703; font-size:13px; font-weight:700;"><i class="fa-solid fa-user-shield"></i> <?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></span>
                    <a href="index.php?action=logout" style="background:#e63946; color:white; padding:5px 10px; border-radius:6px; font-size:12px; font-weight:700; text-decoration:none;"><i class="fa-solid fa-right-from-bracket"></i> Thoát</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- DANH SÁCH TẤT CẢ MODULE CỦA PHÂN HỆ QUẢN TRỊ -->
        <div style="display: flex; gap: 10px; flex-wrap: wrap; font-size: 13px;">
            <span style="color: #a0aec0; font-weight: 600;"><i class="fa-solid fa-bars-staggered"></i> Chức năng:</span>
            <a href="index.php?action=admin&sub=product_list" style="color: #edf2f4; text-decoration:none; background: rgba(255,255,255,0.08); padding: 3px 10px; border-radius: 4px;">Quản lí sản phẩm</a>
            <a href="index.php?action=admin&sub=statistics" style="color: #ffb703; text-decoration:none; background: rgba(255,255,255,0.08); padding: 3px 10px; border-radius: 4px; font-weight: 700;">Thống kê</a>
            <a href="index.php?action=admin&sub=category_list" style="color: #edf2f4; text-decoration:none; background: rgba(255,255,255,0.08); padding: 3px 10px; border-radius: 4px;">Quản lí danh mục</a>
            <a href="index.php?action=admin&sub=comment_list" style="color: #edf2f4; text-decoration:none; background: rgba(255,255,255,0.08); padding: 3px 10px; border-radius: 4px;">Quản lí bình luận</a>
            <a href="#" style="color: #edf2f4; text-decoration:none; background: rgba(255,255,255,0.08); padding: 3px 10px; border-radius: 4px;">Quản lí đơn hàng</a>
            <a href="#" style="color: #edf2f4; text-decoration:none; background: rgba(255,255,255,0.08); padding: 3px 10px; border-radius: 4px;">Quản lí mã giảm giá</a>
            <a href="index.php?action=admin&sub=user_list" style="color: #edf2f4; text-decoration:none; background: rgba(255,255,255,0.08); padding: 3px 10px; border-radius: 4px;">Quản lí người dùng</a>
            <a href="#" style="color: #a0aec0; text-decoration:none; background: rgba(255,255,255,0.05); padding: 3px 10px; border-radius: 4px;"><i class="fa-solid fa-trash-can"></i> Thùng rác</a>
        </div>
    </div>

    <!-- KHỐI KPI STATS CARDS THEO CHUẨN GIAO DIỆN BẢNG ĐIỀU KHIỂN -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; margin-bottom: 30px;">
        
        <!-- CARD 1: TỔNG SẢN PHẨM -->
        <div style="background: linear-gradient(135deg, #0d1b2a, #1b263b); color: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); border-left: 5px solid #2ec4b6;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 13px; text-transform: uppercase; font-weight: 800; color: #a0aec0; letter-spacing: 0.5px;">TỔNG SẢN PHẨM</div>
                    <div style="font-size: 38px; font-weight: 900; margin-top: 5px; color: #2ec4b6;"><?php echo $total_products; ?></div>
                </div>
                <div style="font-size: 42px; color: rgba(46, 196, 182, 0.3);"><i class="fa-solid fa-shirt"></i></div>
            </div>
            <div style="font-size: 13px; margin-top: 12px; color: #edf2f4; font-weight: 600;">
                <i class="fa-solid fa-circle-check" style="color: #2ec4b6;"></i> Đang hiển thị trong cửa hàng
            </div>
        </div>

        <!-- CARD 2: GIÁ CAO NHẤT -->
        <div style="background: linear-gradient(135deg, #0d1b2a, #2b2d42); color: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); border-left: 5px solid #ffb703;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 13px; text-transform: uppercase; font-weight: 800; color: #a0aec0; letter-spacing: 0.5px;">GIÁ CAO NHẤT</div>
                    <div style="font-size: 38px; font-weight: 900; margin-top: 5px; color: #ffb703;"><?php echo number_format($max_price, 0, ',', '.'); ?>đ</div>
                </div>
                <div style="font-size: 42px; color: rgba(255, 183, 3, 0.3);"><i class="fa-solid fa-tags"></i></div>
            </div>
            <div style="font-size: 13px; margin-top: 12px; color: #edf2f4; font-weight: 600;">
                <i class="fa-solid fa-award" style="color: #ffb703;"></i> Sản phẩm có giá trị lớn nhất
            </div>
        </div>

        <!-- CARD 3: TỔNG DANH MỤC -->
        <div style="background: linear-gradient(135deg, #1b263b, #415a77); color: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); border-left: 5px solid #e63946;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 13px; text-transform: uppercase; font-weight: 800; color: #a0aec0; letter-spacing: 0.5px;">QUẢN LÍ DANH MỤC</div>
                    <div style="font-size: 38px; font-weight: 900; margin-top: 5px; color: #ffffff;"><?php echo $total_categories; ?></div>
                </div>
                <div style="font-size: 42px; color: rgba(255, 255, 255, 0.2);"><i class="fa-solid fa-folder-open"></i></div>
            </div>
            <div style="font-size: 13px; margin-top: 12px; color: #edf2f4; font-weight: 600;">
                <i class="fa-solid fa-layer-group" style="color: #e63946;"></i> Danh mục CLB & ĐTQG
            </div>
        </div>

    </div>

    <!-- BẢNG CHI TIẾT THỐNG KÊ DANH MỤC -->
    <div class="admin-card">
        <div class="admin-header-flex" style="margin-bottom: 20px;">
            <div>
                <h3 style="font-size: 20px; font-weight: 800; color: var(--primary-color);">
                    <i class="fa-solid fa-chart-pie" style="color: var(--accent-color);"></i> Bảng Thống Kê Sản Phẩm Chi Tiết Theo Danh Mục
                </h3>
                <p style="color: var(--text-muted); font-size: 13px;">Phân tích đơn giá thấp nhất, giá cao nhất và số lượng áo đấu theo từng nhóm danh mục</p>
            </div>
            <a href="index.php?action=admin&sub=product_add" class="btn-admin btn-admin-add">
                <i class="fa-solid fa-plus-circle"></i> Thêm Sản Phẩm Mới
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">STT</th>
                        <th>Mã Danh Mục</th>
                        <th>Tên Danh Mục Áo Đấu</th>
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
                                <td style="text-align: center; font-weight: 700; color: var(--text-muted);"><?php echo $stt++; ?></td>
                                <td style="font-weight: 600; color: var(--text-muted);">#CAT-<?php echo sprintf('%03d', $stat['id']); ?></td>
                                <td style="font-weight: 800; color: var(--primary-color);">
                                    <i class="fa-solid fa-folder" style="color: #ffb703; margin-right: 6px;"></i>
                                    <?php echo htmlspecialchars($stat['category_name']); ?>
                                </td>
                                <td style="text-align: center;">
                                    <span style="background: #2ec4b6; color: white; padding: 4px 12px; border-radius: 20px; font-weight: 800; font-size: 12px;">
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
                            <td colspan="7" style="text-align: center; padding: 25px; color: var(--text-muted);">Chưa có dữ liệu thống kê.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

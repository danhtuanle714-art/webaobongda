<?php
// View Admin Danh Sách & Tìm Kiếm Áo Bóng Đá (views/admin/products/index.php) - LAB 4 Bài 2
?>

<div class="container section">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; background: #0d1b2a; padding: 15px 20px; border-radius: 10px; color: white;">
        <div style="display: flex; gap: 20px; align-items: center;">
            <a href="index.php?action=admin&sub=category_list" style="color: white; font-weight:600; text-decoration:none;"><i class="fa-solid fa-folder"></i> Quản Lý Danh Mục</a> | 
            <a href="index.php?action=admin&sub=product_list" style="color: var(--accent-color); font-weight:700; text-decoration:none;"><i class="fa-solid fa-shirt"></i> Quản Lý Sản Phẩm (Search / CRUD)</a>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <?php if (isset($_SESSION['user'])): ?>
                <span style="color: #ffb703; font-size:14px; font-weight:700;"><i class="fa-solid fa-user-shield"></i> Admin: <?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></span>
                <a href="index.php?action=admin&sub=register" style="background:#2ec4b6; color:white; padding:6px 12px; border-radius:6px; font-size:13px; font-weight:700; text-decoration:none;"><i class="fa-solid fa-user-plus"></i> Tạo Thêm Admin</a>
                <a href="index.php?action=logout" style="background:#e63946; color:white; padding:6px 12px; border-radius:6px; font-size:13px; font-weight:700; text-decoration:none;"><i class="fa-solid fa-right-from-bracket"></i> Đăng Xuất</a>
            <?php else: ?>
                <a href="index.php?action=login" style="background:#ffb703; color:#0d1b2a; padding:6px 14px; border-radius:6px; font-size:13px; font-weight:800; text-decoration:none;"><i class="fa-solid fa-right-to-bracket"></i> Đăng Nhập Admin</a>
                <a href="index.php?action=register" style="background:#2ec4b6; color:white; padding:6px 14px; border-radius:6px; font-size:13px; font-weight:800; text-decoration:none;"><i class="fa-solid fa-user-plus"></i> Đăng Ký Admin</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'added'): ?>
        <div class="alert-msg alert-success"><i class="fa-solid fa-check"></i> Đã thêm áo bóng đá mới thành công!</div>
    <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
        <div class="alert-msg alert-success"><i class="fa-solid fa-check"></i> Đã cập nhật thông tin áo bóng đá!</div>
    <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <div class="alert-msg alert-danger"><i class="fa-solid fa-trash"></i> Đã xóa sản phẩm khỏi hệ thống!</div>
    <?php endif; ?>

    <div class="admin-card">
        <div class="admin-header-flex">
            <div>
                <h2 style="font-size: 24px; font-weight: 900; color: var(--primary-color);">
                    <i class="fa-solid fa-boxes-stacked"></i> QUẢN LÝ ÁO BÓNG ĐÁ
                </h2>
                <p style="color: var(--text-muted); font-size: 14px;">Quản lý toàn bộ danh sách áo đấu, tìm kiếm, sửa và xóa sản phẩm</p>
            </div>

            <!-- NÚT THÊM SẢN PHẨM MỚI -->
            <a href="index.php?controller=admin&action=product_add" class="btn-admin btn-admin-add" style="padding: 10px 18px; font-size: 14px;">
                <i class="fa-solid fa-plus-circle"></i> Thêm Áo Bóng Đá Mới
            </a>
        </div>

        <!-- LAB 4 BÀI 2: THANH TÌM KIẾM SẢN PHẨM (SEARCH FORM) -->
        <div style="background: #f8f9fa; padding: 18px; border-radius: 10px; margin-bottom: 25px; border: 1px solid var(--border-color);">
            <form action="index.php" method="GET" class="search-box-form" style="max-width: 100%;">
                <input type="hidden" name="controller" value="admin">
                <input type="hidden" name="action" value="product_list">
                
                <div style="display: flex; gap: 10px; width: 100%;">
                    <input type="text" name="keyword" class="search-input" placeholder="Nhập tên áo bóng đá (Real Madrid, Arsenal, Việt Nam...), chất liệu vải..." value="<?php echo htmlspecialchars($keyword ?? ''); ?>">
                    <button type="submit" class="btn-admin btn-admin-edit" style="padding: 10px 20px; white-space: nowrap;">
                        <i class="fa-solid fa-magnifying-glass"></i> Tìm Kiếm
                    </button>
                    <?php if (!empty($keyword)): ?>
                        <a href="index.php?controller=admin&action=product_list" class="btn-admin" style="background: var(--text-muted); color: white; white-space: nowrap;">
                            <i class="fa-solid fa-rotate-left"></i> Đặt Lại
                        </a>
                    <?php endif; ?>
                </div>
            </form>
            <?php if (!empty($keyword)): ?>
                <div style="margin-top: 10px; font-size: 14px; color: var(--accent-hover); font-weight: 600;">
                    Kết quả tìm kiếm cho từ khóa: "<?php echo htmlspecialchars($keyword); ?>" (Tìm thấy <?php echo count($products); ?> kết quả)
                </div>
            <?php endif; ?>
        </div>

        <!-- BẢNG DANH SÁCH ÁO BÓNG ĐÁ -->
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình Ảnh</th>
                    <th>Tên Áo Bóng Đá</th>
                    <th>Danh Mục</th>
                    <th>Giá Bán</th>
                    <th>Giá Khuyến Mãi</th>
                    <th>Nổi Bật</th>
                    <th style="text-align: center;">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 30px;">
                            Không tìm thấy áo bóng đá nào khớp với từ khóa tìm kiếm.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $prod): ?>
                        <tr>
                            <td><strong>#<?php echo $prod['id']; ?></strong></td>
                            <td style="width: 70px;">
                                <div style="width: 50px; height: 50px; background: #f8f9fa; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                    <?php echo renderJerseySvg($prod['name']); ?>
                                </div>
                            </td>
                            <td style="font-weight: 700; color: var(--primary-color);">
                                <?php echo htmlspecialchars($prod['name']); ?>
                                <div style="font-size: 12px; color: var(--text-muted); font-weight: normal;"><?php echo htmlspecialchars($prod['fabric'] ?? ''); ?></div>
                            </td>
                            <td><span style="background: rgba(2, 132, 199, 0.1); color: #0284c7; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 700;"><?php echo htmlspecialchars($prod['category_name'] ?? 'CLB'); ?></span></td>
                            <td style="font-weight: 700;"><?php echo number_format($prod['price'], 0, ',', '.'); ?>đ</td>
                            <td>
                                <?php if ($prod['sale_price'] > 0): ?>
                                    <span style="color: var(--danger-color); font-weight: 800;"><?php echo number_format($prod['sale_price'], 0, ',', '.'); ?>đ</span>
                                <?php else: ?>
                                    <span style="color: var(--text-muted);">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($prod['is_featured'] == 1): ?>
                                    <span style="background: var(--accent-color); color: var(--primary-color); font-size: 11px; padding: 2px 6px; border-radius: 4px; font-weight: 800;">Có</span>
                                <?php else: ?>
                                    <span style="color: var(--text-muted); font-size: 11px;">Không</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center; white-space: nowrap;">
                                <!-- SỬA SẢN PHẨM -->
                                <a href="index.php?controller=admin&action=product_edit&id=<?php echo $prod['id']; ?>" class="btn-admin btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Sửa
                                </a>
                                <!-- XÓA SẢN PHẨM -->
                                <a href="index.php?controller=admin&action=product_delete&id=<?php echo $prod['id']; ?>" class="btn-admin btn-admin-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa áo \'<?php echo htmlspecialchars($prod['name']); ?>\' không?');">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

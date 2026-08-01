<?php
// View Admin Quản Lý Bình Luận (views/admin/comments/index.php)
?>

<div class="container section">
    <!-- BAR TIÊU ĐỀ ADMIN -->
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; background: #0d1b2a; padding: 15px 20px; border-radius: 10px; color: white; flex-wrap: wrap;">
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <a href="index.php?action=admin&sub=category_list" style="color: white; font-weight:600; text-decoration:none;"><i class="fa-solid fa-folder"></i> Quản Lý Danh Mục</a> | 
            <a href="index.php?action=admin&sub=product_list" style="color: white; font-weight:600; text-decoration:none;"><i class="fa-solid fa-shirt"></i> Quản Lý Sản Phẩm</a> | 
            <a href="index.php?action=admin&sub=user_list" style="color: white; font-weight:600; text-decoration:none;"><i class="fa-solid fa-users"></i> Quản Lý Người Dùng</a> | 
            <a href="index.php?action=admin&sub=comment_list" style="color: var(--accent-color); font-weight:800; text-decoration:none;"><i class="fa-solid fa-comments"></i> Quản Lý Bình Luận</a> | 
            <a href="index.php?action=admin&sub=statistics" style="color: white; font-weight:600; text-decoration:none;"><i class="fa-solid fa-chart-line"></i> Thống Kê</a>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <?php if (isset($_SESSION['user'])): ?>
                <span style="color: #ffb703; font-size:14px; font-weight:700;"><i class="fa-solid fa-user-shield"></i> Admin: <?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></span>
                <a href="index.php?action=admin&sub=register" style="background:#2ec4b6; color:white; padding:6px 12px; border-radius:6px; font-size:13px; font-weight:700; text-decoration:none;"><i class="fa-solid fa-user-plus"></i> Tạo Thêm Admin</a>
                <a href="index.php?action=logout" style="background:#e63946; color:white; padding:6px 12px; border-radius:6px; font-size:13px; font-weight:700; text-decoration:none;"><i class="fa-solid fa-right-from-bracket"></i> Đăng Xuất</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <div class="alert-msg alert-danger"><i class="fa-solid fa-trash"></i> Đã xóa bình luận khỏi hệ thống!</div>
    <?php endif; ?>

    <div class="admin-card">
        <div class="admin-header-flex" style="margin-bottom: 20px;">
            <div>
                <h2 style="font-size: 24px; font-weight: 900; color: var(--primary-color);">
                    <i class="fa-solid fa-comments" style="color: var(--accent-color);"></i> QUẢN LÝ BÌNH LUẬN & ĐÁNH GIÁ SẢN PHẨM
                </h2>
                <p style="color: var(--text-muted); font-size: 14px;">Duyệt và xóa các bình luận, phản hồi hoặc đánh giá sao từ khách hàng</p>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Tên Áo Bóng Đá</th>
                        <th>Người Bình Luận</th>
                        <th>Nội Dung Bình Luận</th>
                        <th style="text-align: center;">Đánh Giá</th>
                        <th>Thời Gian</th>
                        <th style="text-align: center; width: 100px;">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $c): ?>
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: var(--text-muted);">#<?php echo $c['id']; ?></td>
                                <td style="font-weight: 800; color: var(--primary-color);">
                                    <a href="index.php?action=detail&id=<?php echo $c['product_id']; ?>" target="_blank" style="text-decoration:none; color: var(--primary-color);">
                                        <i class="fa-solid fa-shirt" style="color: #2ec4b6; margin-right: 6px;"></i>
                                        <?php echo htmlspecialchars($c['product_name'] ?: ('Sản phẩm #' . $c['product_id'])); ?>
                                    </a>
                                </td>
                                <td style="font-weight: 700; color: #415a77;"><?php echo htmlspecialchars($c['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($c['content']); ?></td>
                                <td style="text-align: center; color: #ffb703; white-space: nowrap;">
                                    <?php 
                                    $r = (int)($c['rating'] ?? 5);
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo ($i <= $r) ? '★' : '☆';
                                    }
                                    ?>
                                </td>
                                <td style="font-size: 12px; color: var(--text-muted);"><?php echo htmlspecialchars($c['created_at']); ?></td>
                                <td style="text-align: center;">
                                    <a href="index.php?action=admin&sub=comment_delete&id=<?php echo $c['id']; ?>" class="btn-admin btn-admin-delete" onclick="return confirm('Bạn có chắc muốn xóa bình luận này?')" style="font-size: 12px; padding: 6px 12px;">
                                        <i class="fa-solid fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 25px; color: var(--text-muted);">Chưa có bình luận nào trên hệ thống.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

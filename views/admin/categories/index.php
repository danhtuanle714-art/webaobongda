<?php
// View Admin Danh Sách Danh Mục (views/admin/categories/index.php) - LAB 4 Bài 1
?>

<div class="container section">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; background: #0d1b2a; padding: 15px 20px; border-radius: 10px; color: white;">
        <div style="display: flex; gap: 20px; align-items: center;">
            <a href="index.php?action=admin&sub=category_list" style="color: var(--accent-color); font-weight:700; text-decoration:none;"><i class="fa-solid fa-folder"></i> Quản Lý Danh Mục</a> | 
            <a href="index.php?action=admin&sub=product_list" style="color: white; font-weight:600; text-decoration:none;"><i class="fa-solid fa-shirt"></i> Quản Lý Sản Phẩm</a>
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

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
        <div class="alert-msg alert-success"><i class="fa-solid fa-check"></i> Cập nhật danh mục thành công!</div>
    <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <div class="alert-msg alert-danger"><i class="fa-solid fa-trash"></i> Đã xóa danh mục khỏi hệ thống!</div>
    <?php endif; ?>

    <?php if (!empty($message)): ?>
        <div class="alert-msg alert-<?php echo $msgType ?? 'success'; ?>"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
        <!-- FORM THÊM DANH MỤC (BÀI 1: THÊM) -->
        <div class="admin-card">
            <h3 style="font-size: 20px; font-weight: 800; color: var(--primary-color); margin-bottom: 20px;">
                <i class="fa-solid fa-plus"></i> Thêm Danh Mục Mới
            </h3>
            <form action="index.php?controller=admin&action=category_list" method="POST">
                <div class="form-group">
                    <label for="name">Tên Danh Mục Áo Bóng Đá:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Ví dụ: Áo Đấu Trẻ / Đấu Phủi" required>
                </div>
                <div class="form-group">
                    <label for="description">Mô Tả Danh Mục:</label>
                    <textarea id="description" name="description" class="form-control" rows="3" placeholder="Mô tả chi tiết loại danh mục..."></textarea>
                </div>
                <button type="submit" name="btn_add_category" class="btn-admin btn-admin-add" style="width: 100%; justify-content: center; padding: 12px;">
                    <i class="fa-solid fa-plus"></i> THÊM DANH MỤC
                </button>
            </form>
        </div>

        <!-- BẢNG DANH SÁCH DANH MỤC (BÀI 1: XEM, SỬA, XÓA) -->
        <div class="admin-card">
            <h3 style="font-size: 20px; font-weight: 800; color: var(--primary-color); margin-bottom: 20px;">
                <i class="fa-solid fa-list"></i> Danh Sách Danh Mục
            </h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Danh Mục</th>
                        <th>Mô Tả</th>
                        <th style="text-align: center;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td><strong>#<?php echo $cat['id']; ?></strong></td>
                            <td style="font-weight: 700; color: var(--primary-color);"><?php echo htmlspecialchars($cat['name']); ?></td>
                            <td style="font-size: 13px; color: var(--text-muted);"><?php echo htmlspecialchars($cat['description']); ?></td>
                            <td style="text-align: center; white-space: nowrap;">
                                <!-- SỬA DANH MỤC -->
                                <a href="index.php?controller=admin&action=category_edit&id=<?php echo $cat['id']; ?>" class="btn-admin btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Sửa
                                </a>
                                <!-- XÓA DANH MỤC -->
                                <a href="index.php?controller=admin&action=category_delete&id=<?php echo $cat['id']; ?>" class="btn-admin btn-admin-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục \'<?php echo htmlspecialchars($cat['name']); ?>\' không?');">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

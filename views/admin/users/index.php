<?php
// View Admin Quản Lý Người Dùng (views/admin/users/index.php) - Ý 4.4
?>

<div class="container section">
    <!-- BAR TIÊU ĐỀ ADMIN -->
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; background: #0d1b2a; padding: 15px 20px; border-radius: 10px; color: white; flex-wrap: wrap;">
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <a href="index.php?action=admin&sub=category_list" style="color: white; font-weight:600; text-decoration:none;"><i class="fa-solid fa-folder"></i> Quản Lý Danh Mục</a> | 
            <a href="index.php?action=admin&sub=product_list" style="color: white; font-weight:600; text-decoration:none;"><i class="fa-solid fa-shirt"></i> Quản Lý Sản Phẩm</a> | 
            <a href="index.php?action=admin&sub=user_list" style="color: var(--accent-color); font-weight:800; text-decoration:none;"><i class="fa-solid fa-users"></i> Quản Lý Người Dùng</a> | 
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

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'role_updated'): ?>
        <div class="alert-msg alert-success"><i class="fa-solid fa-check"></i> Cập nhật vai trò người dùng thành công!</div>
    <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <div class="alert-msg alert-danger"><i class="fa-solid fa-trash"></i> Đã xóa tài khoản thành công!</div>
    <?php endif; ?>

    <div class="admin-card">
        <div class="admin-header-flex" style="margin-bottom: 20px;">
            <div>
                <h2 style="font-size: 24px; font-weight: 900; color: var(--primary-color);">
                    <i class="fa-solid fa-users-gear" style="color: var(--accent-color);"></i> QUẢN LÝ NGƯỜI DÙNG & PHÂN QUYỀN
                </h2>
                <p style="color: var(--text-muted); font-size: 14px;">Xem danh sách thành viên, cập nhật quyền Admin / Khách hàng và quản lý tài khoản</p>
            </div>
            <a href="index.php?action=admin&sub=register" class="btn-admin btn-admin-add" style="padding: 10px 18px; font-size: 14px;">
                <i class="fa-solid fa-user-plus"></i> Thêm Admin Mới
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Họ Và Tên</th>
                        <th>Email Đăng Nhập</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                        <th style="text-align: center;">Vai Trò</th>
                        <th style="text-align: center; width: 180px;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: var(--text-muted);">#<?php echo $u['id']; ?></td>
                                <td style="font-weight: 800; color: var(--primary-color);">
                                    <i class="fa-solid fa-user-circle" style="color: #415a77; margin-right: 6px;"></i>
                                    <?php echo htmlspecialchars($u['fullname']); ?>
                                </td>
                                <td style="font-weight: 600; color: #2ec4b6;"><?php echo htmlspecialchars($u['email']); ?></td>
                                <td><?php echo htmlspecialchars($u['phone'] ?: 'Chưa cập nhật'); ?></td>
                                <td><?php echo htmlspecialchars($u['address'] ?: 'Chưa cập nhật'); ?></td>
                                <td style="text-align: center;">
                                    <form action="index.php?action=admin&sub=user_update_role" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                                        <select name="role" onchange="this.form.submit()" style="padding: 4px 10px; border-radius: 20px; font-weight: 800; font-size: 12px; border: 1px solid #cbd5e0; background: <?php echo ($u['role'] === 'admin') ? '#ffb703' : '#e2e8f0'; ?>; color: #0d1b2a; cursor: pointer;">
                                            <option value="user" <?php echo ($u['role'] === 'user') ? 'selected' : ''; ?>>Khách Hàng (user)</option>
                                            <option value="admin" <?php echo ($u['role'] === 'admin') ? 'selected' : ''; ?>>Quản Trị (admin)</option>
                                        </select>
                                    </form>
                                </td>
                                <td style="text-align: center;">
                                    <a href="index.php?action=admin&sub=user_delete&id=<?php echo $u['id']; ?>" class="btn-admin btn-admin-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')" style="font-size: 12px; padding: 6px 12px;">
                                        <i class="fa-solid fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 25px; color: var(--text-muted);">Chưa có dữ liệu thành viên.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

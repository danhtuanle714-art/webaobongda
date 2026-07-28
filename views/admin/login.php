<?php
// View Trang Đăng Nhập Quản Trị Viên (views/admin/login.php) - Phân hệ Admin
?>

<div class="container section">
    <div class="form-card" style="max-width: 500px;">
        <h2 class="form-title" style="color: var(--primary-color);">
            <i class="fa-solid fa-user-shield" style="color: var(--accent-color);"></i> ĐĂNG NHẬP QUẢN TRỊ VIÊN (ADMIN)
        </h2>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'registered'): ?>
            <div class="alert-msg alert-success" style="background:#d1e7dd; color:#0f5132; border-color:#badbcc; font-weight:700; margin-bottom:20px; padding:15px; border-radius:8px;">
                <i class="fa-solid fa-circle-check"></i> Đăng ký tài khoản Admin thành công! Vui lòng đăng nhập bên dưới.
            </div>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <div class="alert-msg <?php echo (strpos($message, 'thành công') !== false) ? 'alert-success' : 'alert-danger'; ?>" 
                 style="padding:15px; border-radius:8px; margin-bottom:20px; font-weight:700; 
                        <?php echo (strpos($message, 'thành công') !== false) ? 'background:#d1e7dd; color:#0f5132;' : 'background:#f8d7da; color:#842029;'; ?>">
                <i class="fa-solid <?php echo (strpos($message, 'thành công') !== false) ? 'fa-circle-check' : 'fa-triangle-exclamation'; ?>"></i> 
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=admin&sub=login" method="POST">
            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i> Email Admin:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Ví dụ: admin@gmail.com hoặc minh.nguyen@gmail.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="password"><i class="fa-solid fa-lock"></i> Mật khẩu Admin:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu Admin (mặc định: 123456)..." required>
            </div>

            <button type="submit" class="btn-submit" style="background: var(--accent-color); color: var(--primary-color); font-weight:800; font-size:16px;">
                <i class="fa-solid fa-right-to-bracket"></i> ĐĂNG NHẬP VÀO ADMIN
            </button>
        </form>

        <div style="text-align: center; margin-top: 25px; font-size: 14px; color: var(--text-muted);">
            Chưa có tài khoản Admin? <a href="index.php?action=admin&sub=register" style="color: var(--accent-hover); font-weight: 700;">Đăng ký tài khoản Admin mới</a>
        </div>
    </div>
</div>

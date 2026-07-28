<?php
// View Trang Đăng Ký Quản Trị Viên (views/admin/register.php) - Phân hệ Admin
?>

<div class="container section">
    <div class="form-card" style="max-width: 500px;">
        <h2 class="form-title" style="color: var(--primary-color);">
            <i class="fa-solid fa-user-plus" style="color: var(--accent-color);"></i> ĐĂNG KÝ TÀI KHOẢN ADMIN MỚI
        </h2>

        <?php if (!empty($message)): ?>
            <div class="alert-msg <?php echo ($isSuccess) ? 'alert-success' : 'alert-danger'; ?>" 
                 style="padding:15px; border-radius:8px; margin-bottom:20px; font-weight:700; 
                        <?php echo ($isSuccess) ? 'background:#d1e7dd; color:#0f5132;' : 'background:#f8d7da; color:#842029;'; ?>">
                <i class="fa-solid <?php echo ($isSuccess) ? 'fa-circle-check' : 'fa-triangle-exclamation'; ?>"></i> 
                <?php echo htmlspecialchars($message); ?>
            </div>

            <?php if ($isSuccess): ?>
                <div style="text-align:center; margin-bottom:20px;">
                    <a href="index.php?action=admin&sub=login&msg=registered" class="btn-submit" style="display:inline-block; text-decoration:none; background:var(--accent-color); color:var(--primary-color);">
                        <i class="fa-solid fa-right-to-bracket"></i> ĐĂNG NHẬP ADMIN NGAY
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (!$isSuccess): ?>
        <form action="index.php?action=admin&sub=register" method="POST">
            <div class="form-group">
                <label for="fullname"><i class="fa-solid fa-user"></i> Họ tên Admin:</label>
                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Ví dụ: Quản Trị Viên Nguyễn Văn A" value="<?php echo htmlspecialchars($_POST['fullname'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i> Email Admin:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Ví dụ: admin@gmail.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone"><i class="fa-solid fa-phone"></i> Số điện thoại:</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Ví dụ: 0988123456" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="password"><i class="fa-solid fa-lock"></i> Mật khẩu Admin:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Tối thiểu 6 ký tự..." required>
            </div>

            <button type="submit" class="btn-submit" style="background: #2ec4b6; color: white; font-weight:800; font-size:16px;">
                <i class="fa-solid fa-user-plus"></i> HOÀN TẤT ĐĂNG KÝ ADMIN
            </button>
        </form>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 25px; font-size: 14px; color: var(--text-muted);">
            Đã có tài khoản Admin? <a href="index.php?action=admin&sub=login" style="color: var(--accent-hover); font-weight: 700;">Đăng nhập Admin ngay</a>
        </div>
    </div>
</div>

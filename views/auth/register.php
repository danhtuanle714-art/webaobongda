<?php
// View Trang Đăng Ký (views/auth/register.php) - Bài 1
?>

<div class="container section">
    <div class="form-card">
        <h2 class="form-title"><i class="fa-solid fa-user-plus"></i> ĐĂNG KÝ TÀI KHOẢN MỚI</h2>

        <?php if (!empty($message)): ?>
            <div class="alert-msg <?php echo ($isSuccess) ? 'alert-success' : 'alert-danger'; ?>" 
                 style="padding:15px; border-radius:8px; margin-bottom:20px; font-weight:700; 
                        <?php echo ($isSuccess) ? 'background:#d1e7dd; color:#0f5132;' : 'background:#f8d7da; color:#842029;'; ?>">
                <i class="fa-solid <?php echo ($isSuccess) ? 'fa-circle-check' : 'fa-triangle-exclamation'; ?>"></i> 
                <?php echo htmlspecialchars($message); ?>
            </div>

            <?php if ($isSuccess): ?>
                <div style="text-align:center; margin-bottom:20px;">
                    <a href="index.php?action=login&msg=registered" class="btn-submit" style="display:inline-block; text-decoration:none; background:var(--accent-color); color:var(--primary-color);">
                        <i class="fa-solid fa-right-to-bracket"></i> ĐĂNG NHẬP NGAY BÂY GIỜ
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (!$isSuccess): ?>
        <form action="index.php?action=register" method="POST">
            <div class="form-group">
                <label for="fullname"><i class="fa-solid fa-user"></i> Họ và tên người dùng:</label>
                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Ví dụ: Nguyễn Văn Minh" value="<?php echo htmlspecialchars($_POST['fullname'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i> Địa chỉ Email liên hệ:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Ví dụ: minh.nguyen@gmail.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone"><i class="fa-solid fa-phone"></i> Số điện thoại:</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Ví dụ: 0912345678" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="password"><i class="fa-solid fa-lock"></i> Mật khẩu bảo mật:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Tối thiểu 6 ký tự..." required>
            </div>

            <div style="margin-bottom: 20px; font-size: 13px; color: var(--text-muted);">
                Bằng việc bấm nút Đăng ký, bạn đồng ý với <a href="#" style="color: var(--accent-hover);">Điều khoản sử dụng dịch vụ</a> của Web Áo Bóng Đá.
            </div>

            <button type="submit" class="btn-submit" style="background: var(--accent-color); color: var(--primary-color);"><i class="fa-solid fa-user-plus"></i> HOÀN TẤT ĐĂNG KÝ TÀI KHOẢN</button>
        </form>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 25px; font-size: 14px; color: var(--text-muted);">
            Đã có tài khoản? <a href="index.php?action=login" style="color: var(--accent-hover); font-weight: 700;">Đăng nhập ngay</a>
        </div>
    </div>
</div>

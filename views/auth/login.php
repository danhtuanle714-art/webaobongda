<?php
// View Trang Đăng Nhập (views/auth/login.php) - Bài 1
?>

<div class="container section">
    <div class="form-card">
        <h2 class="form-title"><i class="fa-solid fa-right-to-bracket"></i> ĐĂNG NHẬP THÀNH VIÊN</h2>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'registered'): ?>
            <div class="alert-msg alert-success" style="background:#d1e7dd; color:#0f5132; border-color:#badbcc; font-weight:700; margin-bottom:20px; padding:15px; border-radius:8px;">
                <i class="fa-solid fa-circle-check"></i> Đăng ký tài khoản thành công! Bạn có thể đăng nhập ngay bây giờ.
            </div>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <div class="alert-msg <?php echo (strpos($message, 'thành công') !== false || strpos($message, '🎉') !== false) ? 'alert-success' : 'alert-danger'; ?>" 
                 style="padding:15px; border-radius:8px; margin-bottom:20px; font-weight:700; 
                        <?php echo (strpos($message, 'thành công') !== false || strpos($message, '🎉') !== false) ? 'background:#d1e7dd; color:#0f5132;' : 'background:#f8d7da; color:#842029;'; ?>">
                <i class="fa-solid <?php echo (strpos($message, 'thành công') !== false || strpos($message, '🎉') !== false) ? 'fa-circle-check' : 'fa-triangle-exclamation'; ?>"></i> 
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=login" method="POST">
            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i> Địa chỉ Email / Tên đăng nhập:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Ví dụ: minh.nguyen@gmail.com hoặc user@gmail.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="password"><i class="fa-solid fa-lock"></i> Mật khẩu:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu (ví dụ: 123456)..." required>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-size: 14px;">
                <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
                    <input type="checkbox" name="remember" checked> Ghi nhớ đăng nhập
                </label>
                <a href="#" style="color: var(--accent-hover); font-weight: 600;">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="btn-submit"><i class="fa-solid fa-right-to-bracket"></i> ĐĂNG NHẬP NGAY</button>
        </form>

        <div style="text-align: center; margin-top: 25px; font-size: 14px; color: var(--text-muted);">
            Chưa có tài khoản? <a href="index.php?action=register" style="color: var(--accent-hover); font-weight: 700;">Đăng ký tài khoản mới</a>
        </div>
    </div>
</div>

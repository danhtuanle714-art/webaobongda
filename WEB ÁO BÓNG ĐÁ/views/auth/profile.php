<?php
// View Trang Cập Nhật Thông Tin Cá Nhân (views/auth/profile.php) - Bài 1
?>

<div class="container section">
    <div class="form-card" style="max-width: 600px;">
        <h2 class="form-title"><i class="fa-solid fa-id-card"></i> CẬP NHẬT THÔNG TIN TÀI KHOẢN</h2>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'login_success'): ?>
            <div class="alert-msg alert-success">
                <i class="fa-solid fa-circle-check"></i> Đăng nhập thành công! Chào mừng <strong><?php echo htmlspecialchars($user['fullname']); ?></strong> trở lại.
            </div>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <div class="alert-msg alert-success">
                <i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=profile" method="POST">
            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i> Địa chỉ Email (Không thể thay đổi):</label>
                <input type="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" disabled style="background:#e9ecef;">
            </div>

            <div class="form-group">
                <label for="fullname"><i class="fa-solid fa-user"></i> Họ và tên người dùng:</label>
                <input type="text" id="fullname" name="fullname" class="form-control" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone"><i class="fa-solid fa-phone"></i> Số điện thoại nhận hàng:</label>
                <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" placeholder="Nhập số điện thoại...">
            </div>

            <div class="form-group">
                <label for="address"><i class="fa-solid fa-location-dot"></i> Địa chỉ giao hàng mặc định:</label>
                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Nhập số nhà, tên đường, phường/xã, quận/huyện..."><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 25px;">
                <button type="submit" class="btn-submit" style="background: var(--accent-color); color: var(--primary-color);"><i class="fa-solid fa-floppy-disk"></i> LƯU THAY ĐỔI HỒ SƠ</button>
                <a href="index.php?action=logout" class="btn-submit" style="background: var(--danger-color); text-align: center; display: inline-block;"><i class="fa-solid fa-right-from-bracket"></i> ĐĂNG XUẤT</a>
            </div>
        </form>
    </div>
</div>

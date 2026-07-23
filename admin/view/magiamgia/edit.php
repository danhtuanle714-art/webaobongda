
<div style="padding: 30px; max-width: 700px;">
    <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 24px;">
        <a href="index.php?act=magiamgia-list" class="btn-sm btn-view"><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class="page-title" style="margin:0;">Sửa Mã Giảm Giá</h1>
    </div>

    <?php if (!empty($_SESSION['admin_error'])): ?>
        <div class="admin-alert danger"><?php echo htmlspecialchars($_SESSION['admin_error']); unset($_SESSION['admin_error']); ?></div>
    <?php endif; ?>

    <div class="card-admin">
        <form method="POST" action="index.php?act=magiamgia-edit&id=<?php echo $coupon['id']; ?>">
            <div class="form-group">
                <label class="form-label">Mã code <span style="color:#ef4444">*</span></label>
                <input type="text" name="code" class="form-control"
                       value="<?php echo htmlspecialchars($coupon['code']); ?>"
                       required style="text-transform:uppercase;font-weight:700;letter-spacing:1px;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
                <div class="form-group">
                    <label class="form-label">Số tiền giảm (đ) <span style="color:#ef4444">*</span></label>
                    <input type="number" name="discount" class="form-control"
                           value="<?php echo htmlspecialchars($coupon['discount']); ?>"
                           min="1000" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Đơn hàng tối thiểu (đ)</label>
                    <input type="number" name="min_order" class="form-control"
                           value="<?php echo htmlspecialchars($coupon['min_order']); ?>"
                           min="0">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
                <div class="form-group">
                    <label class="form-label">Hạn sử dụng <span style="color:#ef4444">*</span></label>
                    <input type="text" name="expiry_date" class="form-control"
                           value="<?php echo htmlspecialchars($coupon['expiry_date']); ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="1" <?php echo $coupon['status'] == 1 ? 'selected' : ''; ?>>Kích hoạt</option>
                        <option value="0" <?php echo $coupon['status'] == 0 ? 'selected' : ''; ?>>Bị khóa</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 8px;">
                <button type="submit" class="btn-sm btn-edit" style="padding:11px 28px;font-size:14px;">
                    <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
                </button>
                <a href="index.php?act=magiamgia-list" class="btn-sm btn-view" style="padding:11px 24px;font-size:14px;">
                    Hủy
                </a>
            </div>
        </form>
    </div>
</div>


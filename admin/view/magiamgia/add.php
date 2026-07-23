
<div style="padding: 30px; max-width: 700px;">
    <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 24px;">
        <a href="index.php?act=magiamgia-list" class="btn-sm btn-view"><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class="page-title" style="margin:0;">Thêm Mã Giảm Giá</h1>
    </div>

    <?php if (!empty($_SESSION['admin_error'])): ?>
        <div class="admin-alert danger"><?php echo htmlspecialchars($_SESSION['admin_error']); unset($_SESSION['admin_error']); ?></div>
    <?php endif; ?>

    <div class="card-admin">
        <form method="POST" action="index.php?act=magiamgia-add">
            <div class="form-group">
                <label class="form-label">Mã code <span style="color:#ef4444">*</span></label>
                <input type="text" name="code" class="form-control" placeholder="VD: GIAM100, SUMMER2026..."
                       value="<?php echo isset($_POST['code']) ? htmlspecialchars($_POST['code']) : ''; ?>"
                       required style="text-transform:uppercase;">
                <small style="color:#94a3b8;font-size:12px;margin-top:4px;display:block;">Mã sẽ tự động viết hoa khi khách nhập.</small>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
                <div class="form-group">
                    <label class="form-label">Số tiền giảm (đ) <span style="color:#ef4444">*</span></label>
                    <input type="number" name="discount" class="form-control" placeholder="VD: 100000"
                           value="<?php echo isset($_POST['discount']) ? htmlspecialchars($_POST['discount']) : ''; ?>"
                           min="1000" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Đơn hàng tối thiểu (đ)</label>
                    <input type="number" name="min_order" class="form-control" placeholder="VD: 500000"
                           value="<?php echo isset($_POST['min_order']) ? htmlspecialchars($_POST['min_order']) : '0'; ?>"
                           min="0">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
                <div class="form-group">
                    <label class="form-label">Hạn sử dụng <span style="color:#ef4444">*</span></label>
                    <input type="text" name="expiry_date" class="form-control" placeholder="DD-MM-YYYY"
                           value="<?php echo isset($_POST['expiry_date']) ? htmlspecialchars($_POST['expiry_date']) : '31-12-2026'; ?>"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="1">Kích hoạt</option>
                        <option value="0">Bị khóa</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 8px;">
                <button type="submit" class="btn-sm btn-success" style="padding:11px 28px;font-size:14px;">
                    <i class="fa-solid fa-plus"></i> Thêm mã
                </button>
                <a href="index.php?act=magiamgia-list" class="btn-sm btn-view" style="padding:11px 24px;font-size:14px;">
                    Hủy
                </a>
            </div>
        </form>
    </div>
</div>


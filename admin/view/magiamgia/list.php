
<div style="padding: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h1 class="page-title" style="margin:0;">Quản Lý Mã Giảm Giá</h1>
        <a href="index.php?act=magiamgia-add" class="btn-sm btn-success" style="padding:10px 20px;font-size:14px;">
            <i class="fa-solid fa-plus"></i> Thêm mã mới
        </a>
    </div>

    <?php if (!empty($_SESSION['admin_success'])): ?>
        <div class="admin-alert success"><?php echo htmlspecialchars($_SESSION['admin_success']); unset($_SESSION['admin_success']); ?></div>
    <?php endif; ?>

    <div class="card-admin">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mã code</th>
                    <th>Giảm tiền</th>
                    <th>Đơn tối thiểu</th>
                    <th>Hạn sử dụng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($ds_magiamgia)): foreach ($ds_magiamgia as $i => $m): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td>
                        <span style="font-family:monospace;font-weight:800;font-size:15px;
                                     background:#f1f5f9;padding:4px 10px;border-radius:6px;
                                     color:#0f172a;letter-spacing:1.5px;">
                            <?php echo htmlspecialchars($m['code']); ?>
                        </span>
                    </td>
                    <td style="color:#dc2626;font-weight:700;">
                        -<?php echo number_format($m['discount'], 0, ',', '.'); ?>đ
                    </td>
                    <td><?php echo number_format($m['min_order'], 0, ',', '.'); ?>đ</td>
                    <td><?php echo htmlspecialchars($m['expiry_date']); ?></td>
                    <td>
                        <?php if ($m['status'] == 1): ?>
                            <span class="badge badge-done">Kích hoạt</span>
                        <?php else: ?>
                            <span class="badge badge-cancel">Bị khóa</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?act=magiamgia-edit&id=<?php echo $m['id']; ?>" class="btn-sm btn-edit">
                            <i class="fa-solid fa-pen"></i> Sửa
                        </a>
                        <a href="index.php?act=magiamgia-delete&id=<?php echo $m['id']; ?>" class="btn-sm btn-delete"
                           onclick="return confirm('Xác nhận xóa mã giảm giá này?')">
                            <i class="fa-solid fa-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" style="text-align:center;color:#94a3b8;padding:40px;">
                        <i class="fa-solid fa-ticket" style="font-size:32px;display:block;margin-bottom:10px;color:#cbd5e1;"></i>
                        Chưa có mã giảm giá nào.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


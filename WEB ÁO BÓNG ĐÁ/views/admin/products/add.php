<?php
// View Admin Thêm Áo Bóng Đá (views/admin/products/add.php) - LAB 4 Bài 2
?>

<div class="container section">
    <div class="form-card" style="max-width: 700px;">
        <h2 class="form-title"><i class="fa-solid fa-plus-circle"></i> THÊM MẪU ÁO BÓNG ĐÁ MỚI</h2>

        <?php if (!empty($message)): ?>
            <div class="alert-msg alert-danger"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=admin&action=product_add" method="POST">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group" style="grid-column: span 2;">
                    <label for="name">Tên Áo Bóng Đá Thi Đấu:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Ví dụ: Áo Chelsea Sân Nhà 2024/25" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Danh Mục Giải Đấu / Đội Bóng:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fabric">Chất Liệu Vải:</label>
                    <input type="text" id="fabric" name="fabric" class="form-control" value="Thun lạnh co giãn 4 chiều" placeholder="Thun lạnh, Thun mè...">
                </div>

                <div class="form-group">
                    <label for="price">Giá Gốc (VNĐ):</label>
                    <input type="number" id="price" name="price" class="form-control" placeholder="220000" step="1000" required>
                </div>

                <div class="form-group">
                    <label for="sale_price">Giá Khuyến Mãi (VNĐ):</label>
                    <input type="number" id="sale_price" name="sale_price" class="form-control" placeholder="185000 (Để 0 nếu không giảm)" step="1000">
                </div>
            </div>

            <div class="form-group">
                <label for="description">Mô Tả Sản Phẩm Chi Tiết:</label>
                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Mô tả phong cách thiết kế, đường may, hoa văn chìm..."></textarea>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" checked>
                <label for="is_featured" style="margin-bottom: 0; cursor: pointer;">Hiển thị làm sản phẩm nổi bật trên Trang Chủ</label>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 25px;">
                <button type="submit" class="btn-submit" style="background: var(--success-color);"><i class="fa-solid fa-plus-circle"></i> THÊM ÁO BÓNG ĐÁ</button>
                <a href="index.php?controller=admin&action=product_list" class="btn-submit" style="background: var(--text-muted); text-align: center; display: inline-block;"><i class="fa-solid fa-xmark"></i> HỦY BỎ</a>
            </div>
        </form>
    </div>
</div>

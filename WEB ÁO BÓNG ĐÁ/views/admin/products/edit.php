<?php
// View Admin Sửa Áo Bóng Đá (views/admin/products/edit.php) - LAB 4 Bài 2
?>

<div class="container section">
    <div class="form-card" style="max-width: 700px;">
        <h2 class="form-title"><i class="fa-solid fa-pen-to-square"></i> CẬP NHẬT ÁO BÓNG ĐÁ #<?php echo $product['id']; ?></h2>

        <?php if (!empty($message)): ?>
            <div class="alert-msg alert-danger"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=admin&action=product_edit&id=<?php echo $product['id']; ?>" method="POST">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group" style="grid-column: span 2;">
                    <label for="name">Tên Áo Bóng Đá Thi Đấu:</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Danh Mục Giải Đấu / Đội Bóng:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fabric">Chất Liệu Vải:</label>
                    <input type="text" id="fabric" name="fabric" class="form-control" value="<?php echo htmlspecialchars($product['fabric'] ?? 'Thun lạnh cao cấp'); ?>">
                </div>

                <div class="form-group">
                    <label for="price">Giá Gốc (VNĐ):</label>
                    <input type="number" id="price" name="price" class="form-control" value="<?php echo (int)$product['price']; ?>" step="1000" required>
                </div>

                <div class="form-group">
                    <label for="sale_price">Giá Khuyến Mãi (VNĐ):</label>
                    <input type="number" id="sale_price" name="sale_price" class="form-control" value="<?php echo (int)$product['sale_price']; ?>" step="1000">
                </div>
            </div>

            <div class="form-group">
                <label for="description">Mô Tả Sản Phẩm Chi Tiết:</label>
                <textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" <?php echo ($product['is_featured'] == 1) ? 'checked' : ''; ?>>
                <label for="is_featured" style="margin-bottom: 0; cursor: pointer;">Hiển thị làm sản phẩm nổi bật trên Trang Chủ</label>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 25px;">
                <button type="submit" class="btn-submit" style="background: #0284c7;"><i class="fa-solid fa-floppy-disk"></i> LƯU CẬP NHẬT</button>
                <a href="index.php?controller=admin&action=product_list" class="btn-submit" style="background: var(--text-muted); text-align: center; display: inline-block;"><i class="fa-solid fa-xmark"></i> HỦY BỎ</a>
            </div>
        </form>
    </div>
</div>

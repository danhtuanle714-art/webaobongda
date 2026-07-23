<?php
// View Admin Sửa Danh Mục (views/admin/categories/edit.php) - LAB 4 Bài 1
?>

<div class="container section">
    <div class="form-card">
        <h2 class="form-title"><i class="fa-solid fa-pen-to-square"></i> CẬP NHẬT DANH MỤC #<?php echo $category['id']; ?></h2>

        <?php if (!empty($message)): ?>
            <div class="alert-msg alert-danger"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=admin&action=category_edit&id=<?php echo $category['id']; ?>" method="POST">
            <div class="form-group">
                <label for="name">Tên Danh Mục Áo Bóng Đá:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($category['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Mô Tả Danh Mục:</label>
                <textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($category['description']); ?></textarea>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 25px;">
                <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> LƯU CẬP NHẬT</button>
                <a href="index.php?controller=admin&action=category_list" class="btn-submit" style="background: var(--text-muted); text-align: center; display: inline-block;"><i class="fa-solid fa-xmark"></i> HỦY BỎ</a>
            </div>
        </form>
    </div>
</div>

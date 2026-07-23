<?php
// View Trang Sản Phẩm (views/product/index.php) - Bài 2 & Tìm kiếm
?>

<div class="container section">
    <div class="shop-layout">
        <!-- SIDEBAR DANH MỤC (BÀI 2: LẤY DANH SÁCH DANH MỤC) -->
        <aside class="sidebar">
            <h3 class="sidebar-title"><i class="fa-solid fa-list-check"></i> Lọc Theo Danh Mục</h3>
            <ul class="sidebar-menu">
                <li>
                    <a href="index.php?controller=product" class="<?php echo (!isset($_GET['category_id']) && !isset($_GET['keyword'])) ? 'active' : ''; ?>">
                        <span>Tất Cả Áo Bóng Đá</span>
                    </a>
                </li>
                <?php foreach ($categories as $cat): ?>
                    <li>
                        <a href="index.php?controller=product&category_id=<?php echo $cat['id']; ?>" class="<?php echo (isset($_GET['category_id']) && $_GET['category_id'] == $cat['id']) ? 'active' : ''; ?>">
                            <span><?php echo htmlspecialchars($cat['name']); ?></span>
                            <i class="fa-solid fa-chevron-right" style="font-size:12px;"></i>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <!-- MAIN PRODUCTS GRID (BÀI 2: LẤY DANH SÁCH SẢN PHẨM & SEARCH) -->
        <main>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; background: white; padding: 15px 20px; border-radius: 10px; box-shadow: var(--card-shadow);">
                <h2 style="font-size: 20px; font-weight: 800; color: var(--primary-color);">
                    <?php 
                    if (!empty($keyword)) {
                        echo "<i class=\"fa-solid fa-magnifying-glass\" style=\"color:var(--accent-hover);\"></i> Kết quả tìm kiếm: \"".htmlspecialchars($keyword)."\"";
                    } elseif ($currentCategory) {
                        echo "<i class=\"fa-solid fa-tag\" style=\"color:var(--accent-hover);\"></i> " . htmlspecialchars($currentCategory['name']);
                    } else {
                        echo "<i class=\"fa-solid fa-boxes-stacked\" style=\"color:var(--accent-hover);\"></i> TẤT CẢ SẢN PHẨM ÁO BÓNG ĐÁ";
                    }
                    ?>
                </h2>
                <span style="color: var(--text-muted); font-weight: 600; font-size: 14px;">Tìm thấy <?php echo count($products); ?> mẫu áo</span>
            </div>

            <?php if (empty($products)): ?>
                <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 12px; box-shadow: var(--card-shadow);">
                    <i class="fa-solid fa-magnifying-glass-minus" style="font-size: 54px; color: var(--text-muted); margin-bottom: 15px;"></i>
                    <p style="font-size: 18px; color: var(--text-muted); font-weight: 600;">Không tìm thấy sản phẩm nào khớp với tìm kiếm của bạn.</p>
                    <a href="index.php?controller=product" class="btn-hero" style="margin-top: 15px; padding: 10px 24px; font-size: 14px;">
                        <i class="fa-solid fa-rotate-left"></i> Xem Tất Cả Sản Phẩm
                    </a>
                </div>
            <?php else: ?>
                <div class="product-grid">
                    <?php foreach ($products as $prod): ?>
                        <div class="product-card">
                            <?php if ($prod['sale_price'] > 0 && $prod['sale_price'] < $prod['price']): ?>
                                <span class="badge-sale">GIẢM <?php echo round((($prod['price'] - $prod['sale_price']) / $prod['price']) * 100); ?>%</span>
                            <?php endif; ?>

                            <div class="product-img-wrapper">
                                <?php echo renderJerseySvg($prod['name']); ?>
                            </div>

                            <div class="product-info">
                                <span class="product-cat"><?php echo htmlspecialchars($prod['category_name'] ?? 'Áo đấu'); ?></span>
                                <h3 class="product-title"><?php echo htmlspecialchars($prod['name']); ?></h3>
                                
                                <div class="product-price">
                                    <?php if ($prod['sale_price'] > 0): ?>
                                        <span class="current-price"><?php echo number_format($prod['sale_price'], 0, ',', '.'); ?>đ</span>
                                        <span class="old-price"><?php echo number_format($prod['price'], 0, ',', '.'); ?>đ</span>
                                    <?php else: ?>
                                        <span class="current-price"><?php echo number_format($prod['price'], 0, ',', '.'); ?>đ</span>
                                    <?php endif; ?>
                                </div>

                                <a href="index.php?controller=product&action=detail&id=<?php echo $prod['id']; ?>" class="btn-detail"><i class="fa-solid fa-eye"></i> Xem Chi Tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>

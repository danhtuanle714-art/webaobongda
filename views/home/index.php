<?php
// View Trang Chủ (views/home/index.php) - Bài 1
?>

<!-- HERO BANNER (VỊ TRÍ HERO) -->
<?php if (!empty($heroBanners)): $mainHero = $heroBanners[0]; ?>
<section class="hero-banner">
    <div class="container">
        <h1><?php echo htmlspecialchars($mainHero['title']); ?></h1>
        <p><?php echo htmlspecialchars($mainHero['subtitle']); ?></p>
        <a href="<?php echo htmlspecialchars($mainHero['link']); ?>" class="btn-hero"><i class="fa-solid fa-cart-shopping"></i> KHÁM PHÁ NGAY</a>
    </div>
</section>
<?php endif; ?>

<!-- BANNER QUẢNG CÁO PHỤ (VỊ TRÍ SUB & PROMO) -->
<section style="margin-top: -30px; position: relative; z-index: 10;">
    <div class="container">
        <div class="banner-promo-grid">
            <?php foreach ($subBanners as $sub): ?>
                <div class="banner-promo-box">
                    <div>
                        <h3><i class="fa-solid fa-bullhorn"></i> <?php echo htmlspecialchars($sub['title']); ?></h3>
                        <p><?php echo htmlspecialchars($sub['subtitle']); ?></p>
                        <a href="<?php echo htmlspecialchars($sub['link']); ?>" style="font-weight: 700; color: var(--accent-color); font-size: 14px;">
                            Xem chi tiết <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php foreach ($promoBanners as $promo): ?>
                <div class="banner-promo-box" style="border-left-color: var(--success-color);">
                    <div>
                        <h3 style="color: var(--success-color);"><i class="fa-solid fa-print"></i> <?php echo htmlspecialchars($promo['title']); ?></h3>
                        <p><?php echo htmlspecialchars($promo['subtitle']); ?></p>
                        <a href="<?php echo htmlspecialchars($promo['link']); ?>" style="font-weight: 700; color: var(--success-color); font-size: 14px;">
                            Đặt in ngay <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- DANH MỤC NỔI BẬT -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">DANH MỤC SẢN PHẨM</h2>
            <p class="section-subtitle">Lựa chọn giải đấu và phong cách áo đấu yêu thích của bạn</p>
        </div>

        <div class="category-grid">
            <?php foreach ($categoriesWithProducts as $cat): ?>
                <div class="category-card">
                    <div class="category-icon">
                        <?php 
                        if ($cat['id'] == 1) echo '<i class="fa-solid fa-trophy"></i>';
                        elseif ($cat['id'] == 2) echo '<i class="fa-solid fa-flag"></i>';
                        elseif ($cat['id'] == 3) echo '<i class="fa-solid fa-shirt"></i>';
                        else echo '<i class="fa-solid fa-snowflake"></i>';
                        ?>
                    </div>
                    <h3><?php echo htmlspecialchars($cat['name']); ?></h3>
                    <p><?php echo htmlspecialchars($cat['description']); ?></p>
                    <a href="index.php?controller=product&category_id=<?php echo $cat['id']; ?>" style="display:inline-block; margin-top: 15px; font-weight:700; color:var(--accent-hover);">Xem mẫu <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- SẢN PHẨM PHÂN THEO DANH MỤC (BÀI 1: HOÀN THIỆN LOAD SP THEO DANH MỤC) -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">SẢN PHẨM THEO DANH MỤC</h2>
            <p class="section-subtitle">Bộ sưu tập áo bóng đá được phân chia theo từng giải đấu và nhu cầu</p>
        </div>

        <?php foreach ($categoriesWithProducts as $catGroup): ?>
            <?php if (!empty($catGroup['products'])): ?>
                <div class="category-block">
                    <div class="category-block-title">
                        <span><i class="fa-solid fa-shirt" style="color: var(--accent-hover);"></i> <?php echo htmlspecialchars($catGroup['name']); ?></span>
                        <a href="index.php?controller=product&category_id=<?php echo $catGroup['id']; ?>" style="font-size: 14px; font-weight: 600; color: var(--accent-hover);">
                            Xem tất cả (<?php echo count($catGroup['products']); ?>+) <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </div>

                    <div class="product-grid">
                        <?php foreach ($catGroup['products'] as $prod): ?>
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
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>

<!-- KHỐI BÀI VIẾT / TIN TỨC MỚI (BÀI 1: HOÀN THIỆN LOAD BÀI VIẾT MỚI) -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">TIN TỨC & MẸO ÁO BÓNG ĐÁ</h2>
            <p class="section-subtitle">Cập nhật tin tức áo đấu mới nhất và kinh nghiệm bảo quản trang phục thể thao</p>
        </div>

        <div class="posts-grid">
            <?php foreach ($latestPosts as $post): ?>
                <div class="post-card">
                    <div class="post-img">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <div class="post-info">
                        <div class="post-date"><i class="fa-solid fa-calendar-days"></i> <?php echo date('d/m/Y', strtotime($post['created_at'])); ?></div>
                        <h3 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p class="post-summary"><?php echo htmlspecialchars($post['summary']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

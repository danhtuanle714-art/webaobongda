<?php
// View Trang Chi Tiết Sản Phẩm & Bình Luận (views/product/detail.php) - Bài 3 & Bài 2 Comment
if (isset($detail) && is_array($detail)) {
    if (isset($detail[0]) && is_array($detail[0])) {
        $detail = $detail[0];
    }
    $product = $detail;
}
if (!isset($product) || !is_array($product)) {
    $product = [];
}

$prodName   = htmlspecialchars($product['name'] ?? ($product['title'] ?? ($product['tensp'] ?? 'Áo Bóng Đá Thi Đấu')));
$catName    = htmlspecialchars($product['category_name'] ?? ($product['cat_name'] ?? 'Danh mục'));
$prodId     = (int)($product['id'] ?? 1);
$prodCatId  = (int)($product['category_id'] ?? ($product['idcategory'] ?? 1));
$prodPrice  = (float)($product['price'] ?? 0);
$prodSale   = (float)($product['sale_price'] ?? 0);
$prodDesc   = htmlspecialchars($product['description'] ?? 'Áo bóng đá thi đấu chất lượng cao, thoáng mát, in tên số sắc nét.');
$prodFabric = htmlspecialchars($product['fabric'] ?? 'Thun lạnh Thái Lan xịn co giãn 4 chiều');
?>

<div class="container section">
    <!-- BREADCRUMB -->
    <div style="margin-bottom: 20px; font-size: 14px; color: var(--text-muted);">
        <a href="index.php"><i class="fa-solid fa-house"></i> Trang chủ</a> / 
        <a href="index.php?action=product">Sản phẩm</a> / 
        <?php echo $tendm ?? '<a href="index.php?action=product&idcategory='.$prodCatId.'">'.$catName.'</a>'; ?> / 
        <span style="color: var(--primary-color); font-weight: 600;"><?php echo $prodName; ?></span>
    </div>

    <!-- KHỐI CHI TIẾT SẢN PHẨM (BÀI 3) -->
    <div class="product-detail-wrapper">
        <!-- HÌNH ẢNH SẢN PHẨM -->
        <div class="detail-img-box">
            <?php echo renderJerseySvg($prodName); ?>
        </div>

        <!-- THÔNG TIN SẢN PHẨM -->
        <div class="detail-info-box">
            <h1><?php echo $prodName; ?></h1>
            <div class="detail-meta">
                <span>Danh mục: <strong><?php echo $catName; ?></strong></span> | 
                <span>Mã SP: <strong>BD-00<?php echo $prodId; ?></strong></span> | 
                <span>Tình trạng: <strong style="color: var(--success-color);">Còn hàng trong kho</strong></span>
            </div>

            <!-- BẢNG GIÁ SẢN PHẨM -->
            <div class="detail-price-box">
                <?php if ($prodSale > 0): ?>
                    <span class="detail-current-price"><?php echo number_format($prodSale, 0, ',', '.'); ?>đ</span>
                    <span class="detail-old-price"><?php echo number_format($prodPrice, 0, ',', '.'); ?>đ</span>
                    <span style="background: var(--danger-color); color: white; padding: 2px 8px; border-radius: 4px; font-size: 12px; font-weight:700;">TIẾT KIỆM <?php echo number_format($prodPrice - $prodSale, 0, ',', '.'); ?>đ</span>
                <?php else: ?>
                    <span class="detail-current-price"><?php echo number_format($prodPrice, 0, ',', '.'); ?>đ</span>
                <?php endif; ?>
            </div>

            <p style="margin-bottom: 20px; color: var(--text-dark); line-height: 1.8;">
                <?php echo $prodDesc; ?>
            </p>

            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid var(--border-color);">
                <p style="margin-bottom: 6px;"><strong><i class="fa-solid fa-shirt" style="color: var(--accent-hover);"></i> Chất liệu vải:</strong> <?php echo $prodFabric; ?></p>
                <p style="margin-bottom: 6px;"><strong><i class="fa-solid fa-shield-halved" style="color: var(--accent-hover);"></i> Bảo hành sản phẩm:</strong> Đổi trả miễn phí trong 7 ngày nếu có lỗi vải hoặc đường may</p>
                <p><strong><i class="fa-solid fa-print" style="color: var(--accent-hover);"></i> Dịch vụ in ấn:</strong> Hỗ trợ in tên, số áo và logo đội theo yêu cầu công nghệ in 3D chuyển nhiệt</p>
            </div>

            <!-- CHỌN SIZE ÁO THI ĐẤU -->
            <form action="#" method="POST" onsubmit="alert('Đã thêm áo \'<?php echo addslashes($prodName); ?>\' (Size ' + document.getElementById('selected-size').value + ') vào giỏ hàng!'); return false;">
                <div class="size-selector">
                    <label><i class="fa-solid fa-ruler-combined"></i> Chọn Size Áo Thi Đấu:</label>
                    <div class="size-options">
                        <button type="button" class="size-btn selected" data-size="S">S</button>
                        <button type="button" class="size-btn" data-size="M">M</button>
                        <button type="button" class="size-btn" data-size="L">L</button>
                        <button type="button" class="size-btn" data-size="XL">XL</button>
                        <button type="button" class="size-btn" data-size="XXL">XXL</button>
                    </div>
                    <input type="hidden" name="size" id="selected-size" value="S">
                </div>

                <div style="display: flex; gap: 15px; margin-top: 25px;">
                    <button type="submit" class="btn-buy-now">
                        <i class="fa-solid fa-bag-shopping"></i> MUA NGAY KÈM IN TÊN SỐ
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- KHỐI BÌNH LUẬN SẢN PHẨM (BÀI 2 COMMENT) -->
    <div id="comments-section" style="margin-top: 50px; background: white; border-radius: 16px; padding: 35px; box-shadow: var(--card-shadow);">
        <h3 style="font-size: 22px; font-weight: 800; color: var(--primary-color); margin-bottom: 20px; border-bottom: 3px solid var(--accent-color); padding-bottom: 10px;">
            <i class="fa-solid fa-comments" style="color: var(--accent-hover);"></i> ĐÁNH GIÁ & BÌNH LUẬN SẢN PHẨM
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <!-- CỘT DANH SÁCH BÌNH LUẬN (BÀI 2: XEM DANH SÁCH COMMENT) -->
            <div>
                <h4 style="font-size: 16px; font-weight: 700; color: var(--primary-color); margin-bottom: 15px;">Phản hồi từ khách hàng:</h4>
                <?php echo $html_ds_cmt ?? '<p style="color:var(--text-muted); font-size:14px; font-style:italic;">Chưa có bình luận nào cho mẫu áo bóng đá này.</p>'; ?>
            </div>

            <!-- CỘT FORM THÊM BÌNH LUẬN MỚI (BÀI 2: THÊM COMMENT) -->
            <div>
                <h4 style="font-size: 16px; font-weight: 700; color: var(--primary-color); margin-bottom: 15px;">Gửi đánh giá của bạn:</h4>
                <form action="index.php?action=comment" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $prodId; ?>">

                    <div class="form-group">
                        <label for="user_name">Họ và tên của bạn:</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" 
                               value="<?php echo htmlspecialchars($_SESSION['user']['fullname'] ?? ''); ?>" 
                               placeholder="Nhập tên người bình luận..." required>
                    </div>

                    <div class="form-group">
                        <label for="rating">Đánh giá sản phẩm:</label>
                        <select id="rating" name="rating" class="form-control">
                            <option value="5">★★★★★ - Rất hài lòng (5 sao)</option>
                            <option value="4">★★★★☆ - Hài lòng (4 sao)</option>
                            <option value="3">★★★☆☆ - Bình thường (3 sao)</option>
                            <option value="2">★★☆☆☆ - Tạm được (2 sao)</option>
                            <option value="1">★☆☆☆☆ - Không tốt (1 sao)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="content">Nội dung đánh giá / Bình luận áo đấu:</label>
                        <textarea id="content" name="content" class="form-control" rows="4" placeholder="Viết nhận xét của bạn về chất liệu vải, đường may, dịch vụ in ấn..." required></textarea>
                    </div>

                    <button type="submit" class="btn-submit" style="background: var(--accent-color); color: var(--primary-color);"><i class="fa-solid fa-paper-plane"></i> GỬI BÌNH LUẬN</button>
                </form>
            </div>
        </div>
    </div>

    <!-- KHỐI SẢN PHẨM LIÊN QUAN (BÀI 3) -->
    <?php if (!empty($relatedProducts)): ?>
        <div style="margin-top: 60px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 3px solid var(--accent-color); padding-bottom: 10px;">
                <h3 style="font-size: 22px; font-weight: 800; color: var(--primary-color);">
                    <i class="fa-solid fa-layer-group" style="color: var(--accent-hover);"></i> SẢN PHẨM LIÊN QUAN (CÙNG DANH MỤC)
                </h3>
                <a href="index.php?action=product&idcategory=<?php echo $prodCatId; ?>" style="font-size: 14px; font-weight: 700; color: var(--accent-hover);">
                    Xem thêm <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="product-grid">
                <?php foreach ($relatedProducts as $rel): ?>
                    <?php if (!is_array($rel)) continue; ?>
                    <div class="product-card">
                        <?php 
                        $relPrice = (float)($rel['price'] ?? 0);
                        $relSale  = (float)($rel['sale_price'] ?? 0);
                        $relName  = htmlspecialchars($rel['name'] ?? 'Áo bóng đá');
                        $relCat   = htmlspecialchars($rel['category_name'] ?? 'Áo đấu');
                        $relId    = (int)($rel['id'] ?? 1);
                        ?>
                        <?php if ($relSale > 0 && $relSale < $relPrice): ?>
                            <span class="badge-sale">GIẢM <?php echo round((($relPrice - $relSale) / $relPrice) * 100); ?>%</span>
                        <?php endif; ?>

                        <div class="product-img-wrapper">
                            <?php echo renderJerseySvg($relName); ?>
                        </div>

                        <div class="product-info">
                            <span class="product-cat"><?php echo $relCat; ?></span>
                            <h3 class="product-title"><?php echo $relName; ?></h3>
                            
                            <div class="product-price">
                                <span class="current-price"><?php echo number_format($relSale > 0 ? $relSale : $relPrice, 0, ',', '.'); ?>đ</span>
                                <?php if ($relSale > 0): ?>
                                    <span class="old-price"><?php echo number_format($relPrice, 0, ',', '.'); ?>đ</span>
                                <?php endif; ?>
                            </div>

                            <a href="index.php?action=productdetail&id=<?php echo $relId; ?>" class="btn-detail"><i class="fa-solid fa-eye"></i> Xem Chi Tiết</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

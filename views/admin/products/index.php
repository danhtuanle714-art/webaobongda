<?php
// View Admin Quản Lý Sản Phẩm - Bố cục Layout chuẩn Mockup (views/admin/products/index.php)
?>

<div style="display: flex; min-height: 100vh; background: #f8fafc; font-family: 'Outfit', sans-serif;">
    <!-- LEFT DARK SIDEBAR NAV -->
    <div style="width: 260px; background: #161b22; color: #f0f6fc; padding: 25px 20px; display: flex; flex-direction: column; shrink: 0; box-shadow: 4px 0 15px rgba(0,0,0,0.1);">
        <!-- BRAND LOGO -->
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 35px; padding-bottom: 15px; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div style="background: linear-gradient(135deg, #00b4d8, #0077b6); width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 22px; font-weight: 900;">
                <i class="fa-solid fa-futbol"></i>
            </div>
            <div>
                <div style="font-weight: 900; font-size: 18px; color: #ffffff; letter-spacing: 0.5px;">WEB BÓNG ĐÁ</div>
                <div style="font-size: 11px; color: #8b949e; text-transform: uppercase; font-weight: 700;">Admin Dashboard</div>
            </div>
        </div>

        <!-- SIDEBAR MENU ITEMS -->
        <div style="display: flex; flex-direction: column; gap: 6px; flex-grow: 1;">
            <a href="index.php?action=admin&sub=statistics" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: #c9d1d9; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s;">
                <i class="fa-solid fa-chart-pie" style="width: 20px;"></i> Thống kê
            </a>
            
            <a href="index.php?action=admin&sub=product_list" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: #ffffff; background: rgba(255,255,255,0.08); text-decoration: none; font-weight: 700; font-size: 14px; border-left: 4px solid #00b4d8;">
                <i class="fa-solid fa-boxes-stacked" style="width: 20px; color: #00b4d8;"></i> Quản lí sản phẩm
            </a>
            
            <a href="index.php?action=admin&sub=category_list" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: #c9d1d9; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s;">
                <i class="fa-solid fa-folder" style="width: 20px;"></i> Quản lí danh mục
            </a>

            <a href="index.php?action=admin&sub=comment_list" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: #c9d1d9; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s;">
                <i class="fa-solid fa-comments" style="width: 20px;"></i> Quản lí bình luận
            </a>

            <a href="#" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: #c9d1d9; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s;">
                <i class="fa-solid fa-cart-shopping" style="width: 20px;"></i> Quản lí đơn hàng
            </a>

            <a href="#" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: #c9d1d9; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s;">
                <i class="fa-solid fa-ticket" style="width: 20px;"></i> Quản lí mã giảm giá
            </a>

            <a href="index.php?action=admin&sub=user_list" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: #c9d1d9; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s;">
                <i class="fa-solid fa-users" style="width: 20px;"></i> Quản lí người dùng
            </a>

            <a href="#" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: #8b949e; text-decoration: none; font-weight: 600; font-size: 14px; margin-top: 10px;">
                <i class="fa-solid fa-trash-can" style="width: 20px;"></i> Thùng rác
            </a>
        </div>

        <!-- SIDEBAR FOOTER LINKS -->
        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px; display: flex; flex-direction: column; gap: 8px;">
            <a href="index.php" target="_blank" style="display: flex; align-items: center; gap: 10px; color: #8b949e; text-decoration: none; font-weight: 600; font-size: 13px;">
                <i class="fa-solid fa-globe"></i> Xem website
            </a>
            <a href="index.php?action=logout" style="display: flex; align-items: center; gap: 10px; color: #f85149; text-decoration: none; font-weight: 700; font-size: 13px;">
                <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <div style="flex-grow: 1; padding: 35px 40px; background: #ffffff;">
        
        <!-- HEADER TOP BAR: TITLE & BLUE ADD BUTTON -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1 style="font-size: 28px; font-weight: 900; color: #0f172a; margin: 0;">Quản lý sản phẩm</h1>
            
            <a href="index.php?action=admin&sub=product_add" style="background: #00b4d8; color: white; padding: 12px 24px; border-radius: 10px; font-weight: 800; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(0, 180, 216, 0.3); transition: all 0.2s;">
                <i class="fa-solid fa-plus"></i> Thêm sản phẩm
            </a>
        </div>

        <!-- NOTIFICATION MESSAGES -->
        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'added'): ?>
            <div style="background: #d1fae5; color: #065f46; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px; font-weight: 700; font-size: 14px;">
                <i class="fa-solid fa-circle-check"></i> Thêm sản phẩm mới thành công!
            </div>
        <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
            <div style="background: #d1fae5; color: #065f46; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px; font-weight: 700; font-size: 14px;">
                <i class="fa-solid fa-circle-check"></i> Cập nhật thông tin sản phẩm thành công!
            </div>
        <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
            <div style="background: #fee2e2; color: #991b1b; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px; font-weight: 700; font-size: 14px;">
                <i class="fa-solid fa-trash"></i> Đã xóa sản phẩm khỏi cửa hàng!
            </div>
        <?php endif; ?>

        <!-- KPI STATS CARDS: TỔNG SẢN PHẨM (10) & GIÁ CAO NHẤT (360.000đ) -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 35px;">
            
            <!-- CARD 1: TỔNG SẢN PHẨM -->
            <div style="border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px 28px; background: #ffffff; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">
                <div style="font-size: 12px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">TỔNG SẢN PHẨM</div>
                <div style="font-size: 38px; font-weight: 900; color: #0f172a; margin: 10px 0 6px 0;">10</div>
                <div style="font-size: 13px; color: #64748b; font-weight: 500;">Đang hiển thị trong cửa hàng</div>
            </div>

            <!-- CARD 2: GIÁ CAO NHẤT -->
            <div style="border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px 28px; background: #ffffff; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">
                <div style="font-size: 12px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">GIÁ CAO NHẤT</div>
                <div style="font-size: 38px; font-weight: 900; color: #0f172a; margin: 10px 0 6px 0;">360.000đ</div>
                <div style="font-size: 13px; color: #64748b; font-weight: 500;">Sản phẩm có giá trị lớn nhất</div>
            </div>

        </div>

        <!-- SEARCH FORM -->
        <div style="margin-bottom: 25px; background: #f8fafc; padding: 15px 20px; border-radius: 10px; border: 1px solid #e2e8f0;">
            <form action="index.php" method="GET" style="display: flex; gap: 12px; align-items: center;">
                <input type="hidden" name="action" value="admin">
                <input type="hidden" name="sub" value="product_list">
                <input type="text" name="keyword" placeholder="Nhập tên áo bóng đá (Real Madrid, Man Utd...)..." value="<?php echo htmlspecialchars($keyword ?? ''); ?>" style="flex-grow: 1; padding: 10px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                <button type="submit" style="background: #0f172a; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer;">
                    <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
                </button>
            </form>
        </div>

        <!-- DATA TABLE -->
        <div style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr style="background: #f1f5f9; color: #475569; font-size: 12px; text-transform: uppercase; font-weight: 800; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 16px 20px; width: 80px;">ID</th>
                        <th style="padding: 16px 20px; width: 90px;">ẢNH</th>
                        <th style="padding: 16px 20px;">SẢN PHẨM</th>
                        <th style="padding: 16px 20px;">DANH MỤC</th>
                        <th style="padding: 16px 20px;">GIÁ BÁN</th>
                        <th style="padding: 16px 20px; text-align: center; width: 110px;">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px; color: #64748b;">Chưa có sản phẩm nào.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $prod): ?>
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.1s;">
                                <td style="padding: 16px 20px; font-weight: 700; color: #64748b;">#00<?php echo $prod['id']; ?></td>
                                <td style="padding: 16px 20px;">
                                    <div style="width: 52px; height: 52px; background: #f8fafc; border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; overflow: hidden;">
                                        <?php echo renderJerseySvg($prod['name']); ?>
                                    </div>
                                </td>
                                <td style="padding: 16px 20px;">
                                    <div style="font-weight: 800; color: #0f172a; font-size: 15px;"><?php echo htmlspecialchars($prod['name']); ?></div>
                                    <div style="font-size: 12px; color: #94a3b8; margin-top: 2px;">SKU: BO-<?php echo sprintf('%03d', $prod['id']); ?></div>
                                </td>
                                <td style="padding: 16px 20px; font-weight: 600; color: #475569;">
                                    <?php echo htmlspecialchars($prod['category_name'] ?? 'Áo bóng đá'); ?>
                                </td>
                                <td style="padding: 16px 20px; font-weight: 800; color: #0f172a; font-size: 15px;">
                                    <?php echo number_format($prod['price'], 0, ',', '.'); ?>đ
                                </td>
                                <td style="padding: 16px 20px; text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <!-- YELLOW EDIT BUTTON -->
                                        <a href="index.php?action=admin&sub=product_edit&id=<?php echo $prod['id']; ?>" style="background: #ffb703; color: #0f172a; width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 14px; font-weight: 700;" title="Sửa">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <!-- RED DELETE BUTTON -->
                                        <a href="index.php?action=admin&sub=product_delete&id=<?php echo $prod['id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" style="background: #e63946; color: white; width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 14px; font-weight: 700;" title="Xóa">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php
// Layout Footer dùng chung cho tất cả các trang (Bài 1)
?>
    <!-- FOOTER -->
    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-col">
                <h4><i class="fa-solid fa-futbol"></i> WEB ÁO BÓNG ĐÁ</h4>
                <p>Hệ thống cung cấp áo bóng đá câu lạc bộ, áo đội tuyển quốc gia, áo đấu không logo chất lượng cao. Nhận in tên số, logo theo yêu cầu cực nhanh.</p>
            </div>
            <div class="footer-col">
                <h4>Danh Mục Đặt Hàng</h4>
                <ul>
                    <li><a href="index.php?controller=product&category_id=1"><i class="fa-solid fa-angle-right"></i> Áo Câu Lạc Bộ (CLB)</a></li>
                    <li><a href="index.php?controller=product&category_id=2"><i class="fa-solid fa-angle-right"></i> Áo Đội Tuyển Quốc Gia</a></li>
                    <li><a href="index.php?controller=product&category_id=3"><i class="fa-solid fa-angle-right"></i> Áo Bóng Đá Không Logo</a></li>
                    <li><a href="index.php?controller=product&category_id=4"><i class="fa-solid fa-angle-right"></i> Áo Bóng Đá Dài Tay</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Liên Hệ Cửa Hàng</h4>
                <p><i class="fa-solid fa-location-dot"></i> 123 Đường Thể Thao, Quận 1, TP. Hồ Chí Minh</p>
                <p><i class="fa-solid fa-phone"></i> Hotline: 0988.123.456</p>
                <p><i class="fa-solid fa-envelope"></i> Email: contact@aobongda.vn</p>
            </div>
            <div class="footer-col">
                <h4>Kết Nối Với Chúng Tôi</h4>
                <p style="margin-bottom: 15px;">Theo dõi các mẫu áo đấu hot nhất tại:</p>
                <div style="display: flex; gap: 15px; font-size: 22px;">
                    <a href="#" style="color: var(--accent-color);"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" style="color: var(--accent-color);"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" style="color: var(--accent-color);"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" style="color: var(--accent-color);"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                &copy; <?php echo date('Y'); ?> WEB ÁO BÓNG ĐÁ - Đồ án lập trình Web PHP theo mô hình MVC. Tất cả các quyền được bảo lưu.
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>

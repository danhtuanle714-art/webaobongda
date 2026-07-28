<?php
// View Trang Liên Hệ (views/pages/contact.php) - Bài 1
?>

<div class="container section">
    <div style="background: white; border-radius: 16px; padding: 40px; box-shadow: var(--card-shadow); display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
        <!-- THÔNG TIN LIÊN HỆ -->
        <div>
            <h2 style="font-size: 26px; font-weight: 800; color: var(--primary-color); margin-bottom: 20px;">
                <i class="fa-solid fa-headset"></i> LIÊN HỆ VỚI CHÚNG TÔI
            </h2>
            <p style="color: var(--text-muted); margin-bottom: 30px; line-height: 1.8;">
                Bạn cần tư vấn chọn size áo, đặt in áo đội số lượng lớn hoặc có phản hồi về chất lượng sản phẩm? Hãy gửi thông tin cho chúng tôi ngay bên dưới.
            </p>

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 45px; height: 45px; background: rgba(255,183,3,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-hover); font-size: 20px;">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 style="color: var(--primary-color);">Địa Chỉ Showroom:</h4>
                        <p style="color: var(--text-muted); font-size: 14px;">123 Đường Thể Thao, Quận 1, TP. Hồ Chí Minh</p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 45px; height: 45px; background: rgba(255,183,3,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-hover); font-size: 20px;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h4 style="color: var(--primary-color);">Số Điện Thoại / Zalo:</h4>
                        <p style="color: var(--text-muted); font-size: 14px;">0988.123.456 (Đặt in áo đội giá sỉ)</p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 45px; height: 45px; background: rgba(255,183,3,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-hover); font-size: 20px;">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <h4 style="color: var(--primary-color);">Thời Gian Mở Cửa:</h4>
                        <p style="color: var(--text-muted); font-size: 14px;">8:00 - 21:30 (Từ Thứ 2 đến Chủ Nhật)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM GỬI THÔNG TIN -->
        <div>
            <h3 style="font-size: 20px; font-weight: 800; color: var(--primary-color); margin-bottom: 20px;">
                GỬI TIN NHẮN PHẢN HỒI
            </h3>

            <?php if (!empty($successMsg)): ?>
                <div class="alert-msg alert-success">
                    <i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($successMsg); ?>
                </div>
            <?php endif; ?>

            <form action="index.php?controller=page&action=contact" method="POST">
                <div class="form-group">
                    <label for="name">Họ và tên của bạn:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nhập họ tên..." required>
                </div>

                <div class="form-group">
                    <label for="email">Địa chỉ Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email..." required>
                </div>

                <div class="form-group">
                    <label for="message">Nội dung tin nhắn / Đặt áo đội:</label>
                    <textarea id="message" name="message" class="form-control" rows="4" placeholder="Nhập nội dung thông tin liên hệ hoặc yêu cầu in ấn..." required></textarea>
                </div>

                <button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> GỬI PHẢN HỒI</button>
            </form>
        </div>
    </div>
</div>

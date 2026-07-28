// WEB ÁO BÓNG ĐÁ - JavaScript tương tác
document.addEventListener('DOMContentLoaded', function() {
    // Tương tác chọn Size trên trang chi tiết sản phẩm
    const sizeBtns = document.querySelectorAll('.size-btn');
    const selectedSizeInput = document.getElementById('selected-size');

    if (sizeBtns.length > 0) {
        sizeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                sizeBtns.forEach(b => b.classList.remove('selected'));
                this.classList.add('selected');
                if (selectedSizeInput) {
                    selectedSizeInput.value = this.getAttribute('data-size');
                }
            });
        });
    }

    // Hiệu ứng thông báo tự biến mất
    const alerts = document.querySelectorAll('.alert-msg');
    if (alerts.length > 0) {
        setTimeout(() => {
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 4000);
    }
});

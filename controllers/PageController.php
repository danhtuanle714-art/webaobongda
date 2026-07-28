<?php
// PageController.php - Điều khiển Trang Giới Thiệu & Trang Liên Hệ (Bài 1)

class PageController {
    public function about() {
        $pageTitle = "Giới Thiệu - Cửa Hàng Áo Bóng Đá Thể Thao";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/pages/about.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function contact() {
        $pageTitle = "Liên Hệ - Cửa Hàng Áo Bóng Đá Thể Thao";
        $successMsg = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $content = trim($_POST['message'] ?? '');

            if (!empty($name) && !empty($email) && !empty($content)) {
                $successMsg = "Cảm ơn $name đã gửi liên hệ! Chúng tôi sẽ phản hồi lại qua email $email sớm nhất.";
            }
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/pages/contact.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}

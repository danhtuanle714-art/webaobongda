<?php
// AuthController.php - Điều khiển Đăng nhập, Đăng ký, Đăng xuất & Cập nhật thông tin (Bài 1)
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new User();
    }

    // [Bài 1] Đăng nhập
    public function login() {
        $pageTitle = "Đăng Nhập Tài Khoản - Web Áo Bóng Đá";
        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (!empty($email) && !empty($password)) {
                $res = $this->userModel->login($email, $password);
                if ($res['success']) {
                    $_SESSION['user'] = $res['user'];
                    header("Location: index.php?action=profile&msg=login_success");
                    exit();
                } else {
                    $message = $res['message'];
                }
            } else {
                $message = "Vui lòng điền đầy đủ Email và Mật khẩu!";
            }
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/login.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // [Bài 1] Đăng ký
    public function register() {
        $pageTitle = "Đăng Ký Tài Khoản - Web Áo Bóng Đá";
        $message = "";
        $isSuccess = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = trim($_POST['fullname'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $phone    = trim($_POST['phone'] ?? '');

            $res = $this->userModel->register($fullname, $email, $password, $phone);
            $message = $res['message'];
            $isSuccess = $res['success'];
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/register.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // [Bài 1] Đăng xuất
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user']);
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }

    // [Bài 1] Cập nhật thông tin cá nhân (Profile Update)
    public function profile() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->getById($userId);
        $pageTitle = "Cập Nhật Thông Tin Cá Nhân - Web Áo Bóng Đá";
        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = trim($_POST['fullname'] ?? '');
            $phone    = trim($_POST['phone'] ?? '');
            $address  = trim($_POST['address'] ?? '');

            if (!empty($fullname)) {
                $res = $this->userModel->updateProfile($userId, $fullname, $phone, $address);
                if ($res) {
                    $_SESSION['user']['fullname'] = $fullname;
                    $_SESSION['user']['phone']    = $phone;
                    $_SESSION['user']['address']  = $address;
                    $user = $this->userModel->getById($userId);
                    $message = "Cập nhật thông tin hồ sơ cá nhân thành công!";
                } else {
                    $message = "Lỗi khi cập nhật thông tin!";
                }
            } else {
                $message = "Họ và tên không được để trống!";
            }
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/profile.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}

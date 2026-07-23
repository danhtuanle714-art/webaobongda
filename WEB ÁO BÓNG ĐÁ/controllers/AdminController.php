<?php
// AdminController.php - Quản lý CRUD Danh mục, Sản phẩm, Đăng nhập & Đăng ký Admin (LAB 4 & Bài 1)
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/User.php';

class AdminController {
    private $categoryModel;
    private $productModel;
    private $userModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->categoryModel = new Category();
        $this->productModel  = new Product();
        $this->userModel     = new User();
    }

    // [BÀI 1 IN ADMIN] ĐĂNG NHẬP ADMIN
    public function login() {
        $pageTitle = "Đăng Nhập Admin - Web Áo Bóng Đá";
        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (!empty($email) && !empty($password)) {
                $res = $this->userModel->login($email, $password);
                if ($res['success']) {
                    $_SESSION['user'] = $res['user'];
                    header("Location: index.php?action=admin&sub=category_list");
                    exit();
                } else {
                    $message = $res['message'];
                }
            } else {
                $message = "Vui lòng điền đầy đủ Email và Mật khẩu!";
            }
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/admin/login.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // [BÀI 1 IN ADMIN] ĐĂNG KÝ ADMIN
    public function register() {
        $pageTitle = "Đăng Ký Tài Khoản Admin - Web Áo Bóng Đá";
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
        require_once __DIR__ . '/../views/admin/register.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Kiểm tra quyền Admin
    private function checkAuth() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=admin&sub=login");
            exit();
        }
    }

    // ==========================================
    // 1. QUẢN LÝ DANH MỤC (BÀI 1)
    // ==========================================

    // Danh sách & Form Thêm danh mục
    public function categoryList() {
        $this->checkAuth();
        $pageTitle = "Quản Lý Danh Mục - Admin";
        $message = "";
        $msgType = "success";

        // Thêm danh mục khi POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_add_category'])) {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (!empty($name)) {
                $res = $this->categoryModel->add($name, $description);
                if ($res) {
                    $message = "Thêm danh mục mới '$name' thành công!";
                } else {
                    $message = "Lỗi khi thêm danh mục vào CSDL!";
                    $msgType = "danger";
                }
            } else {
                $message = "Vui lòng nhập tên danh mục!";
                $msgType = "danger";
            }
        }

        $categories = $this->categoryModel->getAll();

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/admin/categories/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Sửa danh mục
    public function categoryEdit() {
        $this->checkAuth();
        $pageTitle = "Chỉnh Sửa Danh Mục - Admin";
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $category = $this->categoryModel->getById($id);

        if (!$category) {
            header("Location: index.php?action=admin&sub=category_list");
            exit();
        }

        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name        = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (!empty($name)) {
                $this->categoryModel->update($id, $name, $description);
                header("Location: index.php?action=admin&sub=category_list&msg=updated");
                exit();
            } else {
                $message = "Tên danh mục không được để trống!";
            }
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/admin/categories/edit.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Xóa danh mục
    public function categoryDelete() {
        $this->checkAuth();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0) {
            $this->categoryModel->delete($id);
        }
        header("Location: index.php?action=admin&sub=category_list&msg=deleted");
        exit();
    }

    // ==========================================
    // 2. QUẢN LÝ SẢN PHẨM (BÀI 2 - CÓ SEARCH)
    // ==========================================

    // Danh sách & Tìm kiếm sản phẩm
    public function productList() {
        $this->checkAuth();
        $pageTitle = "Quản Lý Áo Bóng Đá - Admin";
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

        if (!empty($keyword)) {
            $products = $this->productModel->search($keyword);
        } else {
            $products = $this->productModel->getAll();
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/admin/products/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Thêm áo bóng đá mới
    public function productAdd() {
        $this->checkAuth();
        $pageTitle = "Thêm Áo Bóng Đá Mới - Admin";
        $categories = $this->categoryModel->getAll();
        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = (int)($_POST['category_id'] ?? 1);
            $name        = trim($_POST['name'] ?? '');
            $price       = (float)($_POST['price'] ?? 0);
            $sale_price  = (float)($_POST['sale_price'] ?? 0);
            $fabric      = trim($_POST['fabric'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $image       = 'default_jersey.jpg';

            if (!empty($name) && $price > 0) {
                $this->productModel->add($category_id, $name, $price, $sale_price, $image, $description, $fabric, $is_featured);
                header("Location: index.php?action=admin&sub=product_list&msg=added");
                exit();
            } else {
                $message = "Vui lòng nhập tên áo đấu và giá bán hợp lệ!";
            }
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/admin/products/add.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Chỉnh sửa áo bóng đá
    public function productEdit() {
        $this->checkAuth();
        $pageTitle = "Chỉnh Sửa Áo Bóng Đá - Admin";
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $product = $this->productModel->getById($id);

        if (!$product) {
            header("Location: index.php?action=admin&sub=product_list");
            exit();
        }

        $categories = $this->categoryModel->getAll();
        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = (int)($_POST['category_id'] ?? $product['category_id']);
            $name        = trim($_POST['name'] ?? '');
            $price       = (float)($_POST['price'] ?? 0);
            $sale_price  = (float)($_POST['sale_price'] ?? 0);
            $fabric      = trim($_POST['fabric'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $image       = $product['image'];

            if (!empty($name) && $price > 0) {
                $this->productModel->update($id, $category_id, $name, $price, $sale_price, $image, $description, $fabric, $is_featured);
                header("Location: index.php?action=admin&sub=product_list&msg=updated");
                exit();
            } else {
                $message = "Tên sản phẩm và giá bán không hợp lệ!";
            }
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/admin/products/edit.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Xóa áo bóng đá
    public function productDelete() {
        $this->checkAuth();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0) {
            $this->productModel->delete($id);
        }
        header("Location: index.php?action=admin&sub=product_list&msg=deleted");
        exit();
    }
}

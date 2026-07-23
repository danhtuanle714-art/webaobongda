<?php
// index.php - Front Controller Routing (Bài 1 Tài Khoản & Bài 2 Comment)

// Đăng ký autoload / require các file controller
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/PageController.php';
require_once __DIR__ . '/controllers/AdminController.php';

// Lấy tham số action / controller / pg từ URL
$action = isset($_GET['action']) ? strtolower(trim($_GET['action'])) : (isset($_GET['controller']) ? strtolower(trim($_GET['controller'])) : (isset($_GET['pg']) ? strtolower(trim($_GET['pg'])) : 'home'));

switch ($action) {
    // [Bài 1 - Tài Khoản] Đăng ký, Đăng nhập, Đăng xuất & Profile
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'profile':
        $controller = new AuthController();
        $controller->profile();
        break;

    // [Bài 2 - Comment] Thêm bình luận
    case 'comment':
        $controller = new ProductController();
        $controller->add_comment();
        break;

    // [Bài 1 - Chuẩn Slide] Chức năng search
    case 'search':
        include_once __DIR__ . "/controllers/ProductController.php";
        $ctrl_page = new ProductController();
        if (isset($_GET['keyword']) && ($_GET['keyword'] != "")) {
            $keyword = $_GET['keyword'];
        } else {
            $keyword = "";
        }
        $ctrl_page->set_view("product");
        $ctrl_page->view_search($keyword);
        break;

    // [Bài 2 - Chuẩn Slide] Hoàn thiện trang sản phẩm
    case 'product':
        include_once __DIR__ . "/controllers/ProductController.php";
        $ctrl_page = new ProductController();
        if (isset($_GET['idcategory']) && (is_numeric($_GET['idcategory'])) && ($_GET['idcategory'] > 0)) {
            $idcategory = $_GET['idcategory'];
        } elseif (isset($_GET['category_id']) && (is_numeric($_GET['category_id'])) && ($_GET['category_id'] > 0)) {
            $idcategory = $_GET['category_id'];
        } else {
            $idcategory = 0;
        }

        if (isset($_GET['page']) && (is_numeric($_GET['page'])) && ($_GET['page'] > 0)) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $ctrl_page->set_view("product");
        $ctrl_page->view($idcategory, $page);
        break;

    // [Bài 3 - Chuẩn Slide] Code trang chi tiết
    case 'productdetail':
    case 'detail':
        include_once __DIR__ . "/controllers/ProductController.php";
        $ctrl_page = new ProductController();
        if (isset($_GET['id']) && (is_numeric($_GET['id'])) && ($_GET['id'] > 0)) {
            $id = $_GET['id'];
            $ctrl_page->set_view("productdetail");
            $ctrl_page->view_detail($id);
        } else {
            header('Location: index.php?action=product');
        }
        break;

    // Phân hệ Quản trị Admin (LAB 4 & Bài 1 Admin Auth)
    case 'category_list':
        $controller = new AdminController();
        $controller->categoryList();
        break;

    case 'category_edit':
        $controller = new AdminController();
        $controller->categoryEdit();
        break;

    case 'category_delete':
        $controller = new AdminController();
        $controller->categoryDelete();
        break;

    case 'product_add':
        $controller = new AdminController();
        $controller->productAdd();
        break;

    case 'product_edit':
        $controller = new AdminController();
        $controller->productEdit();
        break;

    case 'product_delete':
        $controller = new AdminController();
        $controller->productDelete();
        break;

    case 'product_list':
        $controller = new AdminController();
        $controller->productList();
        break;

    case 'admin':
        $controller = new AdminController();
        $sub = $_GET['sub'] ?? ($_GET['act'] ?? '');
        if ($sub === 'login') {
            $controller->login();
        } elseif ($sub === 'register') {
            $controller->register();
        } elseif ($sub === 'category_list') {
            $controller->categoryList();
        } elseif ($sub === 'category_edit') {
            $controller->categoryEdit();
        } elseif ($sub === 'category_delete') {
            $controller->categoryDelete();
        } elseif ($sub === 'product_add') {
            $controller->productAdd();
        } elseif ($sub === 'product_edit') {
            $controller->productEdit();
        } elseif ($sub === 'product_delete') {
            $controller->productDelete();
        } elseif ($sub === 'product_list') {
            $controller->productList();
        } else {
            $controller->categoryList();
        }
        break;

    case 'page':
        $controller = new PageController();
        $sub = $_GET['sub'] ?? '';
        if ($sub === 'contact') {
            $controller->contact();
        } else {
            $controller->about();
        }
        break;

    case 'home':
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}

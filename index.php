<?php
session_start();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/model/connect.php';
require_once __DIR__ . '/model/danhmuc.php';
require_once __DIR__ . '/model/sanpham.php';
require_once __DIR__ . '/model/taikhoan.php';
require_once __DIR__ . '/model/donhang.php';
require_once __DIR__ . '/model/banner.php';
require_once __DIR__ . '/model/baiviet.php';
require_once __DIR__ . '/model/binhluan.php';
require_once __DIR__ . '/model/magiamgia.php';
require_once __DIR__ . '/controller/HomeController.php';
require_once __DIR__ . '/controller/ClientController.php';
require_once __DIR__ . '/controller/CartController.php';
require_once __DIR__ . '/controller/UserController.php';
require_once __DIR__ . '/controller/ProductController.php';
require_once __DIR__ . '/controller/NewsController.php';

$act = isset($_GET['act']) ? $_GET['act'] : 'trangchu';

switch ($act) {
    case 'trangchu':
        $ctrl = new HomeController(); $ctrl->index(); break;
    case 'sanpham':
        $ctrl = new ClientController(); $ctrl->products(); break;
    case 'chitiet':
        $ctrl = new ClientController(); $ctrl->detail(); break;
    case 'gioithieu':
        $ctrl = new ClientController(); $ctrl->about(); break;
    case 'lienhe':
        $ctrl = new ClientController(); $ctrl->contact(); break;
    case 'thuonghieu':
        $ctrl = new ClientController(); $ctrl->brand(); break;
    case 'pickleball':
        $ctrl = new ClientController(); $ctrl->pickleball(); break;
    case 'tintuc': case 'baiviet':
        $ctrl = new NewsController(); $ctrl->index(); break;
    case 'chitiet-baiviet':
        $ctrl = new NewsController(); $ctrl->detail(); break;
    case 'giohang':
        $ctrl = new CartController(); $ctrl->view(); break;
    case 'them-giohang':
        $ctrl = new CartController(); $ctrl->add(); break;
    case 'cap-nhat-giohang':
        $ctrl = new CartController(); $ctrl->update(); break;
    case 'xoa-giohang':
        $ctrl = new CartController(); $ctrl->delete(); break;
    case 'ap-dung-magiamgia':
        $ctrl = new CartController(); $ctrl->applyCoupon(); break;
    case 'huy-magiamgia':
        $ctrl = new CartController(); $ctrl->removeCoupon(); break;
    case 'thanhtoan':
        $ctrl = new CartController(); $ctrl->checkout(); break;
    case 'dat-hang':
        $ctrl = new CartController(); $ctrl->placeOrder(); break;
    case 'donhang-success':
        $ctrl = new CartController(); $ctrl->success(); break;
    case 'dangnhap':
        $ctrl = new UserController(); $ctrl->login(); break;
    case 'dangky':
        $ctrl = new UserController(); $ctrl->register(); break;
    case 'dangxuat':
        $ctrl = new UserController(); $ctrl->logout(); break;
    case 'taikhoan':
        $ctrl = new UserController(); $ctrl->profile(); break;
    case 'capnhat-taikhoan':
        $ctrl = new UserController(); $ctrl->updateProfile(); break;
    default:
        header('Location: index.php?act=trangchu'); exit();
}
?>
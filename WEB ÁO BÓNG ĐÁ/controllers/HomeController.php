<?php
// HomeController.php - Điều khiển trang chủ (Bài 1)
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Banner.php';
require_once __DIR__ . '/../models/Post.php';

class HomeController {
    public function index() {
        $categoryModel = new Category();
        $productModel  = new Product();
        $bannerModel   = new Banner();
        $postModel     = new Post();

        // [Bài 1] Load Banner theo nhiều vị trí
        $heroBanners  = $bannerModel->getByPosition('hero');
        $subBanners   = $bannerModel->getByPosition('sub');
        $promoBanners = $bannerModel->getByPosition('promo');

        // [Bài 1] Load Sản phẩm phân loại theo danh mục
        $categoriesWithProducts = $categoryModel->getCategoriesWithProducts(4);

        // [Bài 1] Load Bài viết / Tin tức mới
        $latestPosts = $postModel->getLatest(3);

        // Sản phẩm nổi bật
        $featuredProducts = $productModel->getFeatured(6);

        $pageTitle = "Trang Chủ - Cửa Hàng Web Áo Bóng Đá";
        
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}

<?php
// ProductController.php - Điều khiển Trang sản phẩm, Tìm kiếm, Chi tiết & Bình luận (Bài 1, 2, 3)
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Comment.php';

class ProductController {
    public $ProModel;
    public $CateModel;
    public $CmtModel;
    public $view = "product/index";

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->ProModel  = new Product();
        $this->CateModel = new Category();
        $this->CmtModel  = new Comment();
    }

    public function set_view($viewName) {
        if ($viewName === 'productdetail' || $viewName === 'detail') {
            $this->view = 'product/detail';
        } elseif ($viewName === 'product') {
            $this->view = 'product/index';
        } else {
            $this->view = $viewName;
        }
    }

    // [Bài 1 - Chuẩn Slide] Hàm view_search($keyword)
    public function view_search($keyword) {
        if ($keyword != "") {
            $dssp = $this->ProModel->get_product_by_search($keyword);
        } else {
            $dssp = "";
        }

        if (empty($dssp)) {
            $html_dssp = '<div class="alert alert-danger" style="padding:15px; border-radius:8px; background:#f8d7da; color:#842029; font-weight:700; margin-bottom:20px;"><i class="fa-solid fa-triangle-exclamation"></i> Không tìm thấy sản phẩm nào!</div>';
            $products = [];
        } else {
            $html_dssp = $this->show_dssp($dssp);
            $products = $dssp;
        }

        $dsdm = $this->CateModel->get_category_all();
        $html_dsdm = $this->show_dsdm($dsdm);
        $categories = $dsdm;
        $currentCategory = null;
        $pageTitle = "Kết Quả Tìm Kiếm: \"$keyword\"";

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/product/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // [Bài 2 - Chuẩn Slide] Hàm view($idcategory, $page)
    public function view($idcategory = 0, $page = 1) {
        $categories = $this->CateModel->get_category_all();
        
        if ($idcategory > 0) {
            $products = $this->ProModel->getByCategory($idcategory);
            $currentCategory = $this->CateModel->getById($idcategory);
            $pageTitle = "Sản Phẩm: " . ($currentCategory ? $currentCategory['name'] : 'Tất cả');
        } else {
            $products = $this->ProModel->getAll();
            $currentCategory = null;
            $pageTitle = "Trang Sản Phẩm Áo Bóng Đá";
        }

        $html_dsdm = $this->show_dsdm($categories);
        $html_dssp = $this->show_dssp($products);

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/product/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // [Bài 3 & Bài 2 Comment - Chuẩn Slide] Hàm view_detail($id)
    public function view_detail($id) {
        $detail = $this->ProModel->get_product_one($id);
        if (!$detail) {
            header("Location: index.php?action=product");
            exit();
        }

        $catId = isset($detail["idcategory"]) ? $detail["idcategory"] : (isset($detail["category_id"]) ? $detail["category_id"] : 1);
        $dssp_lienquan = $this->ProModel->get_product_lienquan($id, $catId);
        $html_dssp_lienquan = $this->show_dssp($dssp_lienquan);
        
        $cate = $this->CateModel->get_category_one($catId);
        $tendm = "<a href='index.php?action=product&idcategory=" . ($cate['id'] ?? 1) . "'>" . htmlspecialchars($cate['name'] ?? 'Danh mục') . "</a>";

        // [Bài 2: Comment] Load bình luận theo sản phẩm này theo đúng mã mẫu Slide
        $ds_cmt = $this->CmtModel->get_comment_all($id);
        $html_ds_cmt = $this->show_ds_cmt($ds_cmt);

        $product = $detail;
        $relatedProducts = $dssp_lienquan;
        $pageTitle = ($detail['name'] ?? 'Chi Tiết Sản Phẩm') . " - Chi Tiết Áo Bóng Đá";

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/product/detail.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // [Bài 2: Comment] Xử lý gửi bình luận mới
    public function add_comment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $user_name  = trim($_POST['user_name'] ?? '');
            $content    = trim($_POST['content'] ?? '');
            $rating     = isset($_POST['rating']) ? (int)$_POST['rating'] : 5;

            if (empty($user_name) && isset($_SESSION['user'])) {
                $user_name = $_SESSION['user']['fullname'];
            }

            if ($product_id > 0 && !empty($user_name) && !empty($content)) {
                $this->CmtModel->add_comment($product_id, $user_name, $content, $rating);
            }
            header("Location: index.php?action=productdetail&id=" . $product_id . "#comments-section");
            exit();
        }
    }

    public function detail() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
        $this->view_detail($id);
    }

    public function index() {
        $catId   = isset($_GET['category_id']) ? (int)$_GET['category_id'] : (isset($_GET['idcategory']) ? (int)$_GET['idcategory'] : 0);
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        if (!empty($keyword)) {
            $this->view_search($keyword);
        } else {
            $this->view($catId, $page);
        }
    }

    // Helper render danh sách bình luận (Bài 2)
    public function show_ds_cmt($ds_cmt) {
        if (empty($ds_cmt) || !is_array($ds_cmt)) {
            return '<p style="color:var(--text-muted); font-size:14px; font-style:italic;">Chưa có bình luận nào cho mẫu áo bóng đá này. Hãy là người đầu tiên để lại đánh giá!</p>';
        }

        $html = '<div class="comment-list" style="display:flex; flex-direction:column; gap:15px;">';
        foreach ($ds_cmt as $cmt) {
            if (!is_array($cmt)) continue;
            $userName = htmlspecialchars($cmt['user_name'] ?? 'Khách hàng');
            $stars = str_repeat('★', (int)($cmt['rating'] ?? 5));
            $date = date('d/m/Y H:i', strtotime($cmt['created_at'] ?? 'now'));
            $content = htmlspecialchars($cmt['content'] ?? '');
            $html .= '
            <div class="comment-item" style="background:#f8f9fa; padding:15px; border-radius:10px; border:1px solid var(--border-color);">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                    <strong style="color:var(--primary-color); font-size:15px;"><i class="fa-solid fa-circle-user"></i> ' . $userName . '</strong>
                    <span style="color:var(--accent-hover); font-size:13px;">' . $stars . ' <small style="color:var(--text-muted);">(' . $date . ')</small></span>
                </div>
                <p style="font-size:14px; color:var(--text-dark); line-height:1.5;">' . $content . '</p>
            </div>';
        }
        $html .= '</div>';
        return $html;
    }

    public function show_dssp($dssp) {
        if (empty($dssp) || !is_array($dssp)) return '';
        $html = '';
        foreach ($dssp as $p) {
            if (is_array($p)) {
                $name = htmlspecialchars($p['name'] ?? ($p['title'] ?? 'Sản phẩm'));
                $html .= '<div class="product-item">' . $name . '</div>';
            } elseif (is_string($p)) {
                $html .= '<div class="product-item">' . htmlspecialchars($p) . '</div>';
            }
        }
        return $html;
    }

    public function show_dsdm($dsdm) {
        if (empty($dsdm) || !is_array($dsdm)) return '';
        $html = '';
        foreach ($dsdm as $c) {
            if (is_array($c)) {
                $name = htmlspecialchars($c['name'] ?? ($c['title'] ?? 'Danh mục'));
                $html .= '<div class="cat-item">' . $name . '</div>';
            } elseif (is_string($c)) {
                $html .= '<div class="cat-item">' . htmlspecialchars($c) . '</div>';
            }
        }
        return $html;
    }
}

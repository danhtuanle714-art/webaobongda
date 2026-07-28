`<?php
// Model Banner.php - Quản lý Banner theo các vị trí khác nhau trên Trang Chủ (Bài 1)
require_once __DIR__ . '/connect.php';

class Banner {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    // Lấy tất cả banner đang kích hoạt
    public function getAll() {
        if ($this->db) {
            try {
                $stmt = $this->db->query("SELECT * FROM banners WHERE status = 1 ORDER BY id ASC");
                return $stmt->fetchAll();
            } catch (PDOException $e) {}
        }
        return $this->getMockBanners();
    }

    // Lấy banner theo vị trí ('hero', 'sub', 'promo')
    public function getByPosition($position = 'hero') {
        if ($this->db) {
            try {
                $stmt = $this->db->prepare("SELECT * FROM banners WHERE position = :pos AND status = 1 ORDER BY id ASC");
                $stmt->execute(['pos' => $position]);
                $banners = $stmt->fetchAll();
                if (!empty($banners)) return $banners;
            } catch (PDOException $e) {}
        }

        $all = $this->getMockBanners();
        return array_values(array_filter($all, function($b) use ($position) {
            return $b['position'] === $position;
        }));
    }

    private function getMockBanners() {
        return [
            [
                'id' => 1,
                'title' => 'BỘ SƯU TẬP ÁO BÓNG ĐÁ 2024/25',
                'subtitle' => 'Kho áo đấu Câu Lạc Bộ, Đội Tuyển Quốc Gia cao cấp. Vải thun lạnh thoáng khí, in tên số theo yêu cầu cực đẹp.',
                'image' => 'banner_hero_1.jpg',
                'link' => 'index.php?controller=product',
                'position' => 'hero',
                'status' => 1
            ],
            [
                'id' => 2,
                'title' => 'SIÊU KHUYẾN MÃI ÁO ĐỘI BÓNG',
                'subtitle' => 'Giảm ngay 15% cho đơn hàng đặt in áo đội từ 10 bộ trở lên',
                'image' => 'banner_sub_1.jpg',
                'link' => 'index.php?controller=product',
                'position' => 'sub',
                'status' => 1
            ],
            [
                'id' => 3,
                'title' => 'DỊCH VỤ IN ẤN LẤY NGAY 24H',
                'subtitle' => 'Công nghệ in chuyển nhiệt 3D hiện đại - Không bong tróc khi giặt máy',
                'image' => 'banner_promo_1.jpg',
                'link' => 'index.php?controller=page&action=contact',
                'position' => 'promo',
                'status' => 1
            ]
        ];
    }
}
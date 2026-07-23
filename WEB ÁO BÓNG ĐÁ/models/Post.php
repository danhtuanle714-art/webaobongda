<?php
// Model Post.php - Quản lý bài viết và tin tức mới (Bài 1)
require_once __DIR__ . '/connect.php';

class Post {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    // Lấy bài viết mới nhất
    public function getLatest($limit = 3) {
        if ($this->db) {
            try {
                $stmt = $this->db->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT :limit");
                $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
            } catch (PDOException $e) {}
        }
        return $this->getMockPosts();
    }

    // Lấy chi tiết bài viết theo ID
    public function getById($id) {
        if ($this->db) {
            try {
                $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
                $stmt->execute(['id' => $id]);
                $post = $stmt->fetch();
                if ($post) return $post;
            } catch (PDOException $e) {}
        }
        $all = $this->getMockPosts();
        foreach ($all as $p) {
            if ($p['id'] == $id) return $p;
        }
        return null;
    }

    private function getMockPosts() {
        return [
            [
                'id' => 1,
                'title' => 'Hướng dẫn chọn size áo bóng đá chuẩn vóc dáng người Việt',
                'summary' => 'Bảng quy đổi size S, M, L, XL, XXL chi tiết theo chiều cao và cân nặng để bạn chọn được bộ áo vừa vặn nhất.',
                'content' => 'Nội dung hướng dẫn chi tiết cách đo vòng ngực, chiều dài thân áo...',
                'image' => 'news_size.jpg',
                'created_at' => '2026-07-15 10:00:00'
            ],
            [
                'id' => 2,
                'title' => 'Top 5 mẫu áo đấu CLB đẹp nhất mùa giải 2024/25',
                'summary' => 'Điểm qua những siêu phẩm áo đấu sân nhà của Real Madrid, Man Utd, Arsenal, Barca được cộng đồng fan đón nhận nồng nhiệt.',
                'content' => 'Đánh giá chi tiết đường nét thiết kế, hoa văn chìm...',
                'image' => 'news_top5.jpg',
                'created_at' => '2026-07-18 14:30:00'
            ],
            [
                'id' => 3,
                'title' => 'Mẹo bảo quản áo bóng đá in tên số không bao giờ bong tróc',
                'summary' => 'Bỏ túi 4 lưu ý quan trọng khi giặt và phơi áo bóng đá in tên số để trang phục luôn bền đẹp như mới.',
                'content' => 'Tránh giặt bằng nước nóng, hạn chế vắt quá mạnh...',
                'image' => 'news_care.jpg',
                'created_at' => '2026-07-20 08:00:00'
            ]
        ];
    }
}

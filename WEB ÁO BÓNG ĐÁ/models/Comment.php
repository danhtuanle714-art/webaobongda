<?php
// Model Comment.php (CmtModel) - Quản lý Bình luận theo sản phẩm (Bài 2)
require_once __DIR__ . '/connect.php';

class Comment {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    // [Bài 2] Lấy danh sách comment theo ID sản phẩm
    public function get_comment_all($product_id) {
        if ($this->db) {
            try {
                $sql = "SELECT * FROM comments WHERE product_id = :pid ORDER BY id DESC";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['pid' => $product_id]);
                $comments = $stmt->fetchAll();
                if (!empty($comments)) return $comments;
            } catch (PDOException $e) {}
        }
        return $this->getMockComments($product_id);
    }

    // [Bài 2] Thêm bình luận mới
    public function add_comment($product_id, $user_name, $content, $rating = 5) {
        if ($this->db) {
            try {
                $sql = "INSERT INTO comments (product_id, user_name, content, rating) VALUES (:product_id, :user_name, :content, :rating)";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute([
                    'product_id' => $product_id,
                    'user_name'  => $user_name,
                    'content'    => $content,
                    'rating'     => $rating
                ]);
            } catch (PDOException $e) {
                return false;
            }
        }
        return true;
    }

    private function getMockComments($product_id) {
        if ($product_id == 1) {
            return [
                [
                    'id' => 1,
                    'product_id' => 1,
                    'user_name' => 'Nguyễn Văn Minh',
                    'content' => 'Áo Real Madrid chất vải thun lạnh quá đẹp, mặc mát lạnh! In số 7 Ronaldo cực nét.',
                    'rating' => 5,
                    'created_at' => '2026-07-18 14:00:00'
                ],
                [
                    'id' => 2,
                    'product_id' => 1,
                    'user_name' => 'Trần Thị Mai',
                    'content' => 'Shop giao hàng rất nhanh, đóng gói cẩn thận. Áo mặc vừa vặn chuẩn phom.',
                    'rating' => 5,
                    'created_at' => '2026-07-19 09:30:00'
                ]
            ];
        }

        return [
            [
                'id' => 3,
                'product_id' => $product_id,
                'user_name' => 'Phạm Quốc Cường',
                'content' => 'Áo thể thao chất lượng tốt, thun mịn màng co giãn tốt. Đánh giá 5 sao!',
                'rating' => 5,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
    }
}

// Bổ sung alias CmtModel theo mã slide bài giảng
class CmtModel extends Comment {}

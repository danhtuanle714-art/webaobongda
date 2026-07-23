<?php
// Model Category.php - Xử lý dữ liệu Danh mục áo bóng đá (Bài 1, 2, 3 & Slide)
require_once __DIR__ . '/connect.php';

class Category {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    // Lấy 1 danh mục theo ID theo chuẩn Slide
    public function get_category_one($id) {
        return $this->getById($id);
    }

    public function get_category_all() {
        return $this->getAll();
    }

    public function getAll() {
        if ($this->db) {
            try {
                $stmt = $this->db->query("SELECT * FROM categories ORDER BY id ASC");
                return $stmt->fetchAll();
            } catch (PDOException $e) {}
        }
        return $this->getMockCategories();
    }

    public function getCategoriesWithProducts($limitPerCategory = 4) {
        $categories = $this->getAll();
        require_once __DIR__ . '/Product.php';
        $productModel = new Product();

        foreach ($categories as &$cat) {
            $cat['products'] = array_slice($productModel->getByCategory($cat['id']), 0, $limitPerCategory);
        }

        return $categories;
    }

    public function getById($id) {
        if ($this->db) {
            try {
                $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
                $stmt->execute(['id' => $id]);
                $category = $stmt->fetch();
                if ($category) return $category;
            } catch (PDOException $e) {}
        }

        $all = $this->getMockCategories();
        foreach ($all as $cat) {
            if ($cat['id'] == $id) return $cat;
        }
        return null;
    }

    public function add($name, $description, $image = 'default_cat.png') {
        if ($this->db) {
            try {
                $sql = "INSERT INTO categories (name, description, image) VALUES (:name, :description, :image)";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute([
                    'name' => $name,
                    'description' => $description,
                    'image' => $image
                ]);
            } catch (PDOException $e) {
                return false;
            }
        }
        return true;
    }

    public function update($id, $name, $description, $image = 'default_cat.png') {
        if ($this->db) {
            try {
                $sql = "UPDATE categories SET name = :name, description = :description, image = :image WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute([
                    'id' => $id,
                    'name' => $name,
                    'description' => $description,
                    'image' => $image
                ]);
            } catch (PDOException $e) {
                return false;
            }
        }
        return true;
    }

    public function delete($id) {
        if ($this->db) {
            try {
                $sql = "DELETE FROM categories WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute(['id' => $id]);
            } catch (PDOException $e) {
                return false;
            }
        }
        return true;
    }

    private function getMockCategories() {
        return [
            ['id' => 1, 'name' => 'Áo Câu Lạc Bộ (CLB)', 'description' => 'Real Madrid, Man Utd, Arsenal, Barca...'],
            ['id' => 2, 'name' => 'Áo Đội Tuyển Quốc Gia', 'description' => 'ĐT Việt Nam, Argentina, Pháp, Đức...'],
            ['id' => 3, 'name' => 'Áo Bóng Đá Không Logo', 'description' => 'Phù hợp in tên số đội bóng tự do'],
            ['id' => 4, 'name' => 'Áo Bóng Đá Dài Tay', 'description' => 'Giữ ấm thể thao mùa đông']
        ];
    }
}

class CategoryModel extends Category {}

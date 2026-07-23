<?php
// Model Product.php - Xử lý dữ liệu sản phẩm áo bóng đá (Bài 1, 2, 3 & Slide)
require_once __DIR__ . '/connect.php';

class Product {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    // Hàm bổ trợ sql_query_all thực thi SQL truy vấn danh sách an toàn
    public function sql_query_all($sql, $params = []) {
        if ($this->db) {
            try {
                $stmt = $this->db->prepare($sql);
                $stmt->execute($params);
                $rows = $stmt->fetchAll();
                foreach ($rows as &$row) {
                    if (isset($row['category_id'])) {
                        $row['idcategory'] = $row['category_id'];
                    }
                }
                return $rows;
            } catch (PDOException $e) {
                return [];
            }
        }
        return [];
    }

    // Hàm bổ trợ sql_query_one thực thi SQL truy vấn 1 dòng an toàn
    public function sql_query_one($sql, $params = []) {
        if ($this->db) {
            try {
                $stmt = $this->db->prepare($sql);
                $stmt->execute($params);
                $row = $stmt->fetch();
                if ($row) {
                    if (isset($row['category_id'])) {
                        $row['idcategory'] = $row['category_id'];
                    }
                    return $row;
                }
            } catch (PDOException $e) {
                return null;
            }
        }
        return null;
    }

    // [Bài 3 - Theo Slide] Lấy chi tiết 1 sản phẩm get_product_one($id)
    public function get_product_one($id) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.id = ?";
        $paran = [$id];
        $sp = $this->sql_query_one($sql, $paran);
        if ($sp) return $sp;

        // Fallback mock data if DB offline
        $all = $this->getMockProducts();
        foreach ($all as $p) {
            if ($p['id'] == $id) {
                $p['idcategory'] = $p['category_id'];
                return $p;
            }
        }
        return null;
    }

    // [Bài 3 - Theo Slide] Lấy danh sách sản phẩm liên quan get_product_lienquan($id, $idcategory)
    public function get_product_lienquan($id, $idcategory) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.id <> ? AND p.category_id = ?";
        $paran = [$id, $idcategory];
        $dssp = $this->sql_query_all($sql, $paran);
        if (!empty($dssp)) return $dssp;

        $all = $this->getMockProducts();
        $related = array_filter($all, function($p) use ($id, $idcategory) {
            return $p['category_id'] == $idcategory && $p['id'] != $id;
        });
        $result = array_values($related);
        foreach ($result as &$r) {
            $r['idcategory'] = $r['category_id'];
        }
        return $result;
    }

    // Phương thức tìm kiếm sản phẩm get_product_by_search($keyword)
    public function get_product_by_search($keyword) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE 1";
        $paran = [];
        if ($keyword != "") {
            $sql .= " AND p.name LIKE ?";
            array_push($paran, "%" . $keyword . "%");
        }
        $sp = $this->sql_query_all($sql, $paran);
        if (!empty($sp)) {
            return $sp;
        }

        $all = $this->getMockProducts();
        if ($keyword != "") {
            return array_values(array_filter($all, function($p) use ($keyword) {
                return mb_stripos($p['name'], $keyword) !== false || 
                       mb_stripos($p['category_name'], $keyword) !== false;
            }));
        }
        return $all;
    }

    public function getAll() {
        return $this->get_product_by_search("");
    }

    public function getById($id) {
        return $this->get_product_one($id);
    }

    public function getRelatedProducts($categoryId, $currentProductId, $limit = 4) {
        $dssp = $this->get_product_lienquan($currentProductId, $categoryId);
        return array_slice($dssp, 0, $limit);
    }

    public function search($keyword) {
        return $this->get_product_by_search($keyword);
    }

    public function getFeatured($limit = 6) {
        if ($this->db) {
            try {
                $sql = "SELECT p.*, c.name as category_name 
                        FROM products p 
                        JOIN categories c ON p.category_id = c.id 
                        WHERE p.is_featured = 1 
                        ORDER BY p.id DESC 
                        LIMIT :limit";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
            } catch (PDOException $e) {}
        }
        $all = $this->getMockProducts();
        return array_slice(array_filter($all, function($p) { return $p['is_featured'] == 1; }), 0, $limit);
    }

    public function getByCategory($categoryId) {
        return $this->get_product_lienquan(0, $categoryId);
    }

    // [Admin CRUD] Thêm sản phẩm mới
    public function add($category_id, $name, $price, $sale_price, $image, $description, $fabric, $is_featured) {
        if ($this->db) {
            try {
                $sql = "INSERT INTO products (category_id, name, price, sale_price, image, description, fabric, is_featured) 
                        VALUES (:category_id, :name, :price, :sale_price, :image, :description, :fabric, :is_featured)";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute([
                    'category_id' => $category_id,
                    'name'        => $name,
                    'price'       => $price,
                    'sale_price'  => $sale_price,
                    'image'       => $image,
                    'description' => $description,
                    'fabric'      => $fabric,
                    'is_featured' => $is_featured
                ]);
            } catch (PDOException $e) {
                return false;
            }
        }
        return true;
    }

    // [Admin CRUD] Cập nhật sản phẩm
    public function update($id, $category_id, $name, $price, $sale_price, $image, $description, $fabric, $is_featured) {
        if ($this->db) {
            try {
                $sql = "UPDATE products 
                        SET category_id = :category_id, name = :name, price = :price, sale_price = :sale_price, 
                            image = :image, description = :description, fabric = :fabric, is_featured = :is_featured 
                        WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute([
                    'id'          => $id,
                    'category_id' => $category_id,
                    'name'        => $name,
                    'price'       => $price,
                    'sale_price'  => $sale_price,
                    'image'       => $image,
                    'description' => $description,
                    'fabric'      => $fabric,
                    'is_featured' => $is_featured
                ]);
            } catch (PDOException $e) {
                return false;
            }
        }
        return true;
    }

    // [Admin CRUD] Xóa sản phẩm
    public function delete($id) {
        if ($this->db) {
            try {
                $sql = "DELETE FROM products WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute(['id' => $id]);
            } catch (PDOException $e) {
                return false;
            }
        }
        return true;
    }

    private function getMockProducts() {
        return [
            [
                'id' => 1,
                'category_id' => 1,
                'idcategory' => 1,
                'category_name' => 'Áo Câu Lạc Bộ (CLB)',
                'name' => 'Áo Real Madrid Sân Nhà 2024/25',
                'price' => 220000,
                'sale_price' => 185000,
                'image' => 'real_home.jpg',
                'description' => 'Áo đấu sân nhà Real Madrid mùa giải 2024/25 tông màu trắng hoàng gia thanh lịch.',
                'fabric' => 'Thun lạnh Hàn Quốc co giãn 4 chiều',
                'is_featured' => 1
            ],
            [
                'id' => 2,
                'category_id' => 1,
                'idcategory' => 1,
                'category_name' => 'Áo Câu Lạc Bộ (CLB)',
                'name' => 'Áo Manchester United Sân Nhà 2024/25',
                'price' => 220000,
                'sale_price' => 190000,
                'image' => 'mu_home.jpg',
                'description' => 'Áo đấu Quỷ Đỏ Manchester United sắc đỏ truyền thống.',
                'fabric' => 'Thun lạnh cao cấp thoáng khí',
                'is_featured' => 1
            ],
            [
                'id' => 3,
                'category_id' => 1,
                'idcategory' => 1,
                'category_name' => 'Áo Câu Lạc Bộ (CLB)',
                'name' => 'Áo Arsenal Sân Nhà 2024/25',
                'price' => 210000,
                'sale_price' => 180000,
                'image' => 'arsenal_home.jpg',
                'description' => 'Mẫu áo Arsenal Pháo Thủ London thiết kế trẻ trung.',
                'fabric' => 'Polyester cao cấp co giãn',
                'is_featured' => 1
            ],
            [
                'id' => 4,
                'category_id' => 1,
                'idcategory' => 1,
                'category_name' => 'Áo Barcelona Sân Nhà 2024/25',
                'price' => 230000,
                'sale_price' => 195000,
                'image' => 'barca_home.jpg',
                'description' => 'Áo Barca sọc xanh đỏ lamgrana kiêu hãnh kỷ niệm truyền thống CLB.',
                'fabric' => 'Thun lạnh Thái Lan xịn',
                'is_featured' => 1
            ],
            [
                'id' => 5,
                'category_id' => 2,
                'idcategory' => 2,
                'category_name' => 'Áo Đội Tuyển Quốc Gia',
                'name' => 'Áo ĐT Việt Nam Sân Nhà 2024/25 Red Dragon',
                'price' => 250000,
                'sale_price' => 210000,
                'image' => 'vietnam_home.jpg',
                'description' => 'Áo đấu chính thức Đội tuyển Quốc gia Việt Nam đỏ thắm kiêu hãnh.',
                'fabric' => 'Mè cao cấp xịn sò siêu thoáng',
                'is_featured' => 1
            ],
            [
                'id' => 6,
                'category_id' => 2,
                'idcategory' => 2,
                'category_name' => 'Áo Đội Tuyển Quốc Gia',
                'name' => 'Áo ĐT Argentina Vô Địch World Cup 3 Sao',
                'price' => 240000,
                'sale_price' => 200000,
                'image' => 'argentina_home.jpg',
                'description' => 'Áo sọc xanh trắng Argentina gắn 3 ngôi sao vàng thế giới.',
                'fabric' => 'Thun lạnh mộc 4 chiều',
                'is_featured' => 1
            ]
        ];
    }
}

class ProductModel extends Product {}

<?php
// Model connect.php - Khởi tạo kết nối CSDL bằng PDO (Bài 2)
require_once __DIR__ . '/../config/database.php';

class Connect {
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Nếu chưa import DB hoặc gặp lỗi kết nối, hiển thị thông báo hướng dẫn
            $this->conn = null;
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Connect();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

// Hàm bổ trợ kết nối nhanh
function db_connect() {
    return Connect::getInstance()->getConnection();
}

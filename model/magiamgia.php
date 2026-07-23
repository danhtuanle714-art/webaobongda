<?php
require_once __DIR__ . '/connect.php';

/**
 * Lấy tất cả mã giảm giá
 */
function magiamgia_all() {
    $sql = "SELECT * FROM magiamgia ORDER BY id DESC";
    return pdo_query($sql);
}

/**
 * Lấy mã giảm giá theo ID
 */
function magiamgia_get_by_id($id) {
    $sql = "SELECT * FROM magiamgia WHERE id = ?";
    return pdo_query_one($sql, $id);
}

/**
 * Lấy mã giảm giá theo code (sử dụng khi khách hàng áp dụng mã)
 */
function magiamgia_get_by_code($code) {
    $sql = "SELECT * FROM magiamgia WHERE code = ? LIMIT 1";
    return pdo_query_one($sql, $code);
}

/**
 * Thêm mã giảm giá mới
 */
function magiamgia_insert($code, $discount, $min_order, $expiry_date, $status) {
    $sql = "INSERT INTO magiamgia (code, discount, min_order, expiry_date, status) VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $code, $discount, $min_order, $expiry_date, $status);
}

/**
 * Cập nhật mã giảm giá
 */
function magiamgia_update($id, $code, $discount, $min_order, $expiry_date, $status) {
    $sql = "UPDATE magiamgia SET code = ?, discount = ?, min_order = ?, expiry_date = ?, status = ? WHERE id = ?";
    pdo_execute($sql, $code, $discount, $min_order, $expiry_date, $status, $id);
}

/**
 * Xóa mã giảm giá
 */
function magiamgia_delete($id) {
    $sql = "DELETE FROM magiamgia WHERE id = ?";
    pdo_execute($sql, $id);
}
?>

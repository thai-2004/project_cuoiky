<?php
session_start();
require_once '../config/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? 0;
    $quantity = $_POST['quantity'] ?? 1;
    
    // Kiểm tra sản phẩm tồn tại và số lượng tồn kho
    $stmt = $conn->prepare("SELECT id, stock FROM products WHERE id = ? AND status = 'active'");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        if ($product['stock'] >= $quantity) {
            update_cart_quantity($product_id, $quantity);
            echo json_encode(['success' => true, 'message' => 'Đã cập nhật số lượng sản phẩm']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Số lượng sản phẩm không đủ']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?> 
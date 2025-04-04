<?php
require_once '../config/db.php';
require_once '../config/functions.php';

header('Content-Type: application/json');

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'] ?? 0;
$quantity = $data['quantity'] ?? 1;

// Validate product and stock
$stmt = $conn->prepare("SELECT id, stock FROM products WHERE id = ? AND status = 'active'");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if($product = $result->fetch_assoc()) {
    // Check stock
    if($product['stock'] >= $quantity) {
        update_cart_quantity($product_id, $quantity);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Số lượng sản phẩm không đủ'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Sản phẩm không tồn tại'
    ]);
}
?> 
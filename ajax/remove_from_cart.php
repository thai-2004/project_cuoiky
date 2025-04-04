<?php
require_once '../config/db.php';
require_once '../config/functions.php';

header('Content-Type: application/json');

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'] ?? 0;

// Validate product
$stmt = $conn->prepare("SELECT id FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    remove_from_cart($product_id);
    echo json_encode(['success' => true]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Sản phẩm không tồn tại'
    ]);
}
?> 
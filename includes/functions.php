<?php
// Database connection
function getDBConnection() {
    static $conn = null;
    if ($conn === null) {
        require_once __DIR__ . '/../config/database.php';
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    return $conn;
}

// Sanitize input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Generate slug from string
function generateSlug($string) {
    $slug = strtolower($string);
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

// Format currency
function formatCurrency($amount) {
    return number_format($amount, 0, ',', '.') . ' VNĐ';
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Get current user ID
function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

// Get user data
function getUserData($userId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Add product to cart
function addToCart($userId, $productId, $quantity = 1) {
    $conn = getDBConnection();
    
    // Check if product exists in cart
    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update quantity if product exists
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("iii", $quantity, $userId, $productId);
    } else {
        // Add new item to cart
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $userId, $productId, $quantity);
    }
    
    return $stmt->execute();
}

// Get cart items
function getCartItems($userId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("
        SELECT c.*, p.name, p.price, p.image 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = ?
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result();
}

// Calculate cart total
function calculateCartTotal($userId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("
        SELECT SUM(c.quantity * p.price) as total 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = ?
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'] ?? 0;
}

// Remove item from cart
function removeFromCart($userId, $productId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $userId, $productId);
    return $stmt->execute();
}

// Update cart item quantity
function updateCartQuantity($userId, $productId, $quantity) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("iii", $quantity, $userId, $productId);
    return $stmt->execute();
}

// Get product details
function getProductDetails($productId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("
        SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE p.id = ?
    ");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Get product images
function getProductImages($productId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM product_images WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    return $stmt->get_result();
}

// Get featured products
function getFeaturedProducts($limit = 4) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM products WHERE featured = 1 LIMIT ?");
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    return $stmt->get_result();
}

// Get products by category
function getProductsByCategory($categoryId, $limit = 12) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ? LIMIT ?");
    $stmt->bind_param("ii", $categoryId, $limit);
    $stmt->execute();
    return $stmt->get_result();
}

// Get all categories
function getAllCategories() {
    $conn = getDBConnection();
    $result = $conn->query("SELECT * FROM categories ORDER BY name");
    return $result;
}

// Create order
function createOrder($userId, $totalAmount, $shippingAddress, $paymentMethod) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("
        INSERT INTO orders (user_id, total_amount, shipping_address, payment_method) 
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("idss", $userId, $totalAmount, $shippingAddress, $paymentMethod);
    $stmt->execute();
    return $conn->insert_id;
}

// Add order items
function addOrderItems($orderId, $cartItems) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("
        INSERT INTO order_items (order_id, product_id, quantity, price) 
        VALUES (?, ?, ?, ?)
    ");
    
    foreach ($cartItems as $item) {
        $stmt->bind_param("iiid", $orderId, $item['product_id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }
}

// Clear cart after order
function clearCart($userId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    return $stmt->execute();
}

// Get user orders
function getUserOrders($userId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("
        SELECT o.*, 
               COUNT(oi.id) as item_count,
               SUM(oi.quantity * oi.price) as total_amount
        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        WHERE o.user_id = ?
        GROUP BY o.id
        ORDER BY o.created_at DESC
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result();
}

// Get order details
function getOrderDetails($orderId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("
        SELECT o.*, oi.*, p.name as product_name, p.image
        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        JOIN products p ON oi.product_id = p.id
        WHERE o.id = ?
    ");
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    return $stmt->get_result();
}
?> 
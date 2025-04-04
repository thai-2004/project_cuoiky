<?php
require_once 'database.php';

// Hàm lấy cài đặt website
function get_settings() {
    global $conn;
    $settings = array();
    $result = $conn->query("SELECT * FROM settings");
    while($row = $result->fetch_assoc()) {
        $settings[$row['key']] = $row['value'];
    }
    return $settings;
}

// Hàm định dạng giá tiền
function format_price($price) {
    global $conn;
    $settings = get_settings();
    $currency = $settings['currency'] ?? 'VND';
    
    if($currency == 'VND') {
        return number_format($price, 0, ',', '.') . ' ₫';
    } else {
        return '$' . number_format($price, 2, '.', ',');
    }
}

// Hàm kiểm tra đăng nhập
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Hàm kiểm tra admin
function is_admin() {
    return isset($_SESSION['admin_id']);
}

// Hàm lấy thông tin người dùng
function get_user_info($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Hàm lấy số lượng sản phẩm trong giỏ hàng
function get_cart_count() {
    if(isset($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    }
    return 0;
}

// Hàm tính tổng tiền giỏ hàng
function get_cart_total() {
    global $conn;
    $total = 0;
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $product_id => $quantity) {
            $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($product = $result->fetch_assoc()) {
                $total += $product['price'] * $quantity;
            }
        }
    }
    return $total;
}

// Hàm kiểm tra sản phẩm có trong giỏ hàng
function is_in_cart($product_id) {
    return isset($_SESSION['cart'][$product_id]);
}

// Hàm thêm sản phẩm vào giỏ hàng
function add_to_cart($product_id, $quantity = 1) {
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if(isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

// Hàm xóa sản phẩm khỏi giỏ hàng
function remove_from_cart($product_id) {
    if(isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Hàm cập nhật số lượng sản phẩm trong giỏ hàng
function update_cart_quantity($product_id, $quantity) {
    if($quantity > 0) {
        $_SESSION['cart'][$product_id] = $quantity;
    } else {
        remove_from_cart($product_id);
    }
}

// Hàm xóa toàn bộ giỏ hàng
function clear_cart() {
    unset($_SESSION['cart']);
}

// Hàm tạo mã đơn hàng
function generate_order_code() {
    return 'ORD' . date('YmdHis') . rand(1000, 9999);
}

// Hàm gửi email
function send_email($to, $subject, $message) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: ' . get_settings()['contact_email'] . "\r\n";
    return mail($to, $subject, $message, $headers);
}

// Hàm tạo URL thân thiện
function create_slug($string) {
    $string = mb_strtolower($string, 'UTF-8');
    $string = str_replace(array('đ', 'Đ'), 'd', $string);
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    return trim($string, '-');
}

// Hàm kiểm tra xem có phải là số điện thoại hợp lệ không
function is_valid_phone($phone) {
    return preg_match('/^[0-9]{10,11}$/', $phone);
}

// Hàm kiểm tra xem có phải là email hợp lệ không
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Hàm kiểm tra xem có phải là mật khẩu mạnh không
function is_strong_password($password) {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

// Hàm tạo token ngẫu nhiên
function generate_token($length = 32) {
    return bin2hex(random_bytes($length));
}

// Hàm chuyển hướng
function redirect($url) {
    header("Location: $url");
    exit();
}

// Hàm hiển thị thông báo
function show_message($type, $message) {
    $_SESSION['message'] = array(
        'type' => $type,
        'text' => $message
    );
}

// Hàm lấy thông báo
function get_message() {
    if(isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }
    return null;
}

// Hàm lấy danh mục sản phẩm
function get_categories() {
    global $conn;
    $categories = array();
    $result = $conn->query("SELECT * FROM categories ORDER BY name ASC");
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    return $categories;
}

// Hàm lấy sản phẩm với bộ lọc
function get_filtered_products($category_id = null, $min_price = null, $max_price = null, $sort = 'newest') {
    global $conn;
    
    $where_conditions = [];
    $params = [];
    $types = '';
    
    if ($category_id) {
        $where_conditions[] = "p.category_id = ?";
        $params[] = $category_id;
        $types .= 'i';
    }
    
    if ($min_price !== null) {
        $where_conditions[] = "p.price >= ?";
        $params[] = $min_price;
        $types .= 'd';
    }
    
    if ($max_price !== null) {
        $where_conditions[] = "p.price <= ?";
        $params[] = $max_price;
        $types .= 'd';
    }
    
    $where_clause = $where_conditions ? 'WHERE ' . implode(' AND ', $where_conditions) : '';
    
    // Sort order
    $order_by = match($sort) {
        'price_asc' => 'p.price ASC',
        'price_desc' => 'p.price DESC',
        'name_asc' => 'p.name ASC',
        'name_desc' => 'p.name DESC',
        default => 'p.created_at DESC'
    };
    
    $query = "SELECT p.*, c.name as category_name 
              FROM products p 
              LEFT JOIN categories c ON p.category_id = c.id 
              $where_clause 
              ORDER BY $order_by";
    
    $stmt = $conn->prepare($query);
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = array();
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    return $products;
}

// Hàm lấy sản phẩm nổi bật
function get_featured_products($limit = 8) {
    global $conn;
    $products = array();
    
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            ORDER BY p.created_at DESC 
            LIMIT ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    return $products;
}

// Hàm lấy sản phẩm mới nhất
function get_latest_products($limit = 8) {
    global $conn;
    $products = array();
    
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            ORDER BY p.created_at DESC 
            LIMIT ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    return $products;
}
?> 
<?php
session_start();
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$user_id = getCurrentUserId();
$user = getUserData($user_id);
$cart_items = getCartItems($user_id);
$cart_total = calculateCartTotal($user_id);

if ($cart_items->num_rows === 0) {
    header('Location: cart.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = sanitizeInput($_POST['full_name']);
    $email = sanitizeInput($_POST['email']);
    $phone = sanitizeInput($_POST['phone']);
    $address = sanitizeInput($_POST['address']);
    $payment_method = sanitizeInput($_POST['payment_method']);
    
    if (empty($full_name) || empty($email) || empty($phone) || empty($address) || empty($payment_method)) {
        $error = 'Vui lòng điền đầy đủ thông tin';
    } else {
        // Create order
        $order_id = createOrder($user_id, $cart_total, $address, $payment_method);
        
        if ($order_id) {
            // Add order items
            $cart_items->data_seek(0);
            $order_items = [];
            while ($item = $cart_items->fetch_assoc()) {
                $order_items[] = [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ];
            }
            addOrderItems($order_id, $order_items);
            
            // Clear cart
            clearCart($user_id);
            
            $success = 'Đặt hàng thành công! Mã đơn hàng của bạn là: ' . $order_id;
        } else {
            $error = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - Cửa hàng trực tuyến</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .checkout-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin: 30px 0;
        }
        
        .checkout-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .order-summary {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .order-items {
            margin-bottom: 20px;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .order-total {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
        
        .error {
            color: #dc3545;
            margin-bottom: 15px;
        }
        
        .success {
            color: #28a745;
            margin-bottom: 15px;
        }
        
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container">
        <div class="checkout-container">
            <div class="checkout-form">
                <h2>Thông tin thanh toán</h2>
                
                <?php if ($error): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="success"><?php echo $success; ?></div>
                <?php else: ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="full_name">Họ và tên</label>
                            <input type="text" id="full_name" name="full_name" value="<?php echo $user['full_name']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Địa chỉ giao hàng</label>
                            <textarea id="address" name="address" rows="3" required><?php echo $user['address']; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="payment_method">Phương thức thanh toán</label>
                            <select id="payment_method" name="payment_method" required>
                                <option value="">Chọn phương thức thanh toán</option>
                                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn-submit">Đặt hàng</button>
                    </form>
                <?php endif; ?>
            </div>
            
            <div class="order-summary">
                <h2>Đơn hàng của bạn</h2>
                
                <div class="order-items">
                    <?php $cart_items->data_seek(0); ?>
                    <?php while ($item = $cart_items->fetch_assoc()): ?>
                        <div class="order-item">
                            <span><?php echo $item['name']; ?> x <?php echo $item['quantity']; ?></span>
                            <span><?php echo formatCurrency($item['price'] * $item['quantity']); ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <div class="order-total">
                    Tổng cộng: <?php echo formatCurrency($cart_total); ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html> 
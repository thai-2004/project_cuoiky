<?php
session_start();
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$user_id = getCurrentUserId();
$cart_items = getCartItems($user_id);
$cart_total = calculateCartTotal($user_id);

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_quantity'])) {
        $product_id = (int)$_POST['product_id'];
        $quantity = (int)$_POST['quantity'];
        
        if ($quantity > 0) {
            updateCartQuantity($user_id, $product_id, $quantity);
        } else {
            removeFromCart($user_id, $product_id);
        }
        
        header('Location: cart.php');
        exit();
    }
    
    if (isset($_POST['remove_item'])) {
        $product_id = (int)$_POST['product_id'];
        removeFromCart($user_id, $product_id);
        header('Location: cart.php');
        exit();
    }
    
    if (isset($_POST['checkout'])) {
        header('Location: checkout.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - Cửa hàng trực tuyến</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .cart-container {
            margin: 40px 0;
        }
        
        .cart-container h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        .cart-items {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .cart-item {
            display: grid;
            grid-template-columns: 120px 1fr auto auto;
            gap: 25px;
            padding: 25px;
            border-bottom: 1px solid #eee;
            align-items: center;
            transition: background-color 0.3s;
        }
        
        .cart-item:hover {
            background-color: #f8f9fa;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s;
        }
        
        .cart-item img:hover {
            transform: scale(1.05);
        }
        
        .cart-item-info h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
        
        .cart-item-price {
            color: #e74c3c;
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .quantity-input {
            width: 60px;
            height: 40px;
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .quantity-btn {
            width: 40px;
            height: 40px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s;
        }
        
        .quantity-btn:hover {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }
        
        .remove-btn {
            color: #e74c3c;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: 1.2rem;
            transition: color 0.3s;
        }
        
        .remove-btn:hover {
            color: #c0392b;
        }
        
        .cart-summary {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .summary-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .summary-row.total {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .checkout-btn {
            width: 100%;
            padding: 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 500;
            margin-top: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }
        
        .checkout-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .empty-cart {
            text-align: center;
            padding: 60px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .empty-cart i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-cart p {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        
        .continue-shopping-btn {
            padding: 12px 25px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .continue-shopping-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .cart-item {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 15px;
            }
            
            .cart-item img {
                width: 100%;
                height: 200px;
            }
            
            .quantity-selector {
                justify-content: center;
            }
            
            .remove-btn {
                margin-top: 10px;
            }
            
            .empty-cart {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container">
        <div class="cart-container">
            <h1><i class="fas fa-shopping-cart"></i> Giỏ hàng</h1>
            
            <?php if ($cart_items->num_rows > 0): ?>
                <div class="cart-items">
                    <?php while ($item = $cart_items->fetch_assoc()): ?>
                        <div class="cart-item">
                            <img src="../assets/images/products/<?php echo $item['image']; ?>" 
                                 alt="<?php echo $item['name']; ?>">
                            
                            <div class="cart-item-info">
                                <h3><?php echo $item['name']; ?></h3>
                                <p class="cart-item-price"><?php echo formatCurrency($item['price']); ?></p>
                            </div>
                            
                            <form method="POST" action="" class="quantity-selector">
                                <button type="button" class="quantity-btn" onclick="decreaseQuantity(<?php echo $item['product_id']; ?>)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" 
                                       name="quantity" 
                                       id="quantity_<?php echo $item['product_id']; ?>" 
                                       class="quantity-input"
                                       value="<?php echo $item['quantity']; ?>" 
                                       min="1" 
                                       onchange="updateQuantity(<?php echo $item['product_id']; ?>)">
                                <button type="button" class="quantity-btn" onclick="increaseQuantity(<?php echo $item['product_id']; ?>)">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                <input type="hidden" name="update_quantity" value="1">
                            </form>
                            
                            <form method="POST" action="">
                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                <button type="submit" name="remove_item" class="remove-btn" title="Xóa sản phẩm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Tạm tính:</span>
                        <span><?php echo formatCurrency($cart_total); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Phí vận chuyển:</span>
                        <span>Miễn phí</span>
                    </div>
                    <div class="summary-row total">
                        <span>Tổng cộng:</span>
                        <span><?php echo formatCurrency($cart_total); ?></span>
                    </div>
                    
                    <form method="POST" action="">
                        <button type="submit" name="checkout" class="checkout-btn">
                            <i class="fas fa-credit-card"></i>
                            Tiến hành thanh toán
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Giỏ hàng của bạn đang trống</p>
                    <a href="products.php" class="continue-shopping-btn">
                        <i class="fas fa-arrow-left"></i>
                        Tiếp tục mua sắm
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
    
    <script>
        function updateQuantity(productId) {
            const form = document.querySelector(`#quantity_${productId}`).closest('form');
            form.submit();
        }
        
        function decreaseQuantity(productId) {
            const input = document.getElementById(`quantity_${productId}`);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateQuantity(productId);
            }
        }
        
        function increaseQuantity(productId) {
            const input = document.getElementById(`quantity_${productId}`);
            input.value = parseInt(input.value) + 1;
            updateQuantity(productId);
        }
    </script>
</body>
</html> 
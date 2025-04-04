<?php
session_start();
require_once '../includes/functions.php';
require_once 'includes/header.php';

if (!isset($_GET['id'])) {
    header('Location: products.php');
    exit();
}

$product_id = (int)$_GET['id'];
$product = getProductDetails($product_id);

if (!$product) {
    header('Location: products.php');
    exit();
}

$product_images = getProductImages($product_id);

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
    
    $quantity = (int)$_POST['quantity'];
    if ($quantity > 0 && $quantity <= $product['stock']) {
        addToCart(getCurrentUserId(), $product_id, $quantity);
        $success_message = 'Sản phẩm đã được thêm vào giỏ hàng!';
    } else {
        $error_message = 'Số lượng không hợp lệ hoặc vượt quá số lượng trong kho.';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Cửa hàng trực tuyến</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin: 40px 0;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .product-images {
            position: relative;
        }
        
        .main-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: transform 0.3s;
        }
        
        .main-image:hover {
            transform: scale(1.02);
        }
        
        .thumbnail-container {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 5px;
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s;
        }
        
        .thumbnail:hover {
            transform: scale(1.05);
        }
        
        .thumbnail.active {
            border-color: #3498db;
        }
        
        .product-info {
            padding: 20px;
        }
        
        .product-title {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        
        .product-price {
            font-size: 2.2rem;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 25px;
        }
        
        .product-description {
            margin-bottom: 25px;
            line-height: 1.8;
            color: #666;
        }
        
        .product-meta {
            margin-bottom: 25px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .product-meta p {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .product-meta i {
            color: #3498db;
            width: 20px;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            gap: 10px;
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
        
        .quantity-input {
            width: 60px;
            height: 40px;
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .add-to-cart-btn {
            width: 100%;
            padding: 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }
        
        .add-to-cart-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .add-to-cart-btn:disabled {
            background-color: #95a5a6;
            cursor: not-allowed;
            transform: none;
        }
        
        .success-message {
            color: #27ae60;
            background-color: #d5f5e3;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .error-message {
            color: #c0392b;
            background-color: #fadbd8;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stock-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .in-stock {
            background-color: #d5f5e3;
            color: #27ae60;
        }

        .out-of-stock {
            background-color: #fadbd8;
            color: #c0392b;
        }

        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 20px;
            }
            
            .main-image {
                height: 300px;
            }
            
            .product-title {
                font-size: 1.5rem;
            }
            
            .product-price {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>  
    <div class="container">
        <div class="product-detail">
            <div class="product-images">
                <img src="../assets/images/products/<?php echo $product['image']; ?>" 
                     alt="<?php echo $product['name']; ?>" 
                     class="main-image" 
                     id="mainImage">
                
                <div class="thumbnail-container">
                    <img src="../assets/images/products/<?php echo $product['image']; ?>" 
                         alt="<?php echo $product['name']; ?>" 
                         class="thumbnail active" 
                         onclick="changeImage(this.src)">
                    
                    <?php while ($image = $product_images->fetch_assoc()): ?>
                        <img src="../assets/images/products/<?php echo $image['image_url']; ?>" 
                             alt="<?php echo $product['name']; ?>" 
                             class="thumbnail" 
                             onclick="changeImage(this.src)">
                    <?php endwhile; ?>
                </div>
            </div>
            
            <div class="product-info">
                <h1 class="product-title"><?php echo $product['name']; ?></h1>
                <p class="product-price"><?php echo formatCurrency($product['price']); ?></p>
                
                <?php if (isset($success_message)): ?>
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i>
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error_message)): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                
                <div class="product-description">
                    <?php echo nl2br($product['description']); ?>
                </div>
                
                <div class="product-meta">
                    <p>
                        <i class="fas fa-tags"></i>
                        <strong>Danh mục:</strong> <?php echo $product['category_name']; ?>
                    </p>
                    <p>
                        <i class="fas fa-box"></i>
                        <strong>Tình trạng:</strong> 
                        <span class="stock-badge <?php echo $product['stock'] > 0 ? 'in-stock' : 'out-of-stock'; ?>">
                            <?php echo $product['stock'] > 0 ? 'Còn hàng' : 'Hết hàng'; ?>
                        </span>
                    </p>
                </div>
                
                <?php if ($product['stock'] > 0): ?>
                    <form method="POST" action="">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn" onclick="decreaseQuantity()">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" 
                                   name="quantity" 
                                   id="quantity" 
                                   class="quantity-input"
                                   value="1" 
                                   min="1" 
                                   max="<?php echo $product['stock']; ?>">
                            <button type="button" class="quantity-btn" onclick="increaseQuantity()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        
                        <button type="submit" name="add_to_cart" class="add-to-cart-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Thêm vào giỏ hàng
                        </button>
                    </form>
                <?php else: ?>
                    <button class="add-to-cart-btn" disabled>
                        <i class="fas fa-times-circle"></i>
                        Hết hàng
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            event.target.classList.add('active');
        }
        
        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
        
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.max);
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
            }
        }
    </script>
</body>
</html> 
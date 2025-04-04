<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

$settings = get_settings();
$categories = get_categories();
$featured_products = get_featured_products();
$latest_products = get_latest_products();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $settings['site_name']; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="navbar-brand">
                    <h1><?php echo $settings['site_name']; ?></h1>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php" class="nav-link">Trang chủ</a></li>
                    <li><a href="products.php" class="nav-link">Sản phẩm</a></li>
                    <li><a href="about.php" class="nav-link">Giới thiệu</a></li>
                    <li><a href="contact.php" class="nav-link">Liên hệ</a></li>
                    <?php if(is_logged_in()): ?>
                        <li><a href="account.php" class="nav-link"><i class="fas fa-user"></i> Tài khoản</a></li>
                        <li><a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i> Giỏ hàng <span class="cart-count"><?php echo get_cart_count(); ?></span></a></li>
                        <li><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                    <?php else: ?>
                        <li><a href="login.php" class="nav-link"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
                        <li><a href="register.php" class="nav-link"><i class="fas fa-user-plus"></i> Đăng ký</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <section class="hero">
            <div class="container">
                <h1 class="fade-in">Chào mừng đến với <?php echo $settings['site_name']; ?></h1>
                <p class="fade-in"><?php echo $settings['site_description']; ?></p>
                <a href="products.php" class="btn btn-primary">Xem sản phẩm</a>
            </div>
        </section>

        <section class="featured-products">
            <div class="container">
                <h2 class="section-title">Sản phẩm nổi bật</h2>
                <div class="product-grid">
                    <?php foreach($featured_products as $product): ?>
                        <div class="product-card fade-in">
                            <div class="product-img-container">
                                <img src="assets/images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-img">
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><?php echo $product['name']; ?></h3>
                                <p class="product-price"><?php echo format_price($product['price']); ?></p>
                                <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="latest-products">
            <div class="container">
                <h2 class="section-title">Sản phẩm mới nhất</h2>
                <div class="product-grid">
                    <?php foreach($latest_products as $product): ?>
                        <div class="product-card fade-in">
                            <div class="product-img-container">
                                <img src="assets/images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-img">
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><?php echo $product['name']; ?></h3>
                                <p class="product-price"><?php echo format_price($product['price']); ?></p>
                                <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-links">
                    <h5>Về chúng tôi</h5>
                    <p><?php echo $settings['site_description']; ?></p>
                </div>
                <div class="footer-links">
                    <h5>Liên hệ</h5>
                    <ul>
                        <li><i class="fas fa-envelope"></i> <?php echo $settings['contact_email']; ?></li>
                        <li><i class="fas fa-phone"></i> <?php echo $settings['contact_phone']; ?></li>
                        <li><i class="fas fa-map-marker-alt"></i> <?php echo $settings['contact_address']; ?></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h5>Theo dõi chúng tôi</h5>
                    <ul class="social-links">
                        <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo $settings['site_name']; ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html> 
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config/database.php';
require_once '../config/functions.php';

$settings = get_settings();
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
</body>
</html> 
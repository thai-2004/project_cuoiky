<?php
session_start();
require_once '../config/db.php';

// Kiểm tra đăng nhập
if(!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Lấy cài đặt hiện tại
$sql = "SELECT * FROM settings";
$settings = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
$settings_array = [];
foreach($settings as $setting) {
    $settings_array[$setting['key']] = $setting['value'];
}

// Xử lý cập nhật cài đặt
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_settings'])) {
    $site_name = $_POST['site_name'];
    $site_description = $_POST['site_description'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $contact_address = $_POST['contact_address'];
    $currency = $_POST['currency'];
    $tax_rate = (float)$_POST['tax_rate'];
    $shipping_fee = (float)$_POST['shipping_fee'];
    $min_order = (float)$_POST['min_order'];
    $maintenance_mode = isset($_POST['maintenance_mode']) ? 1 : 0;
    
    // Cập nhật từng cài đặt
    $settings_to_update = [
        'site_name' => $site_name,
        'site_description' => $site_description,
        'contact_email' => $contact_email,
        'contact_phone' => $contact_phone,
        'contact_address' => $contact_address,
        'currency' => $currency,
        'tax_rate' => $tax_rate,
        'shipping_fee' => $shipping_fee,
        'min_order' => $min_order,
        'maintenance_mode' => $maintenance_mode
    ];
    
    foreach($settings_to_update as $key => $value) {
        $sql = "INSERT INTO settings (`key`, `value`) VALUES (?, ?) 
                ON DUPLICATE KEY UPDATE `value` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $key, $value, $value);
        $stmt->execute();
    }
    
    // Refresh trang để hiển thị cài đặt mới
    header('Location: settings.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cài đặt hệ thống - Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="products.php">
                        <i class="fas fa-box"></i> Sản phẩm
                    </a>
                </li>
                <li>
                    <a href="categories.php">
                        <i class="fas fa-tags"></i> Danh mục
                    </a>
                </li>
                <li>
                    <a href="orders.php">
                        <i class="fas fa-shopping-cart"></i> Đơn hàng
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <i class="fas fa-users"></i> Người dùng
                    </a>
                </li>
                <li>
                    <a href="promotions.php">
                        <i class="fas fa-gift"></i> Khuyến mãi
                    </a>
                </li>
                <li>
                    <a href="settings.php" class="active">
                        <i class="fas fa-cog"></i> Cài đặt
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <h2>Cài đặt hệ thống</h2>
                <div class="header-right">
                    <div class="notification-icon">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="user-menu">
                        <div class="user-menu-btn">
                            <img src="https://via.placeholder.com/32" alt="User" class="user-avatar">
                            <span><?php echo $_SESSION['admin_username']; ?></span>
                        </div>
                        <div class="user-menu-dropdown">
                            <a href="profile.php">
                                <i class="fas fa-user"></i> Hồ sơ
                            </a>
                            <a href="settings.php">
                                <i class="fas fa-cog"></i> Cài đặt
                            </a>
                            <a href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Form -->
            <div class="form-container">
                <form method="POST" action="">
                    <!-- Website Settings -->
                    <div class="settings-section">
                        <h3>Cài đặt website</h3>
                        
                        <div class="form-group">
                            <label for="site_name">Tên website</label>
                            <input type="text" id="site_name" name="site_name" class="form-control" 
                                   value="<?php echo $settings_array['site_name'] ?? ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="site_description">Mô tả website</label>
                            <textarea id="site_description" name="site_description" class="form-control" rows="2"><?php echo $settings_array['site_description'] ?? ''; ?></textarea>
                        </div>
                    </div>

                    <!-- Contact Settings -->
                    <div class="settings-section">
                        <h3>Thông tin liên hệ</h3>
                        
                        <div class="form-group">
                            <label for="contact_email">Email liên hệ</label>
                            <input type="email" id="contact_email" name="contact_email" class="form-control" 
                                   value="<?php echo $settings_array['contact_email'] ?? ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_phone">Số điện thoại</label>
                            <input type="text" id="contact_phone" name="contact_phone" class="form-control" 
                                   value="<?php echo $settings_array['contact_phone'] ?? ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_address">Địa chỉ</label>
                            <textarea id="contact_address" name="contact_address" class="form-control" rows="2"><?php echo $settings_array['contact_address'] ?? ''; ?></textarea>
                        </div>
                    </div>

                    <!-- Order Settings -->
                    <div class="settings-section">
                        <h3>Cài đặt đơn hàng</h3>
                        
                        <div class="form-group">
                            <label for="currency">Đơn vị tiền tệ</label>
                            <select id="currency" name="currency" class="form-control" required>
                                <option value="VND" <?php echo ($settings_array['currency'] ?? '') == 'VND' ? 'selected' : ''; ?>>VNĐ</option>
                                <option value="USD" <?php echo ($settings_array['currency'] ?? '') == 'USD' ? 'selected' : ''; ?>>USD</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="tax_rate">Thuế VAT (%)</label>
                            <input type="number" id="tax_rate" name="tax_rate" class="form-control" 
                                   value="<?php echo $settings_array['tax_rate'] ?? '10'; ?>" 
                                   min="0" max="100" step="0.01" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="shipping_fee">Phí vận chuyển</label>
                            <input type="number" id="shipping_fee" name="shipping_fee" class="form-control" 
                                   value="<?php echo $settings_array['shipping_fee'] ?? '0'; ?>" 
                                   min="0" step="1000" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="min_order">Đơn hàng tối thiểu</label>
                            <input type="number" id="min_order" name="min_order" class="form-control" 
                                   value="<?php echo $settings_array['min_order'] ?? '0'; ?>" 
                                   min="0" step="1000" required>
                        </div>
                    </div>

                    <!-- System Settings -->
                    <div class="settings-section">
                        <h3>Cài đặt hệ thống</h3>
                        
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="maintenance_mode" value="1" 
                                       <?php echo ($settings_array['maintenance_mode'] ?? '0') == '1' ? 'checked' : ''; ?>>
                                Bật chế độ bảo trì
                            </label>
                            <small class="form-text text-muted">
                                Khi bật chế độ bảo trì, website sẽ hiển thị thông báo bảo trì và chỉ admin mới có thể truy cập.
                            </small>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="update_settings" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu thay đổi
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Khôi phục
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .settings-section {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .settings-section h3 {
            margin: 0 0 20px 0;
            color: #333;
            font-size: 18px;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        
        .form-text {
            display: block;
            margin-top: 5px;
            color: #6c757d;
            font-size: 0.875em;
        }
        
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</body>
</html> 
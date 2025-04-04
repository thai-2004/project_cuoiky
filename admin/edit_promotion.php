<?php
session_start();
require_once '../config/database.php';

// Kiểm tra đăng nhập
if(!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Kiểm tra ID khuyến mãi
if(!isset($_GET['id'])) {
    header('Location: promotions.php');
    exit();
}

$id = (int)$_GET['id'];

// Lấy thông tin khuyến mãi
$sql = "SELECT * FROM promotions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$promotion = $result->fetch_assoc();

if(!$promotion) {
    header('Location: promotions.php');
    exit();
}

// Xử lý cập nhật khuyến mãi
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_promotion'])) {
    $code = $_POST['code'];
    $discount = (float)$_POST['discount'];
    $min_order = (float)$_POST['min_order'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $max_uses = (int)$_POST['max_uses'];
    $status = $_POST['status'];
    
    // Kiểm tra mã khuyến mãi trùng
    $sql = "SELECT id FROM promotions WHERE code = ? AND id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $code, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $error_message = "Mã khuyến mãi đã tồn tại!";
    } else {
        $sql = "UPDATE promotions SET code = ?, discount = ?, min_order = ?, 
                start_date = ?, end_date = ?, max_uses = ?, status = ? 
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sddssisi", $code, $discount, $min_order, $start_date, 
                         $end_date, $max_uses, $status, $id);
        $stmt->execute();
        
        header('Location: promotions.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa khuyến mãi - Admin Panel</title>
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
                    <a href="promotions.php" class="active">
                        <i class="fas fa-gift"></i> Khuyến mãi
                    </a>
                </li>
                <li>
                    <a href="settings.php">
                        <i class="fas fa-cog"></i> Cài đặt
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <h2>Chỉnh sửa khuyến mãi</h2>
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

            <!-- Edit Promotion Form -->
            <div class="form-container">
                <h3>Chỉnh sửa khuyến mãi: <?php echo $promotion['code']; ?></h3>
                
                <?php if(isset($error_message)): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="code">Mã khuyến mãi</label>
                        <input type="text" id="code" name="code" class="form-control" 
                               value="<?php echo $promotion['code']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="discount">Giảm giá (%)</label>
                        <input type="number" id="discount" name="discount" class="form-control" 
                               value="<?php echo $promotion['discount']; ?>" min="0" max="100" step="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="min_order">Đơn hàng tối thiểu</label>
                        <input type="number" id="min_order" name="min_order" class="form-control" 
                               value="<?php echo $promotion['min_order']; ?>" min="0" step="1000" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="start_date">Ngày bắt đầu</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" 
                               value="<?php echo date('Y-m-d', strtotime($promotion['start_date'])); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="end_date">Ngày kết thúc</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" 
                               value="<?php echo date('Y-m-d', strtotime($promotion['end_date'])); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="max_uses">Số lần sử dụng tối đa</label>
                        <input type="number" id="max_uses" name="max_uses" class="form-control" 
                               value="<?php echo $promotion['max_uses']; ?>" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="active" <?php echo $promotion['status'] == 'active' ? 'selected' : ''; ?>>Hoạt động</option>
                            <option value="inactive" <?php echo $promotion['status'] == 'inactive' ? 'selected' : ''; ?>>Không hoạt động</option>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" name="update_promotion" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu thay đổi
                        </button>
                        <a href="promotions.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</body>
</html> 
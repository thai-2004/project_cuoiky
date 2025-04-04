<?php
session_start();
require_once '../config/database.php';

// Kiểm tra đăng nhập
if(!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Kiểm tra ID người dùng
if(!isset($_GET['id'])) {
    header('Location: users.php');
    exit();
}

$id = (int)$_GET['id'];

// Lấy thông tin người dùng
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if(!$user) {
    header('Location: users.php');
    exit();
}

// Xử lý cập nhật thông tin
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    
    // Nếu có mật khẩu mới
    if(!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username = ?, email = ?, password = ?, phone = ?, address = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $username, $email, $password, $phone, $address, $role, $id);
    } else {
        $sql = "UPDATE users SET username = ?, email = ?, phone = ?, address = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $username, $email, $phone, $address, $role, $id);
    }
    
    $stmt->execute();
    
    header('Location: users.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa người dùng - Admin Panel</title>
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
                    <a href="users.php" class="active">
                        <i class="fas fa-users"></i> Người dùng
                    </a>
                </li>
                <li>
                    <a href="promotions.php">
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
                <h2>Chỉnh sửa người dùng</h2>
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

            <!-- Edit User Form -->
            <div class="form-container">
                <h3>Chỉnh sửa thông tin người dùng</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" class="form-control" 
                               value="<?php echo $user['username']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" 
                               value="<?php echo $user['email']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Mật khẩu mới (để trống nếu không đổi)</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" id="phone" name="phone" class="form-control" 
                               value="<?php echo $user['phone']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <textarea id="address" name="address" class="form-control" rows="2" required><?php echo $user['address']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="role">Vai trò</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>Người dùng</option>
                            <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Quản trị viên</option>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" name="update_user" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu thay đổi
                        </button>
                        <a href="users.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</body>
</html> 
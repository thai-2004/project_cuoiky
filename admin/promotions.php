<?php
session_start();
require_once '../config/database.php';

// Kiểm tra đăng nhập
if(!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Xử lý thêm khuyến mãi
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_promotion'])) {
    $code = $_POST['code'];
    $discount = (float)$_POST['discount'];
    $min_order = (float)$_POST['min_order'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $max_uses = (int)$_POST['max_uses'];
    $status = $_POST['status'];
    
    $sql = "INSERT INTO promotions (code, discount, min_order, start_date, end_date, max_uses, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sddssis", $code, $discount, $min_order, $start_date, $end_date, $max_uses, $status);
    $stmt->execute();
    
    header('Location: promotions.php');
    exit();
}

// Xử lý xóa khuyến mãi
if(isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $sql = "DELETE FROM promotions WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    header('Location: promotions.php');
    exit();
}

// Lấy danh sách khuyến mãi
$sql = "SELECT * FROM promotions ORDER BY id DESC";
$promotions = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khuyến mãi - Admin Panel</title>
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
                <h2>Quản lý khuyến mãi</h2>
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

            <!-- Add Promotion Form -->
            <div class="form-container">
                <h3>Thêm mã khuyến mãi mới</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="code">Mã khuyến mãi</label>
                        <input type="text" id="code" name="code" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="discount">Giảm giá (%)</label>
                        <input type="number" id="discount" name="discount" class="form-control" 
                               min="0" max="100" step="0.1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="min_order">Đơn hàng tối thiểu</label>
                        <input type="number" id="min_order" name="min_order" class="form-control" 
                               min="0" step="1000" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="start_date">Ngày bắt đầu</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="end_date">Ngày kết thúc</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="max_uses">Số lần sử dụng tối đa</label>
                        <input type="number" id="max_uses" name="max_uses" class="form-control" 
                               min="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="active">Hoạt động</option>
                            <option value="inactive">Không hoạt động</option>
                        </select>
                    </div>
                    
                    <button type="submit" name="add_promotion" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Thêm khuyến mãi
                    </button>
                </form>
            </div>

            <!-- Promotions List -->
            <div class="table-container">
                <h3>Danh sách khuyến mãi</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mã</th>
                            <th>Giảm giá</th>
                            <th>Đơn tối thiểu</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Số lần sử dụng</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($promotion = $promotions->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $promotion['id']; ?></td>
                            <td><?php echo $promotion['code']; ?></td>
                            <td><?php echo $promotion['discount']; ?>%</td>
                            <td><?php echo number_format($promotion['min_order']); ?> VND</td>
                            <td><?php echo date('d/m/Y', strtotime($promotion['start_date'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($promotion['end_date'])); ?></td>
                            <td><?php echo $promotion['max_uses']; ?></td>
                            <td>
                                <span class="status-badge <?php echo $promotion['status']; ?>">
                                    <?php echo ucfirst($promotion['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="edit_promotion.php?id=<?php echo $promotion['id']; ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <a href="?delete=<?php echo $promotion['id']; ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa khuyến mãi này?')">
                                    <i class="fas fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.9em;
            font-weight: 500;
        }
        
        .status-badge.active {
            background: #d4edda;
            color: #155724;
        }
        
        .status-badge.inactive {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</body>
</html> 
<?php
session_start();
require_once '../config/database.php';

// Kiểm tra đăng nhập
if(!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Lấy thống kê
$stats = [
    'total_orders' => 0,
    'total_products' => 0,
    'total_users' => 0,
    'total_revenue' => 0
];

// Lấy tổng số đơn hàng
$sql = "SELECT COUNT(*) as total FROM orders";
$result = $conn->query($sql);
$stats['total_orders'] = $result->fetch_assoc()['total'];

// Lấy tổng số sản phẩm
$sql = "SELECT COUNT(*) as total FROM products";
$result = $conn->query($sql);
$stats['total_products'] = $result->fetch_assoc()['total'];

// Lấy tổng số người dùng
$sql = "SELECT COUNT(*) as total FROM users";
$result = $conn->query($sql);
$stats['total_users'] = $result->fetch_assoc()['total'];

// Lấy tổng doanh thu
$sql = "SELECT SUM(total_amount) as total FROM orders WHERE status = 'completed'";
$result = $conn->query($sql);
$stats['total_revenue'] = $result->fetch_assoc()['total'] ?? 0;

// Lấy đơn hàng mới nhất
$sql = "SELECT o.*, u.username 
        FROM orders o 
        JOIN users u ON o.user_id = u.id 
        ORDER BY o.created_at DESC 
        LIMIT 5";
$recent_orders = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Panel</title>
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
                    <a href="dashboard.php" class="active">
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
                <h2>Dashboard</h2>
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

            <!-- Dashboard Content -->
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h3>Tổng đơn hàng</h3>
                    <div class="value"><?php echo $stats['total_orders']; ?></div>
                </div>
                <div class="dashboard-card">
                    <h3>Tổng sản phẩm</h3>
                    <div class="value"><?php echo $stats['total_products']; ?></div>
                </div>
                <div class="dashboard-card">
                    <h3>Tổng người dùng</h3>
                    <div class="value"><?php echo $stats['total_users']; ?></div>
                </div>
                <div class="dashboard-card">
                    <h3>Tổng doanh thu</h3>
                    <div class="value"><?php echo number_format($stats['total_revenue']); ?> VNĐ</div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="table-container">
                <h3>Đơn hàng gần đây</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($order = $recent_orders->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $order['id']; ?></td>
                            <td><?php echo $order['username']; ?></td>
                            <td><?php echo number_format($order['total_amount']); ?> VNĐ</td>
                            <td>
                                <span class="status-badge <?php echo $order['status']; ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                            <td>
                                <a href="order.php?id=<?php echo $order['id']; ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html> 
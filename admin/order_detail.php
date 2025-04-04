<?php
session_start();
require_once '../config/database.php';

// Kiểm tra đăng nhập
if(!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Kiểm tra ID đơn hàng
if(!isset($_GET['id'])) {
    header('Location: orders.php');
    exit();
}

$id = (int)$_GET['id'];

// Lấy thông tin đơn hàng
$sql = "SELECT o.*, u.username, u.email, u.phone, u.address 
        FROM orders o 
        JOIN users u ON o.user_id = u.id 
        WHERE o.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if(!$order) {
    header('Location: orders.php');
    exit();
}

// Lấy danh sách sản phẩm trong đơn hàng
$sql = "SELECT oi.*, p.name as product_name, p.image 
        FROM order_items oi 
        JOIN products p ON oi.product_id = p.id 
        WHERE oi.order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$order_items = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng - Admin Panel</title>
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
                    <a href="orders.php" class="active">
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
                <h2>Chi tiết đơn hàng #<?php echo $order['id']; ?></h2>
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

            <!-- Order Details -->
            <div class="order-details">
                <!-- Customer Information -->
                <div class="card">
                    <h3>Thông tin khách hàng</h3>
                    <div class="card-body">
                        <div class="info-row">
                            <span class="label">Tên:</span>
                            <span class="value"><?php echo $order['username']; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">Email:</span>
                            <span class="value"><?php echo $order['email']; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">Điện thoại:</span>
                            <span class="value"><?php echo $order['phone']; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">Địa chỉ:</span>
                            <span class="value"><?php echo $order['address']; ?></span>
                        </div>
                    </div>
                </div>

                <!-- Order Information -->
                <div class="card">
                    <h3>Thông tin đơn hàng</h3>
                    <div class="card-body">
                        <div class="info-row">
                            <span class="label">Mã đơn hàng:</span>
                            <span class="value">#<?php echo $order['id']; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">Ngày đặt:</span>
                            <span class="value"><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">Trạng thái:</span>
                            <span class="status-badge <?php echo $order['status']; ?>">
                                <?php echo ucfirst($order['status']); ?>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="label">Tổng tiền:</span>
                            <span class="value"><?php echo number_format($order['total_amount'], 0, ',', '.'); ?> VNĐ</span>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="card">
                    <h3>Danh sách sản phẩm</h3>
                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($item = $order_items->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <img src="../assets/images/products/<?php echo $item['image']; ?>" 
                                             alt="<?php echo $item['product_name']; ?>" 
                                             class="product-image">
                                    </td>
                                    <td><?php echo $item['product_name']; ?></td>
                                    <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> VNĐ</td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Actions -->
                <div class="actions">
                    <a href="orders.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                    <a href="print_order.php?id=<?php echo $order['id']; ?>" class="btn btn-primary" target="_blank">
                        <i class="fas fa-print"></i> In đơn hàng
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .order-details {
            display: grid;
            gap: 20px;
        }
        
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
        }
        
        .card h3 {
            margin: 0 0 15px 0;
            color: #333;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 10px;
        }
        
        .info-row .label {
            width: 120px;
            font-weight: 500;
            color: #666;
        }
        
        .info-row .value {
            flex: 1;
        }
        
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.9em;
            font-weight: 500;
        }
        
        .status-badge.pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-badge.processing {
            background: #cce5ff;
            color: #004085;
        }
        
        .status-badge.shipped {
            background: #d4edda;
            color: #155724;
        }
        
        .status-badge.completed {
            background: #d4edda;
            color: #155724;
        }
        
        .status-badge.cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</body>
</html> 
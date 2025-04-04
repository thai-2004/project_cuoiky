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
$sql = "SELECT oi.*, p.name as product_name 
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
    <title>In đơn hàng #<?php echo $order['id']; ?></title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .print-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        
        .header p {
            margin: 5px 0;
            color: #666;
        }
        
        .section {
            margin-bottom: 20px;
        }
        
        .section h2 {
            font-size: 18px;
            margin: 0 0 10px 0;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 5px;
        }
        
        .info-row .label {
            width: 120px;
            font-weight: bold;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background: #f5f5f5;
        }
        
        .total-row {
            font-weight: bold;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        
        @media print {
            .no-print {
                display: none;
            }
            
            body {
                padding: 0;
            }
            
            .print-container {
                border: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <!-- Header -->
        <div class="header">
            <h1>HÓA ĐƠN BÁN HÀNG</h1>
            <p>Ngày: <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
            <p>Mã đơn hàng: #<?php echo $order['id']; ?></p>
        </div>

        <!-- Customer Information -->
        <div class="section">
            <h2>Thông tin khách hàng</h2>
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

        <!-- Order Items -->
        <div class="section">
            <h2>Danh sách sản phẩm</h2>
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $stt = 1;
                    $total = 0;
                    while($item = $order_items->fetch_assoc()): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo $item['product_name']; ?></td>
                        <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
                    </tr>
                    <?php endwhile; ?>
                    <tr class="total-row">
                        <td colspan="4" style="text-align: right;">Tổng cộng:</td>
                        <td><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Order Status -->
        <div class="section">
            <h2>Trạng thái đơn hàng</h2>
            <div class="info-row">
                <span class="label">Trạng thái:</span>
                <span class="value"><?php echo ucfirst($order['status']); ?></span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Cảm ơn quý khách đã mua hàng!</p>
            <p>Mọi thắc mắc xin liên hệ: 0123 456 789</p>
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> In hóa đơn
        </button>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html> 
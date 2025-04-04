<?php
session_start();
require_once '../config/database.php';

// Kiểm tra đăng nhập
if(!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Kiểm tra ID sản phẩm
if(!isset($_GET['id'])) {
    header('Location: products.php');
    exit();
}

$id = (int)$_GET['id'];

// Lấy thông tin sản phẩm
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if(!$product) {
    header('Location: products.php');
    exit();
}

// Lấy danh sách danh mục
$sql = "SELECT * FROM categories ORDER BY name";
$categories = $conn->query($sql);

// Xử lý cập nhật sản phẩm
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = (float)$_POST['price'];
    $category_id = (int)$_POST['category_id'];
    $stock = (int)$_POST['stock'];
    $featured = isset($_POST['featured']) ? 1 : 0;
    
    // Xử lý upload ảnh
    $image = $product['image']; // Giữ ảnh cũ nếu không upload ảnh mới
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if(in_array($ext, $allowed)) {
            $new_filename = uniqid() . '.' . $ext;
            $upload_path = '../assets/images/products/' . $new_filename;
            
            if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                // Xóa ảnh cũ
                if($product['image'] && file_exists('../assets/images/products/' . $product['image'])) {
                    unlink('../assets/images/products/' . $product['image']);
                }
                $image = $new_filename;
            } else {
                $error_message = "Không thể upload ảnh!";
            }
        } else {
            $error_message = "Định dạng ảnh không hợp lệ!";
        }
    }
    
    if(!isset($error_message)) {
        $sql = "UPDATE products SET name = ?, description = ?, price = ?, 
                category_id = ?, stock = ?, featured = ?, image = ? 
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdiiisi", $name, $description, $price, $category_id, 
                         $stock, $featured, $image, $id);
        $stmt->execute();
        
        header('Location: products.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm - Admin Panel</title>
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
                    <a href="products.php" class="active">
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
                <h2>Chỉnh sửa sản phẩm</h2>
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

            <!-- Edit Product Form -->
            <div class="form-container">
                <h3>Chỉnh sửa sản phẩm: <?php echo $product['name']; ?></h3>
                
                <?php if(isset($error_message)): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
                <?php endif; ?>
                
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" id="name" name="name" class="form-control" 
                               value="<?php echo $product['name']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea id="description" name="description" class="form-control" rows="3"><?php echo $product['description']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="number" id="price" name="price" class="form-control" 
                               value="<?php echo $product['price']; ?>" min="0" step="1000" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="category_id">Danh mục</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php while($category = $categories->fetch_assoc()): ?>
                            <option value="<?php echo $category['id']; ?>" 
                                    <?php echo $category['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                                <?php echo $category['name']; ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="stock">Số lượng</label>
                        <input type="number" id="stock" name="stock" class="form-control" 
                               value="<?php echo $product['stock']; ?>" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Hình ảnh</label>
                        <?php if($product['image']): ?>
                        <div class="current-image">
                            <img src="../assets/images/products/<?php echo $product['image']; ?>" 
                                 alt="<?php echo $product['name']; ?>" 
                                 class="product-image">
                        </div>
                        <?php endif; ?>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="featured" value="1" 
                                   <?php echo $product['featured'] ? 'checked' : ''; ?>>
                            Sản phẩm nổi bật
                        </label>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" name="update_product" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu thay đổi
                        </button>
                        <a href="products.php" class="btn btn-secondary">
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
        
        .current-image {
            margin-bottom: 10px;
        }
        
        .product-image {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</body>
</html> 
<?php
require_once '../config/db.php';

// Thông tin tài khoản admin mặc định
$admin_username = 'admin';
$admin_password = 'admin123'; // Bạn nên đổi mật khẩu này sau khi đăng nhập
$admin_email = 'admin@example.com';
$admin_role = 'admin';

try {
    // Kiểm tra xem bảng admins đã tồn tại chưa
    $check_table = $conn->query("SHOW TABLES LIKE 'admins'");
    if ($check_table->num_rows == 0) {
        // Tạo bảng admins nếu chưa tồn tại
        $create_table = "CREATE TABLE admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            role VARCHAR(20) NOT NULL DEFAULT 'admin',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $conn->query($create_table);
    }

    // Kiểm tra xem đã có admin nào chưa
    $check_admin = $conn->query("SELECT * FROM admins WHERE username = 'admin'");
    if ($check_admin->num_rows == 0) {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
        
        // Thêm tài khoản admin
        $stmt = $conn->prepare("INSERT INTO admins (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $admin_username, $hashed_password, $admin_email, $admin_role);
        
        if ($stmt->execute()) {
            echo "Tài khoản admin đã được tạo thành công!<br>";
            echo "Username: " . $admin_username . "<br>";
            echo "Password: " . $admin_password . "<br>";
            echo "Email: " . $admin_email . "<br>";
            echo "<strong>Vui lòng đổi mật khẩu sau khi đăng nhập lần đầu và xóa file này!</strong>";
        } else {
            echo "Lỗi khi tạo tài khoản admin: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Tài khoản admin đã tồn tại!";
    }
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}

$conn->close();
?> 
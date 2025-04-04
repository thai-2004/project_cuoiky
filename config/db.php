<?php
// Thông tin kết nối database
$host = 'localhost';      // MySQL Host
$username = 'root';       // MySQL Username
$password = '';          // MySQL Password
$database = 'testzzzz';    // Tên database

// Tạo kết nối
$conn = new mysqli($host, $username, $password);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tạo database nếu chưa tồn tại
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === FALSE) {
    die("Lỗi khi tạo database: " . $conn->error);
}

// Chọn database
$conn->select_db($database);

// Đặt charset là utf8mb4
$conn->set_charset("utf8mb4");
?> 
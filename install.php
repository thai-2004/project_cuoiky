<?php
require_once 'config/database.php';

// Check if settings table exists and is empty
$result = $conn->query("SELECT COUNT(*) as count FROM settings");
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    // Insert default settings
    $settings_sql = "INSERT INTO settings (`key`, value) VALUES
    ('site_name', 'E-Commerce Website'),
    ('site_description', 'Your one-stop shop for all your needs'),
    ('contact_email', 'contact@example.com'),
    ('contact_phone', '0123456789'),
    ('contact_address', '123 Main Street, City, Country'),
    ('currency', 'VND'),
    ('tax_rate', '10'),
    ('shipping_fee', '30000'),
    ('min_order_amount', '100000'),
    ('maintenance_mode', '0')";
    
    if ($conn->query($settings_sql)) {
        echo "Default settings added successfully!<br>";
    } else {
        echo "Error adding settings: " . $conn->error . "<br>";
    }
}

// Check if admin user exists
$result = $conn->query("SELECT COUNT(*) as count FROM users WHERE username = 'admin'");
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    // Insert default admin user
    $admin_sql = "INSERT INTO users (username, email, password) VALUES
    ('admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')";
    
    if ($conn->query($admin_sql)) {
        echo "Default admin account created:<br>";
        echo "Username: admin<br>";
        echo "Password: admin123<br>";
    } else {
        echo "Error creating admin account: " . $conn->error . "<br>";
    }
}

echo "<a href='public/index.php'>Go to website</a>";

$conn->close();
?> 
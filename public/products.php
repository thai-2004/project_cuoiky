<?php
require_once 'includes/header.php';
require_once '../config/functions.php';
require_once '../config/database.php';


// Get filter parameters
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : null;
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : null;
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 12;


$offset = ($page - 1) * $per_page;

// Get categories for filter
$categories = get_categories();

// Build query
$where_conditions = [];
$params = [];
$types = '';

if ($category_id) {
    $where_conditions[] = "p.category_id = ?";
    $params[] = $category_id;
    $types .= 'i';
}

if ($min_price !== null) {
    $where_conditions[] = "p.price >= ?";
    $params[] = $min_price;
    $types .= 'd';
}

if ($max_price !== null) {
    $where_conditions[] = "p.price <= ?";
    $params[] = $max_price;
    $types .= 'd';
}

$where_clause = $where_conditions ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Sort order
$order_by = match($sort) {
    'price_asc' => 'p.price ASC',
    'price_desc' => 'p.price DESC',
    'name_asc' => 'p.name ASC',
    'name_desc' => 'p.name DESC',
    default => 'p.created_at DESC'
};

// Get total products count
$count_query = "SELECT COUNT(*) as total FROM products p $where_clause";
$stmt = $conn->prepare($count_query);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$total_products = $stmt->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total_products / $per_page);

// Get filtered products
$products = get_filtered_products($category_id, $min_price, $max_price, $sort);
?>

<div class="container">
    <div class="products-container">
        <div class="filters">
            <h2><i class="fas fa-filter"></i> Bộ lọc</h2>
            
            <form method="GET" action="">
                <div class="filter-group">
                    <h3><i class="fas fa-tags"></i> Danh mục</h3>
                    <select name="category" class="form-control">
                        <option value="">Tất cả</option>
                        <?php foreach($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo $category_id == $category['id'] ? 'selected' : ''; ?>>
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <h3><i class="fas fa-dollar-sign"></i> Giá</h3>
                    <input type="number" name="min_price" class="form-control" placeholder="Giá tối thiểu" value="<?php echo $min_price; ?>">
                    <input type="number" name="max_price" class="form-control" placeholder="Giá tối đa" value="<?php echo $max_price; ?>">
                </div>
                
                <div class="filter-group">
                    <h3><i class="fas fa-sort"></i> Sắp xếp</h3>
                    <select name="sort" class="form-control">
                        <option value="newest" <?php echo $sort === 'newest' ? 'selected' : ''; ?>>Mới nhất</option>
                        <option value="price_asc" <?php echo $sort === 'price_asc' ? 'selected' : ''; ?>>Giá tăng dần</option>
                        <option value="price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>Giá giảm dần</option>
                        <option value="name_asc" <?php echo $sort === 'name_asc' ? 'selected' : ''; ?>>Tên A-Z</option>
                        <option value="name_desc" <?php echo $sort === 'name_desc' ? 'selected' : ''; ?>>Tên Z-A</option>
                    </select>
                </div>
                
                <button type="submit" class="filter-btn">
                    <i class="fas fa-check"></i> Áp dụng bộ lọc
                </button>
            </form>
        </div>
        
        <div class="products-grid">
            <?php if (!empty($products)): ?>
                <?php foreach($products as $product): ?>
                    <div class="product-card fade-in">
                        <div class="product-img-container">
                            <?php 
                            $image_path = 'assets/images/products/' . $product['image'];
                            $default_image = 'assets/images/products/default.jpg';
                            ?>
                            <img src="<?php echo file_exists($image_path) ? $image_path : $default_image; ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                 class="product-img"
                                 onerror="this.src='<?php echo $default_image; ?>'">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><?php echo $product['name']; ?></h3>
                            <p class="product-price"><?php echo format_price($product['price']); ?></p>
                            <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-primary">
                                <i class="fas fa-eye"></i> Xem chi tiết
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-products">
                    <i class="fas fa-search"></i>
                    <p>Không tìm thấy sản phẩm nào phù hợp với bộ lọc của bạn.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&category=<?php echo $category_id; ?>&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>&sort=<?php echo $sort; ?>" 
                   class="<?php echo $page == $i ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?> 
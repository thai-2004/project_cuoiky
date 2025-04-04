<?php
require_once '../config/db.php';
require_once '../config/functions.php';

header('Content-Type: application/json');

$count = get_cart_count();
echo json_encode(['count' => $count]);
?> 
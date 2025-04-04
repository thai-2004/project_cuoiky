<?php
require_once '../config/db.php';
require_once '../config/functions.php';

header('Content-Type: application/json');

$total = get_cart_total();
echo json_encode(['total' => format_price($total)]);
?> 
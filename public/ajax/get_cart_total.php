<?php
session_start();
require_once '../config/functions.php';

header('Content-Type: application/json');
echo json_encode(['total' => format_price(get_cart_total())]);
?> 
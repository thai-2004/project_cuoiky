<?php
session_start();
require_once '../config/functions.php';

header('Content-Type: application/json');
echo json_encode(['count' => get_cart_count()]);
?> 
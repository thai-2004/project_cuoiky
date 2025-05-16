<?php
include_once '../dao/pdo.php';
$sql = "SELECT COUNT(*) FROM `gio_hang` WHERE id_kh = ?";
echo pdo_query_value($sql, $_POST['id_kh']);

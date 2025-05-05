<?php
include_once '../../../assets/dao/don-hang.php';
if (isset($_POST['id_don_hang'])) {
    $sql = "UPDATE don_hang SET id_trang_thai_don=? WHERE id_don_hang = ?";
    pdo_execute($sql, $_POST['trang_thai_don'], $_POST['id_don_hang']);
    $stmt = "SELECT trang_thai_don.name_trang_thai_don FROM `don_hang` JOIN trang_thai_don ON don_hang.id_trang_thai_don = trang_thai_don.id_trang_thai_don WHERE id_don_hang = ?";
    $tmp = pdo_query_one($stmt, $_POST['id_don_hang']);
    echo $tmp['name_trang_thai_don'];
}

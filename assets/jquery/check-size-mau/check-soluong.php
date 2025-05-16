<?php
include_once '../../dao/pdo.php';
if (isset($_POST['id_size']) && isset($_POST['id_mau'])) {
    echo checkSoLuong($_POST['id_san_pham'], $_POST['id_size'], $_POST['id_mau']);
}
function checkSoLuong($id_sp, $size, $id_mau)
{
    $sql = "SELECT SUM(so_luong) FROM `chi_tiet_san_pham` WHERE id_san_pham = ? AND id_size = ? AND id_mau = ?";
    return pdo_query_value($sql, $id_sp, $size, $id_mau);
}

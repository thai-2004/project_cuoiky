<?php
include_once '../../dao/pdo.php';
if (isset($_POST['id_mau'])) {
    checkColor($_POST['id_san_pham'], $_POST['id_mau']);
}
function checkColor($id_sp, $color)
{
    $sql = "SELECT COUNT(*) FROM `chi_tiet_san_pham` WHERE id_san_pham = ? AND id_mau = ?";
    echo pdo_query_value($sql, $id_sp, $color) > 0;
}

<?php
include_once '../../dao/pdo.php';
if (isset($_POST['id_size'])) {
    checkSize($_POST['id_san_pham'], $_POST['id_size']);
}
function checkSize($id_sp, $size)
{
    $sql = "SELECT COUNT(*) FROM `chi_tiet_san_pham` WHERE id_san_pham = ? AND id_size = ?";
    echo pdo_query_value($sql, $id_sp, $size) > 0;
}

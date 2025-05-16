<?php
include_once '../dao/gio-hang.php';
if (isset($_POST['so_luong']) && $_POST['id_gio_hang']) {
    gio_hang_update_so_luong_by_id($_POST['so_luong'], $_POST['id_gio_hang']);
    $sql = "SELECT (san_pham.price*gio_hang.so_luong) AS price FROM gio_hang JOIN chi_tiet_san_pham ON gio_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham WHERE id_gio_hang =?";
    $result = pdo_query_one($sql, $_POST['id_gio_hang']);
    echo number_format($result['price']);
}

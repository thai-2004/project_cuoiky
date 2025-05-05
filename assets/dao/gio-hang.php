<?php
require_once 'pdo.php';
require_once 'detail-san-pham.php';
function search_detail_id_product($id_san_pham, $id_size, $id_mau)
{
    $sql = "SELECT * FROM chi_tiet_san_pham WHERE id_san_pham = ? AND id_size = ? AND id_mau = ?";
    return pdo_query_one($sql, $id_san_pham, $id_size, $id_mau);
}

function gio_hang_insert_end_update($id_kh, $id_chi_tiet_san_pham, $so_luong)
{
    if (gio_hang_exist($id_chi_tiet_san_pham)) {
        gio_hang_update_so_luong($so_luong, $id_chi_tiet_san_pham, $id_kh);
    } else {
        $sql = "INSERT INTO gio_hang(id_kh, id_chi_tiet_san_pham, so_luong) VALUES (?,?,?)";
        pdo_execute($sql, $id_kh, $id_chi_tiet_san_pham, $so_luong);
    }
}
function gio_hang_select_all($id_kh)
{
    $sql = "SELECT gio_hang.id_gio_hang, san_pham.ten_san_pham, san_pham.hinh_anh, (san_pham.price*gio_hang.so_luong) AS price, size.size, mau.mau, gio_hang.so_luong FROM gio_hang JOIN chi_tiet_san_pham ON gio_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham JOIN size ON chi_tiet_san_pham.id_size = size.id_size JOIN mau ON chi_tiet_san_pham.id_mau = mau.id_mau WHERE gio_hang.id_kh = ?";
    return pdo_query($sql, $id_kh);
}
function  gio_hang_select_by_id($id_chi_tiet_san_pham)
{
    $sql = "SELECT * FROM gio_hang WHERE id_chi_tiet_san_pham=?";
    return pdo_query_one($sql, $id_chi_tiet_san_pham);
}
function  gio_hang_delete($id_gio_hang)
{
    $sql = "DELETE FROM gio_hang WHERE id_gio_hang=?";
    if (is_array($id_gio_hang)) {
        foreach ($id_gio_hang as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id_gio_hang);
    }
}
function gio_hang_sum_by_id_kh($id_kh)
{
    $sql = "SELECT SUM(gio_hang.so_luong*san_pham.price) AS tong_gia, COUNT(*) AS tong_sl FROM gio_hang JOIN chi_tiet_san_pham ON gio_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham WHERE gio_hang.id_kh = ?";
    return pdo_query_one($sql, $id_kh);
}
function gio_hang_checkout($id_kh)
{
    $sql = "SELECT SUM(gio_hang.so_luong*san_pham.price) AS tong_gia, SUM(gio_hang.so_luong) AS tong_sl FROM gio_hang JOIN chi_tiet_san_pham ON gio_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham WHERE gio_hang.id_kh = ?";
    return pdo_query_one($sql, $id_kh);
}
function gio_hang_select_count_sum_by_id_kh($id_kh)
{
    $sql = "SELECT SUM(so_luong) FROM gio_hang WHERE id_kh = ?";
    return pdo_query_value($sql, $id_kh);
}
function gio_hang_exist($id_chi_tiet_san_pham)
{
    $sql = "SELECT count(*) FROM gio_hang WHERE id_chi_tiet_san_pham=?";
    return pdo_query_value($sql, $id_chi_tiet_san_pham) > 0;
}
function gio_hang_update_so_luong($so_luong, $id_chi_tiet_san_pham, $id_kh)
{
    $sql = "UPDATE gio_hang SET so_luong=so_luong+? WHERE id_chi_tiet_san_pham=? AND id_kh = ?";
    pdo_execute($sql, $so_luong, $id_chi_tiet_san_pham, $id_kh);
}
function gio_hang_update_so_luong_by_id($so_luong, $id_gio_hang)
{
    $sql = "UPDATE gio_hang SET so_luong=? WHERE id_gio_hang =?";
    pdo_execute($sql, $so_luong, $id_gio_hang);
}
function gio_hang_update_price($id_gio_hang)
{
    $sql = "SELECT ( gio_hang.so_luong * san_pham.price ) AS toltal_price FROM gio_hang JOIN chi_tiet_san_pham ON gio_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham WHERE id_gio_hang = ?";
    return pdo_query_one($sql, $id_gio_hang);
}

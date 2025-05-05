<?php
require_once 'pdo.php';
function detail_san_pham_insert($so_luong, $ngay_nhap, $id_san_pham, $id_size, $id_mau)
{
    $sql = "INSERT INTO chi_tiet_san_pham( so_luong,ngay_nhap, id_san_pham, id_size, id_mau) VALUES (?,?,?,?,?)";
    pdo_execute($sql,   $so_luong, $ngay_nhap, $id_san_pham, $id_size, $id_mau);
}
function detail_san_pham_select_by($id_san_pham)
{
    $sql = "SELECT * FROM chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham JOIN size ON chi_tiet_san_pham.id_size = size.id_size JOIN mau ON chi_tiet_san_pham.id_mau = mau.id_mau WHERE chi_tiet_san_pham.id_san_pham = ?";
    return pdo_query($sql, $id_san_pham);
}
function detail_san_pham_select_by_one($id_chi_tiet_san_pham)
{
    $sql = "SELECT * FROM chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham JOIN size ON chi_tiet_san_pham.id_size = size.id_size JOIN mau ON chi_tiet_san_pham.id_mau = mau.id_mau WHERE id_chi_tiet_san_pham = ?";
    return pdo_query_one($sql, $id_chi_tiet_san_pham);
}
function detail_san_pham_update($id_chi_tiet_san_pham,   $so_luong, $id_san_pham, $id_size, $id_mau)
{
    $sql = "UPDATE chi_tiet_san_pham SET so_luong=?,id_san_pham=?,id_size=?,id_mau=? WHERE id_chi_tiet_san_pham = ?";
    pdo_execute($sql,   $so_luong, $id_san_pham, $id_size, $id_mau, $id_chi_tiet_san_pham);
}
function detail_san_pham_delete($id_chi_tiet_san_pham)
{
    $sql = "DELETE FROM chi_tiet_san_pham WHERE  id_chi_tiet_san_pham=?";
    if (is_array($id_chi_tiet_san_pham)) {
        foreach ($id_chi_tiet_san_pham as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id_chi_tiet_san_pham);
    }
}
function detail_san_pham_delete_none($id_chi_tiet_san_pham)
{
    $sql = "UPDATE chi_tiet_san_pham SET display_detail_san_pham = '0' WHERE  id_chi_tiet_san_pham=?";
    if (is_array($id_chi_tiet_san_pham)) {
        foreach ($id_chi_tiet_san_pham as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id_chi_tiet_san_pham);
    }
}
function detail_san_pham_value($id_san_pham)
{
    $sql = "SELECT SUM(so_luong) FROM chi_tiet_san_pham WHERE id_san_pham=?";
    return pdo_query_value($sql, $id_san_pham);
}
function detail_san_pham_update_soLuong($id_chi_tiet_san_pham, $so_luong)
{
    $sql = "UPDATE chi_tiet_san_pham SET so_luong=(SELECT so_luong FROM (SELECT chi_tiet_san_pham.so_luong FROM chi_tiet_san_pham WHERE id_chi_tiet_san_pham = ? LIMIT 1) AS quantyti) -? WHERE id_chi_tiet_san_pham = ?";
    return pdo_execute($sql, $id_chi_tiet_san_pham, $so_luong, $id_chi_tiet_san_pham);
}
function buy_now_product($id_san_pham, $id_size, $id_mau, $so_luong)
{
    $sql = "SELECT chi_tiet_san_pham.id_chi_tiet_san_pham, san_pham.ten_san_pham,san_pham.price, SUM(?*san_pham.price) as total_price FROM `chi_tiet_san_pham` JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham WHERE chi_tiet_san_pham.id_san_pham = ? AND id_size = ? AND id_mau = ? GROUP BY chi_tiet_san_pham.id_chi_tiet_san_pham, san_pham.ten_san_pham,san_pham.price";
    return pdo_query_one($sql, $so_luong, $id_san_pham, $id_size, $id_mau);
}
function check_so_luong_detail_product($id_san_pham, $id_size, $id_mau)
{
    $sql = "SELECT COUNT(*) FROM chi_tiet_san_pham WHERE id_san_pham =? AND id_size =? AND id_mau =?";
    return pdo_query_value($sql, $id_san_pham, $id_size, $id_mau) > 0;
}
function detail_san_pham_update_soLuong_sum($id_chi_tiet_san_pham, $so_luong)
{
    $sql = "UPDATE chi_tiet_san_pham SET so_luong=(SELECT so_luong FROM (SELECT chi_tiet_san_pham.so_luong FROM chi_tiet_san_pham WHERE id_chi_tiet_san_pham = ? LIMIT 1) AS quantyti) +? WHERE id_chi_tiet_san_pham = ?";
    return pdo_execute($sql, $id_chi_tiet_san_pham, $so_luong, $id_chi_tiet_san_pham);
}
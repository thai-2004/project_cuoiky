<?php
include_once 'pdo.php';
include_once 'gio-hang.php';
function detail_order_insert_by_khach_hang($id_kh, $id_don_hang)
{
    $tmp  = "SELECT id_chi_tiet_san_pham,so_luong FROM gio_hang WHERE id_kh = ?";
    $result = pdo_query($tmp, $id_kh);
    $sql = "INSERT INTO chi_tiet_don_hang(id_don_hang, id_chi_tiet_san_pham, so_luong) VALUES (?,?,?)";
    if (is_array($result)) {
        foreach ($result as $value) {
            pdo_execute($sql, $id_don_hang,  $value['id_chi_tiet_san_pham'], $value['so_luong']);
            detail_san_pham_update_soLuong($value['id_chi_tiet_san_pham'], $value['so_luong']);
        }
    }
    $del_gio_hang = "DELETE FROM gio_hang WHERE id_kh = ?";
    pdo_execute($del_gio_hang, $id_kh);
}
function detail_order_insert($id_don_hang, $id_chi_tiet_san_pham, $so_luong)
{
    $sql = "INSERT INTO chi_tiet_don_hang(id_don_hang, id_chi_tiet_san_pham, so_luong) VALUES (?,?,?)";
    pdo_execute($sql, $id_don_hang, $id_chi_tiet_san_pham, $so_luong);
}
function don_hang_select_all()
{
    $sql = "SELECT don_hang.*, trang_thai_don.name_trang_thai_don, user.ho_ten FROM `don_hang` JOIN trang_thai_don ON don_hang.id_trang_thai_don = trang_thai_don.id_trang_thai_don JOIN user ON don_hang.id_kh = user.id_kh ORDER BY don_hang.ngay_tao DESC";
    return pdo_query($sql);
}
function don_hang_select_all_by()
{
    $sql = "SELECT don_hang.*, trang_thai_don.name_trang_thai_don, user.ho_ten FROM `don_hang` JOIN trang_thai_don ON don_hang.id_trang_thai_don = trang_thai_don.id_trang_thai_don JOIN user ON don_hang.id_kh = user.id_kh WHERE don_hang.id_trang_thai_don = 1 ORDER BY don_hang.ngay_tao DESC";
    return pdo_query($sql);
}
function  detail_don_hang_select_all($id)
{
    $sql = "SELECT san_pham.ten_san_pham, san_pham.price, chi_tiet_don_hang.so_luong, mau.mau, size.size, SUM(san_pham.price*chi_tiet_don_hang.so_luong) AS total_price FROM `chi_tiet_don_hang` JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham JOIN size ON chi_tiet_san_pham.id_size = size.id_size JOIN mau ON chi_tiet_san_pham.id_mau = mau.id_mau WHERE id_don_hang = ? GROUP BY san_pham.ten_san_pham, san_pham.price, chi_tiet_don_hang.so_luong, mau.mau, size.size";
    return pdo_query($sql, $id);
}
function detail_history_order($id_don_hang)
{
    $sql = "SELECT chi_tiet_don_hang.id_chi_tiet_don_hang, chi_tiet_san_pham.id_chi_tiet_san_pham, san_pham.ten_san_pham,don_hang.id_trang_thai_don, san_pham.hinh_anh,mau.mau,size.size, danh_muc.ten_danh_muc, chi_tiet_don_hang.so_luong, san_pham.price, chi_tiet_don_hang.so_luong * san_pham.price AS price, SUM(chi_tiet_don_hang.so_luong * san_pham.price) AS total_price FROM `chi_tiet_don_hang` JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham JOIN mau ON chi_tiet_san_pham.id_mau = mau.id_mau JOIN size ON chi_tiet_san_pham.id_size = size.id_size JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id_danh_muc JOIN don_hang ON chi_tiet_don_hang.id_don_hang = don_hang.id_don_hang WHERE chi_tiet_don_hang.id_don_hang = ? GROUP BY chi_tiet_don_hang.id_chi_tiet_don_hang, chi_tiet_san_pham.id_chi_tiet_san_pham, san_pham.ten_san_pham, san_pham.hinh_anh,mau.mau,size.size, danh_muc.ten_danh_muc, chi_tiet_don_hang.so_luong, san_pham.price";
    return pdo_query($sql, $id_don_hang);
}
function detail_order_feedback($id_chi_tiet_don_hang)
{
    $sql = "SELECT * FROM `chi_tiet_don_hang` JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN size ON chi_tiet_san_pham.id_size = size.id_size JOIN mau ON chi_tiet_san_pham.id_mau = mau.id_mau JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham WHERE chi_tiet_don_hang.id_chi_tiet_don_hang = ?";
    return pdo_query_one($sql, $id_chi_tiet_don_hang);
}

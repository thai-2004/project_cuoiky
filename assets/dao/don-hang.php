<?php
require_once 'pdo.php';
include_once 'toast-message.php';
function don_hang_insert($id_don_hang, $id_kh, $phone, $dia_chi_giao, $id_trang_thai_don, $ngay_tao, $ngay_update, $payment_method, $note)
{
    $sql = "INSERT INTO don_hang(id_don_hang, id_kh,phone, dia_chi_giao, id_trang_thai_don, ngay_tao, ngay_update, payment_method, note) VALUES (?,?,?,?,?,?,?,?,?)";
    pdo_execute($sql, $id_don_hang, $id_kh, $phone, $dia_chi_giao, $id_trang_thai_don, $ngay_tao, $ngay_update, $payment_method, $note);
}
function don_hang_count()
{
    $sql = "SELECT COUNT(1) FROM don_hang";
    return pdo_query_count($sql);
}
function total_price($id_don_hang)
{
    $sql = "SELECT chi_tiet_don_hang.id_don_hang, SUM(san_pham.price * chi_tiet_don_hang.so_luong) AS total_price FROM chi_tiet_don_hang JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham WHERE chi_tiet_don_hang.id_don_hang = ? GROUP BY chi_tiet_don_hang.id_don_hang, chi_tiet_san_pham.id_chi_tiet_san_pham";
    $result = pdo_query($sql, $id_don_hang);
    $price = 0;
    foreach ($result as $value) {
        $price += $value['total_price'];
    }
    return number_format($price);
}
function don_hang_select()
{
    $sql = "SELECT * FROM don_hang JOIN user ON don_hang.id_kh = user.id_kh ORDER BY don_hang.ngay_tao DESC";
    return pdo_query($sql);
}
function don_hang_view_select()
{
    $sql = "SELECT don_hang.*, trang_thai_don.name_trang_thai_don FROM `don_hang` JOIN trang_thai_don ON don_hang.id_trang_thai_don = trang_thai_don.id_trang_thai_don WHERE id_kh = '' OR id_kh IS NULL ORDER BY don_hang.ngay_tao DESC";
    return pdo_query($sql);
}
function don_hang_sum($id_don_hang)
{
    $sql = "SELECT SUM(so_luong) FROM chi_tiet_don_hang WHERE id_don_hang = ?";
    return pdo_query_count($sql, $id_don_hang);
}
function don_hang_detail($id_don_hang)
{
    $sql = "SELECT chi_tiet_don_hang.id_chi_tiet_don_hang,san_pham.ten_san_pham,chi_tiet_don_hang.so_luong,san_pham.price,size.kich_thuoc,size.size,mau.mau,SUM(chi_tiet_don_hang.so_luong * san_pham.price) AS 'total_price' FROM chi_tiet_don_hang JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN size ON chi_tiet_san_pham.id_size = size.id_size JOIN mau ON chi_tiet_san_pham.id_mau = mau.id_mau JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham WHERE id_don_hang = ? GROUP BY chi_tiet_don_hang.id_chi_tiet_don_hang,san_pham.ten_san_pham,chi_tiet_don_hang.so_luong,san_pham.price,size.kich_thuoc,mau.mau";
    return pdo_query($sql, $id_don_hang);
}
function don_hang_thong_ke_home()
{
    $sql = "SELECT SUM(chi_tiet_don_hang.so_luong) AS total_dh, SUM(chi_tiet_don_hang.so_luong * san_pham.price) AS total_price, AVG( san_pham.price) AS avg_price FROM don_hang JOIN chi_tiet_don_hang ON don_hang.id_don_hang = chi_tiet_don_hang.id_don_hang JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham WHERE don_hang.id_trang_thai_don = 5";
    return pdo_query_one($sql);
}
function don_hang_history_home()
{
    $sql = "SELECT
    chi_tiet_don_hang.id_chi_tiet_don_hang,
    san_pham.ten_san_pham,
    user.ho_ten,
    danh_muc.ten_danh_muc,
    don_hang.id_don_hang,
    chi_tiet_don_hang.so_luong,
    san_pham.price,
    size.kich_thuoc,
    size.size,
    mau.mau,
    don_hang.id_trang_thai_don,
    SUM(chi_tiet_don_hang.so_luong * san_pham.price) AS 'total_price',
    AVG(chi_tiet_don_hang.so_luong * san_pham.price) AS 'avg_price'
FROM
    chi_tiet_don_hang
JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham
JOIN size ON chi_tiet_san_pham.id_size = size.id_size
JOIN don_hang ON chi_tiet_don_hang.id_don_hang = don_hang.id_don_hang  
JOIN user ON don_hang.id_kh = user.id_kh
JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham
JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id_danh_muc
JOIN mau ON chi_tiet_san_pham.id_mau = mau.id_mau
JOIN trang_thai_don ON don_hang.id_trang_thai_don = trang_thai_don.id_trang_thai_don
GROUP BY
     chi_tiet_don_hang.id_chi_tiet_don_hang,
    san_pham.ten_san_pham,
    user.ho_ten,
    danh_muc.ten_danh_muc,
    don_hang.id_don_hang,
    chi_tiet_don_hang.so_luong,
    san_pham.price,
    size.kich_thuoc,
    size.size,
    mau.mau,
    don_hang.id_trang_thai_don;
";
    return pdo_query($sql);
}
function history_order($id_kh, $status)
{
    $sql = "SELECT don_hang.*, trang_thai_don.name_trang_thai_don 
    FROM `don_hang` 
    JOIN trang_thai_don ON don_hang.id_trang_thai_don = trang_thai_don.id_trang_thai_don 
    WHERE id_kh = ? AND FIND_IN_SET(don_hang.id_trang_thai_don, ?)";
    return pdo_query($sql, $id_kh, $status);
}

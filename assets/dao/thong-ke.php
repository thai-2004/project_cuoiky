<?php
require_once 'pdo.php';
function thong_ke_thong_bao()
{
    $user = "SELECT * FROM user ORDER BY id_kh DESC LIMIT 1";
    $don_hang = "SELECT * FROM `don_hang` JOIN user ON don_hang.id_kh = user.id_kh ORDER BY don_hang.id_don_hang DESC LIMIT 1";
    $arr = [pdo_query_one($user), pdo_query_one($don_hang)];
    return $arr;
}
function thong_ke_san_pham()
{
    $sql = "SELECT danh_muc.ten_danh_muc, COUNT(chi_tiet_san_pham.so_luong) AS total_sl, MIN(chi_tiet_san_pham.gia_ban) AS gia_min, MAX(chi_tiet_san_pham.gia_ban) AS gia_max, AVG(chi_tiet_san_pham.gia_ban) AS gia_avg FROM san_pham JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id_danh_muc JOIN chi_tiet_san_pham ON san_pham.id_san_pham = chi_tiet_san_pham.id_san_pham GROUP BY san_pham.ten_san_pham, danh_muc.ten_danh_muc";
    return pdo_query($sql);
}
function thong_ke_da_ban()
{
    $sql = "SELECT san_pham.ten_san_pham, don_hang.ngay_tao, SUM(chi_tiet_don_hang.so_luong) AS so_luong FROM `san_pham` JOIN chi_tiet_san_pham ON san_pham.id_san_pham = chi_tiet_san_pham.id_san_pham JOIN chi_tiet_don_hang ON chi_tiet_san_pham.id_chi_tiet_san_pham = chi_tiet_don_hang.id_chi_tiet_san_pham JOIN don_hang ON chi_tiet_don_hang.id_don_hang = don_hang.id_don_hang WHERE don_hang.id_trang_thai_don = 5 GROUP BY san_pham.ten_san_pham, don_hang.ngay_tao";
    return pdo_query($sql);
}
function thong_ke_tinh_trang()
{
    $sql = "SELECT (SELECT COUNT(id_don_hang) FROM don_hang WHERE id_trang_thai_don = '1') AS so_don_hang_cho_xac_nhan, (SELECT COUNT(id_don_hang) FROM don_hang WHERE id_trang_thai_don = '2') AS so_don_hang_da_xac_nhan, (SELECT COUNT(id_don_hang) FROM don_hang WHERE id_trang_thai_don = '3') AS so_don_hang_dang_xu_ly, (SELECT COUNT(id_don_hang) FROM don_hang WHERE id_trang_thai_don = '5') AS so_don_hang_da_giao_hang, (SELECT COUNT(id_don_hang) FROM don_hang WHERE id_trang_thai_don = '6') AS so_don_hang_da_huy";
    return pdo_query_one($sql);
}
function thong_ke_bxh_mua()
{
    $sql = "SELECT san_pham.ten_san_pham, COUNT(chi_tiet_don_hang.id_chi_tiet_san_pham) AS so_luot FROM chi_tiet_don_hang JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham GROUP BY san_pham.ten_san_pham ORDER BY so_luot DESC";
    return pdo_query($sql);
}
function thong_ke_bxh_xem()
{
    $sql = "SELECT san_pham.ten_san_pham, san_pham.luot_xem FROM `san_pham` ORDER BY luot_xem DESC";
    return pdo_query($sql);
}
function thong_ke_doanh_thu_dm()
{
    $sql = "SELECT danh_muc.ten_danh_muc, SUM( chi_tiet_don_hang.so_luong * san_pham.price ) AS total_dh FROM don_hang JOIN chi_tiet_don_hang ON don_hang.id_don_hang = chi_tiet_don_hang.id_don_hang JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id_danh_muc WHERE don_hang.id_trang_thai_don = 5 GROUP BY danh_muc.ten_danh_muc";
    return pdo_query($sql);
}
function thong_ke_bieu_do()
{
    $sql = "SELECT user.ho_ten, danh_muc.ten_danh_muc, don_hang.ngay_tao, SUM( chi_tiet_don_hang.so_luong * san_pham.price ) AS total_dh FROM don_hang JOIN chi_tiet_don_hang ON don_hang.id_don_hang = chi_tiet_don_hang.id_don_hang JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham JOIN danh_muc ON san_pham.id_danh_muc= danh_muc.id_danh_muc JOIN user ON don_hang.id_kh = user.id_kh GROUP BY user.ho_ten, danh_muc.ten_danh_muc, don_hang.ngay_tao";
    return pdo_query($sql);
}
function thong_ke_doanh_thu_kh()
{
    $sql = "SELECT user.ho_ten, SUM(chi_tiet_don_hang.so_luong * san_pham.price) AS total_dh FROM don_hang JOIN chi_tiet_don_hang ON don_hang.id_don_hang = chi_tiet_don_hang.id_don_hang JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham JOIN user ON don_hang.id_kh = user.id_kh WHERE don_hang.id_trang_thai_don = 5 GROUP BY user.ho_ten";
    return pdo_query($sql);
}
function thong_ke_binh_luan()
{
    $sql = "SELECT san_pham.ma_hh, san_pham.ten_hh,"
        . " COUNT(*) so_luong,"
        . " MIN(binh_luan.ngay_bl) cu_nhat,"
        . " MAX(binh_luan.ngay_bl) moi_nhat"
        . " FROM binh_luan  "
        . " JOIN san_pham  ON san_pham.ma_hh=binh_luan.ma_hh "
        . " GROUP BY san_pham.ma_hh, san_pham.ten_hh"
        . " HAVING so_luong > 0";
    return pdo_query($sql);
}

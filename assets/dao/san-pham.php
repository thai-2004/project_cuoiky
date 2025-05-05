<?php
require_once 'pdo.php';
function san_pham_insert($ten_san_pham, $price, $mo_ta, $hinh_anh, $luot_xem, $ngay_nhap, $id_danh_muc)
{
    $sql = "INSERT INTO san_pham(ten_san_pham,price, mo_ta, hinh_anh, luot_xem,ngay_nhap, id_danh_muc) VALUES (?,?,?,?,?,?,?)";
    pdo_execute($sql, $ten_san_pham, $price, $mo_ta, $hinh_anh, $luot_xem, $ngay_nhap, $id_danh_muc);
}

function san_pham_update($id_san_pham, $ten_san_pham, $price, $mo_ta, $hinh_anh, $luot_xem, $id_danh_muc)
{
    $sql = "UPDATE san_pham SET ten_san_pham=?,price=?,mo_ta=?,hinh_anh=?,luot_xem=?,id_danh_muc=? WHERE  id_san_pham=?";
    pdo_execute($sql, $ten_san_pham, $price, $mo_ta, $hinh_anh, $luot_xem, $id_danh_muc, $id_san_pham);
}
function san_pham_update_display($id_san_pham)
{
    $sql = "UPDATE san_pham SET display_san_pham='1' WHERE  id_san_pham=?";
    if (is_array($id_san_pham)) {
        foreach ($id_san_pham as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id_san_pham);
    }
}
function san_pham_delete($id_san_pham)
{
    $sql = "DELETE FROM san_pham WHERE  id_san_pham=?";
    if (is_array($id_san_pham)) {
        foreach ($id_san_pham as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id_san_pham);
    }
}
function san_pham_delete_none($id_san_pham)
{
    $sql = "UPDATE san_pham SET display_san_pham='0' WHERE  id_san_pham=?";
    if (is_array($id_san_pham)) {
        foreach ($id_san_pham as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id_san_pham);
    }
}
function san_pham_delete_by_danh_muc($id_danh_muc)
{
    $sql = "DELETE FROM san_pham WHERE  id_danh_muc=?";
    if (is_array($id_danh_muc)) {
        foreach ($id_danh_muc as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id_danh_muc);
    }
}
function san_pham_delete_by_danh_muc_none($id_danh_muc)
{
    $sql = "UPDATE san_pham SET display_san_pham='0' WHERE   id_danh_muc=?";
    if (is_array($id_danh_muc)) {
        foreach ($id_danh_muc as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id_danh_muc);
    }
}
function san_pham_gia_ban_by_id($id_san_pham, $id_size)
{
    $sql = "SELECT chi_tiet_san_pham.gia_ban FROM `san_pham` JOIN chi_tiet_san_pham ON san_pham.id_san_pham = chi_tiet_san_pham.id_san_pham WHERE san_pham.id_san_pham =? AND chi_tiet_san_pham.id_size = ?";
    return pdo_query_one($sql, $id_san_pham, $id_size);
}
function san_pham_select_all()
{
    $sql = "SELECT * FROM san_pham JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id_danh_muc";
    return pdo_query($sql);
}
function san_pham_select_product_new()
{
    $sql = "SELECT * FROM san_pham ORDER BY san_pham.id_san_pham DESC";
    return pdo_query($sql);
}
function san_pham_select_best_seller()
{
    $sql = "SELECT danh_muc.id_danh_muc, san_pham.id_san_pham, san_pham.ten_san_pham, san_pham.price, san_pham.mo_ta, san_pham.hinh_anh, san_pham.display_san_pham, SUM(chi_tiet_don_hang.so_luong) AS so_luong_ban FROM chi_tiet_don_hang JOIN chi_tiet_san_pham ON chi_tiet_don_hang.id_chi_tiet_san_pham = chi_tiet_san_pham.id_chi_tiet_san_pham JOIN san_pham ON chi_tiet_san_pham.id_san_pham = san_pham.id_san_pham JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id_danh_muc GROUP BY danh_muc.id_danh_muc,san_pham.id_san_pham, san_pham.ten_san_pham, san_pham.price, san_pham.mo_ta, san_pham.hinh_anh, san_pham.display_san_pham ORDER BY so_luong_ban DESC";
    return pdo_query($sql);
}
function san_pham_select_by_id($id_san_pham)
{
    san_pham_tang_so_luot_xem($id_san_pham);
    $sql = "SELECT san_pham.* ,danh_muc.ten_danh_muc, SUM(chi_tiet_san_pham.so_luong) AS total_quantity FROM `san_pham` JOIN chi_tiet_san_pham ON san_pham.id_san_pham = chi_tiet_san_pham.id_san_pham JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id_danh_muc WHERE san_pham.id_san_pham =? GROUP BY san_pham.id_san_pham";
    return pdo_query_one($sql, $id_san_pham);
}

function san_pham_exist($id_san_pham)
{
    $sql = "SELECT count(*) FROM san_pham WHERE id_san_pham=?";
    return pdo_query_value($sql, $id_san_pham) > 0;
}
function san_pham_count()
{
    $sql = "SELECT count(*) FROM san_pham ";
    return pdo_query_count($sql);
}
function san_pham_count_by_id_san_pham($id_danh_muc)
{
    $sql = "SELECT count(*) FROM san_pham WHERE id_danh_muc = ?";
    return pdo_query_count($sql, $id_danh_muc);
}
function san_pham_tang_so_luot_xem($id_san_pham)
{
    $sql = "UPDATE san_pham SET luot_xem = luot_xem + 1 WHERE id_san_pham=?";
    pdo_execute($sql, $id_san_pham);
}
function san_pham_select_top_table($start, $end, $table)
{
    $sql = "SELECT * FROM san_pham ORDER BY $table  LIMIT $start, $end";
    return pdo_query($sql);
}
function san_pham_select_top_colum_by_loai($start, $end, $colum, $id_danh_muc)
{
    $sql = "SELECT * FROM san_pham WHERE id_danh_muc IN($id_danh_muc) ORDER BY $colum  LIMIT $start, $end";
    return pdo_query($sql);
}
function san_pham_select_don_gia($min, $max)
{
    $sql = "SELECT * FROM san_pham WHERE don_gia BETWEEN ? AND ?;";
    return pdo_query($sql, $min, $max);
}
function san_pham_select_top10()
{
    $sql = "SELECT * FROM san_pham WHERE so_luot_xem > 0 ORDER BY so_luot_xem DESC LIMIT 0, 10";
    return pdo_query($sql);
}
function san_pham_select_top1()
{
    $sql = "SELECT * FROM san_pham  ORDER BY giam_gia DESC LIMIT 1";
    return pdo_query_one($sql);
}
function san_pham_select_dac_biet()
{
    $sql = "SELECT * FROM san_pham WHERE dac_biet=1";
    return pdo_query($sql);
}

function san_pham_select_by_loai($id_danh_muc)
{
    $sql = "SELECT * FROM san_pham WHERE id_danh_muc=?";
    return pdo_query($sql, $id_danh_muc);
}

function san_pham_select_keyword($keyword)
{
    $sql = "SELECT * FROM san_pham " . " JOIN loai_hang  ON loai_hang.id_danh_muc=san_pham.id_danh_muc " . " WHERE ten_san_pham LIKE ? OR ten_loai LIKE ?";
    return pdo_query($sql, '%' . $keyword . '%', '%' . $keyword . '%');
}

function san_pham_exist_by_danh_muc($id_danh_muc)
{
    $sql = "SELECT count(*) FROM san_pham WHERE id_danh_muc=?";
    return pdo_query_value($sql, $id_danh_muc) > 0;
}
function exist_param($param_name)
{
    return isset($_REQUEST[$param_name]);
}
function san_pham_select_page()
{
    if (!isset($_POST['page_no'])) {
        $_POST['page_no'] = 0;
    }
    if (exist_param("page_no")) {
        $_POST['page_no'] = $_REQUEST['page_no'];
    }
    if ($_POST['page_no'] < 0) {
        $_POST['page_no'] = $_POST['page_count'] - 1;
    }
    if ($_POST['page_no'] >= $_POST['page_count']) {
        $_POST['page_no'] = 0;
    }
    $sql = "SELECT * FROM san_pham ORDER BY id_san_pham LIMIT " . $_POST['page_no'] . ", 10";
    return pdo_query($sql);
}
function san_pham_min_max_price()
{
    $sql = "SELECT MIN(price) AS price_min, MAX(price) AS price_max FROM san_pham";
    return pdo_query_one($sql);
}
function san_pham_filter_price($id_danh_muc, $price_min, $price_max, $start, $end)
{
    $sql = "SELECT * FROM san_pham WHERE id_danh_muc IN($id_danh_muc) AND price BETWEEN ? AND ? ORDER BY price LIMIT $start, $end";
    return pdo_query($sql, $price_min, $price_max);
}
function san_pham_filter_color($id_danh_muc, $color, $start, $end)
{
    $sql = "SELECT san_pham.* FROM san_pham JOIN chi_tiet_san_pham ON san_pham.id_san_pham = chi_tiet_san_pham.id_san_pham WHERE chi_tiet_san_pham.id_mau = ? AND id_danh_muc IN($id_danh_muc)  ORDER BY price LIMIT $start, $end";
    return pdo_query($sql, $color);
}
function san_pham_short($id_danh_muc, $colum, $start, $end)
{
    $sql = "SELECT san_pham.* FROM san_pham JOIN chi_tiet_san_pham ON san_pham.id_san_pham = chi_tiet_san_pham.id_san_pham WHERE id_danh_muc IN($id_danh_muc) ORDER BY $colum DESC LIMIT $start, $end";
    return pdo_query($sql);
}
function san_pham_short_name($id_danh_muc, $colum, $start, $end)
{
    $sql = "SELECT san_pham.* FROM san_pham JOIN chi_tiet_san_pham ON san_pham.id_san_pham = chi_tiet_san_pham.id_san_pham WHERE id_danh_muc IN($id_danh_muc) ORDER BY $colum  LIMIT $start, $end";
    return pdo_query($sql);
}
function search_autocomplete($keyword)
{
    $sql = "SELECT `ten_san_pham` FROM `san_pham` WHERE ten_san_pham LIKE '%$keyword%'";
    return pdo_query($sql);
}
function result_search($keyword, $start, $end)
{
    $sql = "SELECT * FROM san_pham JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id_danh_muc WHERE san_pham.ten_san_pham LIKE '%$keyword%' OR danh_muc.ten_danh_muc LIKE '%$keyword%' ORDER BY id_san_pham  LIMIT $start, $end";
    return pdo_query($sql);
}
function san_pham_tuong_tu($id_danh_muc, $id_san_pham)
{
    $sql = "SELECT * FROM san_pham WHERE id_danh_muc = ? AND id_san_pham != ?";
    return pdo_query($sql, $id_danh_muc, $id_san_pham);
}
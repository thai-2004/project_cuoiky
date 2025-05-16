<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../dao/pdo.php';
include_once '../dao/don-hang.php';
include_once '../dao/detail-don-hang.php';
include_once '../dao/gio-hang.php';
include_once '../dao/payment.php';
//=======================================================================Hàm mua ngay sản phẩm=======================================================================
function buy_Now_Order($id_don_hang, $id_kh, $ho_ten, $id_chi_tiet_san_pham, $phone, $dia_chi_giao, $date, $payment_method, $note, $so_luong, $total_price, $status_oder, $status_payment)
{
    don_hang_insert($id_don_hang, $id_kh, $phone, $dia_chi_giao, $status_oder,  $date,  $date, $payment_method, $note);
    detail_order_insert($id_don_hang, $id_chi_tiet_san_pham, $so_luong);
    detail_san_pham_update_soLuong($id_chi_tiet_san_pham, $so_luong);
    payment_insert($id_don_hang, $total_price,  $payment_method, $status_payment);
    if (isset($_POST['order'])) {
        unset($_SESSION['order']);
    }
    $_SESSION['order']['id_chi_tiet_san_pham'] = $id_chi_tiet_san_pham;
    $_SESSION['order']['date'] = $date;
    $_SESSION['order']['payment_method'] = $payment_method;
    $_SESSION['order']['total_price'] = $total_price;
    $_SESSION['order']['id_don_hang'] = $id_don_hang;
    $_SESSION['order']['id_kh'] = $id_kh;
    $_SESSION['order']['dia_chi_giao'] = $dia_chi_giao;
    $_SESSION['order']['ho_ten']  = $ho_ten;
    $_SESSION['order']['phone']  =  $phone;
    $_SESSION['order']['note'] = $note;
    $_SESSION['order']['so_luong']  = $so_luong;
}
//=======================================================================Hàm mua thông qua giỏ hàng=======================================================================
function buyShopping($id_don_hang, $id_kh, $ho_ten, $phone, $dia_chi_giao, $status_oder,  $date, $payment_method, $note, $total_price, $status_payment, $so_luong, $id_chi_tiet_san_pham)
{
    don_hang_insert($id_don_hang, $id_kh, $phone, $dia_chi_giao, $status_oder,  $date,  $date, $payment_method, $note);
    detail_order_insert_by_khach_hang($id_kh, $id_don_hang);
    payment_insert($id_don_hang, $total_price, $payment_method, $status_payment);
    if (isset($_POST['order'])) {
        unset($_SESSION['order']);
    }
    $_SESSION['order']['id_chi_tiet_san_pham'] = $id_chi_tiet_san_pham;
    $_SESSION['order']['date'] = $date;
    $_SESSION['order']['payment_method'] = $payment_method;
    $_SESSION['order']['total_price'] = $total_price;
    $_SESSION['order']['id_don_hang'] = $id_don_hang;
    $_SESSION['order']['id_kh'] = $id_kh;
    $_SESSION['order']['dia_chi_giao'] = $dia_chi_giao;
    $_SESSION['order']['ho_ten']  = $ho_ten;
    $_SESSION['order']['phone']  =  $phone;
    $_SESSION['order']['note'] = $note;
    $_SESSION['order']['so_luong']  = $so_luong;
}
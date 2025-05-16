<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once 'method-order.php';
include_once '../dao/giam-gia.php';
date_default_timezone_set("Asia/Ho_Chi_Minh");
$date = date('Y-m-d H:i:s');
if (isset($_POST['id_voucher']) && $_POST['id_voucher'] != '') {
    giam_gia_update_so_luong($_POST['id_voucher']);
}
if (isset($_POST['paymentMethod'])) {
    $act_payments = $_POST['paymentMethod'];
} else {
    $act_payments = 'ATM';
}
switch ($act_payments) {
        //=====================================================================================================Thanh toán khi nhận hàng=====================================================================================================
    case 'shipCod':
        if (isset($_SESSION['login'])) {
            if ($_POST['id_chi_tiet_san_pham'] == null || $_POST['id_chi_tiet_san_pham'] == '') {
                buyShopping($_POST['id_don_hang'], $_POST['id_kh'], $_POST['ho_ten'], $_POST['phone'], $_POST['dia_chi_giao'], 1,  $date, 'Thanh toán khi nhận hàng', $_POST['note'], $_POST['total_price'], 0, $_POST['so_luong'], $_POST['id_chi_tiet_san_pham']);
            } else {
                buy_Now_Order($_POST['id_don_hang'], $_POST['id_kh'], $_POST['ho_ten'], $_POST['id_chi_tiet_san_pham'], $_POST['phone'], $_POST['dia_chi_giao'], $date, 'Thanh toán khi nhận hàng', $_POST['note'], $_POST['so_luong'], $_POST['total_price'], 1, 0);
            }
        } else {
            buy_Now_Order($_POST['id_don_hang'], null, $_POST['ho_ten'], $_POST['id_chi_tiet_san_pham'], $_POST['phone'], $_POST['dia_chi_giao'], $date, 'Thanh toán khi nhận hàng', $_POST['note'], $_POST['so_luong'], $_POST['total_price'], 1, 0);
        }
        echo 'http://localhost/bandongho/index.php?act=order-confirm';
        break;
        //=====================================================================================================Thanh toán ATM=====================================================================================================
    case 'ATM':
        if (!isset($_SESSION['order'])) {
            echo "Không tìm thấy thông tin đơn hàng!";
            echo '<script>
                alert("Không tìm thấy thông tin đơn hàng!");
                window.location.href = "../../index.php";
            </script>';
            exit();
        }
        
        // Kiểm tra các khóa cần thiết
        $required_keys = ['id_don_hang', 'id_kh', 'ho_ten', 'phone', 'dia_chi_giao', 'note', 'total_price', 'so_luong', 'id_chi_tiet_san_pham'];
        $missing_keys = [];
        foreach ($required_keys as $key) {
            if (!isset($_SESSION['order'][$key])) {
                $missing_keys[] = $key;
            }
        }
        
        if (!empty($missing_keys)) {
            echo "Thiếu thông tin đơn hàng: " . implode(', ', $missing_keys);
            echo '<script>
                alert("Thiếu thông tin đơn hàng!");
                window.location.href = "../../index.php";
            </script>';
            exit();
        }
        
        if (isset($_SESSION['login'])) {
            if ($_SESSION['order']['id_chi_tiet_san_pham'] == '' || $_SESSION['order']['id_chi_tiet_san_pham'] == null) {
                buyShopping($_SESSION['order']['id_don_hang'], $_SESSION['order']['id_kh'], $_SESSION['order']['ho_ten'], $_SESSION['order']['phone'], $_SESSION['order']['dia_chi_giao'], 1, $date, 'Thanh toán Online', $_SESSION['order']['note'], $_SESSION['order']['total_price'], 1, $_SESSION['order']['so_luong'], $_SESSION['order']['id_chi_tiet_san_pham']);
            } else {
                buy_Now_Order($_SESSION['order']['id_don_hang'], $_SESSION['order']['id_kh'], $_SESSION['order']['ho_ten'], $_SESSION['order']['id_chi_tiet_san_pham'], $_SESSION['order']['phone'], $_SESSION['order']['dia_chi_giao'], $date, 'Thanh toán Online', $_SESSION['order']['note'], $_SESSION['order']['so_luong'], $_SESSION['order']['total_price'], 1, 1);
            }
        } else {
            buy_Now_Order($_SESSION['order']['id_don_hang'], null, $_SESSION['order']['ho_ten'], $_SESSION['order']['id_chi_tiet_san_pham'], $_SESSION['order']['phone'], $_SESSION['order']['dia_chi_giao'], $date, 'Thanh toán Online', $_SESSION['order']['note'], $_SESSION['order']['so_luong'], $_SESSION['order']['total_price'], 1, 1);
        }
        header('location: ../../index.php?act=order-confirm');
        break;
}

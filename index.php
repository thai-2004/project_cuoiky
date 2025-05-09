<?php
// Hiển thị lỗi chi tiết để debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION)) {
    session_start();
}
ob_start();
include_once 'assets/dao/pdo.php';
include_once 'assets/dao/khach-hang.php';
include_once 'assets/dao/loai.php';
include_once 'assets/dao/san-pham.php';
include_once 'assets/dao/size.php';
include_once 'assets/dao/mau.php';
include_once 'assets/dao/gio-hang.php';
include_once 'assets/dao/danh-gia.php';
include_once 'assets/dao/giam-gia.php';
include_once 'assets/dao/detail-don-hang.php';
include_once 'PHPMailer-master/sendmail.php';
include_once 'assets/dao/toast-message.php';
include_once 'assets/dao/don-hang.php';
include_once 'assets/dao/detail-don-hang.php';
include_once 'assets/dao/payment.php';
$list_sales = giam_gia_select();
$list_danhMuc = loai_select_all();
$id_danh_muc_all = '';
foreach ($list_danhMuc as $value) {
    $id_danh_muc_all .= $value['id_danh_muc'] . ',';
}
$id_danh_muc_all = rtrim($id_danh_muc_all, ',');


$list_size = size_select();
$list_color = mau_select();
include_once 'view/header.php';
if (isset($_GET['act']) && $_GET['act']) {
    $act = $_GET['act'];
    switch ($act) {
            // Quản lý user
        case 'login':
            if (isset($_GET['falseAdmin'])) {
                showErrorToast('Bạn cần phải đăng nhập với quyền admin!');
            }
            if (isset($_POST['login']) && $_POST['login']) {
                $arr_login = [
                    'ho_ten' => $_POST['user-name'],
                    'password' => $_POST['user-password'],
                ];
                foreach ($arr_login as $key => $value) {
                    if (empty($value)) {
                        $error_login["$key"] = 'Trường dữ liệu không được bỏ trống';
                    }
                }
                if (empty($error_login)) {
                    user_login($arr_login['ho_ten'], $arr_login['password']);
                }
            }
            include_once 'view/trang-chu/login-register.php';
            break;
        case 'register':
            if (isset($_POST['register']) && $_POST['register']) {
                $arr_register = [
                    'ho_ten' => $_POST['ho_ten'],
                    'user-name' => $_POST['user-name'],
                    'user-password' => $_POST['user-password'],
                    'user-email' => $_POST['user-email']
                ];
                foreach ($arr_register as $key => $value) {
                    if (empty($value)) {
                        $error_register["$key"] = 'Trường dữ liệu không được bỏ trống';
                    }
                }
                if (empty($error_register)) {
                    user_insert($arr_register['ho_ten'], $arr_register['user-name'], $arr_register['user-password'], $arr_register['user-email'], '', 'no-avatar.jpg', 1, '', 1, 1, 1);
                }
            }
            include_once 'view/trang-chu/login-register.php';
            break;
        case 'setting-user':
            if (isset($_POST['change-user']) && $_POST['change-user']) {
                $login = user_select_by_id($_SESSION['login']['id_kh']);
                $arr_change_user = [
                    'ho_ten' => $_POST['ho_ten'],
                    'ten_dang_nhap' => $_POST['ten_dang_nhap'],
                    'mat_khau' => $_POST['mat_khau'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'dia_chi' => $_POST['dia_chi'],
                    'id_kh' => $_POST['id_kh']
                ];
                if ($_FILES['hinh_anh']['size'] <= 0) {
                    $arr_change_user['hinh_anh']['name'] = $login['hinh_anh'];
                } else {
                    $arr_change_user['hinh_anh']['name'] = $_FILES['hinh_anh']['name'];
                    $path_file = 'assets/images/avatar/' . $_FILES['hinh_anh']['name'];
                    move_uploaded_file($_FILES['hinh_anh']['tmp_name'], $path_file);
                }
                foreach ($arr_change_user as $key => $value) {
                    if (empty($value)) {
                        $error_change_user["$key"] = 'Trường dữ liệu không được bỏ trống';
                    }
                }
                if (empty($error_change_user)) {
                    user_update($arr_change_user['id_kh'], $arr_change_user['ho_ten'], $arr_change_user['ten_dang_nhap'], $arr_change_user['mat_khau'], $arr_change_user['email'], $arr_change_user['phone'], $arr_change_user['hinh_anh']['name'], 1, $arr_change_user['dia_chi'], 1, 1, $login['id_roles']);
                    showSuccessToast('Cập nhập thông tin tài khoản thành công!');
                    header('location: index.php?act=setting-user');
                } else {
                    showErrorToast('Bạn phải điền đẩy đủ thông tin!');
                }
            } else
                include_once 'view/trang-chu/quan-ly-user.php';
            break;
        case 'logout':
            user_logout();
            header('location: index.php');
            break;
        case 'forgot_password':
            if (isset($_POST['forgot']) && $_POST['forgot']) {
                $arr_forgot = [
                    'user-name' => $_POST['user-name'],
                    'user-email' => $_POST['user-email']
                ];
                foreach ($arr_forgot as $key => $value) {
                    if (empty($value)) {
                        $error_forgot["$key"] = 'Trường dữ liệu không được bỏ trống';
                    }
                }
                if (empty($error_forgot)) {
                    $thongTin_forgot = user_tim_pass($arr_forgot['user-name'], $arr_forgot['user-email']);
                    $_SESSION['maXacNhan'] = mt_rand(00001, 99999);
                    $_SESSION['id_kh'] = $thongTin_forgot['id_kh'];
                    sendMail($thongTin_forgot['email'], $thongTin_forgot['ho_ten'], $_SESSION['maXacNhan']);
                    include_once 'view/trang-chu/new-password.php';
                }
            } else
                include_once 'view/trang-chu/forgot-pass.php';
            break;
        case 'newPassword':
            if (isset($_POST['xacNhan']) && $_POST['xacNhan']) {
                if (!empty($_POST['newPassword'])) {
                    user_change_password($_SESSION['id_kh'], $_POST['newPassword']);
                    session_destroy();
                    showSuccessToast('Cập nhập mật khẩu mới thành công!');
                    include_once 'view/trang-chu/login-register.php';
                }
            }
            break;
            // Quản lý user end
            // Chi tiết sản phẩm start
        case 'product-details':
            include_once 'view/page/product-detail.php';
            break;
            // Chi tiết sản phẩm end
            // Giỏ hàng
        case 'cart':
            if (!isset($_SESSION['login'])) {
                include_once 'view/trang-chu/login-register.php';
                showErrorToast('Bạn cần đăng nhập để sử dụng được giỏ hàng');
            } else {
                include_once 'view/page/cart.php';
            }
            break;
            // Thanh toán
        case 'checkout':
            include_once 'view/page/check-out.php';
            break;
            // Đơn mua
        case 'history-carts':
            include_once 'view/trang-chu/history-cart.php';
            break;
        case 'detail-history-order':
            include_once 'view/trang-chu/detail-order.php';
            break;
        case 'cancel-order':
            if (isset($_GET['id'])) {
                $sql = "SELECT id_trang_thai_don FROM don_hang WHERE id_don_hang= ?";
                $status = pdo_query_one($sql, $_GET['id']);
                if ($status['id_trang_thai_don'] > 1) {
                    include_once 'view/trang-chu/detail-order.php';
                    showErrorToast('Xin lỗi bạn! đơn hàng đã cập nhập trạng thái không thể huỷ được!');
                } else {
                    $query_up_sl = "SELECT id_chi_tiet_san_pham, so_luong FROM chi_tiet_don_hang WHERE id_don_hang = ?";
                    $order = pdo_query($query_up_sl,  $_GET['id']);
                    foreach ($order as $value) {
                        detail_san_pham_update_soLuong_sum($value['id_chi_tiet_san_pham'], $value['so_luong']);
                    }
                    $sql = "UPDATE don_hang SET id_trang_thai_don=6 WHERE id_don_hang = ?";
                    pdo_execute($sql, $_GET['id']);
                    include_once 'view/trang-chu/detail-order.php';
                    showSuccessToast('Huỷ đơn hàng thành công!');
                }
            }
            break;
        case 'order-confirm':
            include_once 'assets/jquery/order.php';
            // unset($_SESSION['order']);
            break;
        case 'feedback-order':
            include_once 'view/trang-chu/feedback-order.php';
            break;
        case 'about-us':
            include_once 'view/page/about-us.php';
            break;
        case 'blog-details':
            include_once 'view/page/blog-details.php';
            break;
        case 'contact-us':
            include_once 'view/page/contact-us.php';
            break;
    }
} else {
    include_once 'view/trang-chu/home.php';
}
include_once 'view/footer.php';
ob_end_flush();

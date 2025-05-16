<?php
require_once '../dao/pdo.php';
require_once '../dao/detail-san-pham.php';
require_once '../dao/gio-hang.php';
require_once '../dao/toast-message.php';
// sử lý thêm vào giỏ hảng (jquery)
if (isset($_POST['id_san_pham']) && isset($_POST['id_size'])  && isset($_POST['id_mau']) && isset($_POST['so_luong'])) {
    $search_id = search_detail_id_product($_POST['id_san_pham'], $_POST['id_size'], $_POST['id_mau']);
    if ($search_id['id_chi_tiet_san_pham']) {
        gio_hang_insert_end_update($_POST['id_kh'], $search_id['id_chi_tiet_san_pham'], $_POST['so_luong']);
    }
}
// sử lý thêm vào giỏ hảng (jquery) end
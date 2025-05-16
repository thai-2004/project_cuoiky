<?php
include_once '../../dao/detail-san-pham.php';
if (isset($_POST['check'])) {
    echo check_so_luong_detail_product($_POST['id_san_pham'], $_POST['id_size'], $_POST['id_mau']);
}

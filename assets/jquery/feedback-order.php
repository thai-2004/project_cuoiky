<?php
include_once '../dao/danh-gia.php';
date_default_timezone_set("Asia/Ho_Chi_Minh");
if (isset($_POST['numberStart'])) {
    echo 'hel';
    danh_gia_insert($_POST['id_kh'], $_POST['id_san_pham'], $_POST['numberStart'], $_POST['content'], date('Y-m-d'), 1);
}
echo 'hel0';

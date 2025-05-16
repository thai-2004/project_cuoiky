<?php
include_once '../dao/don-hang.php';
if (isset($_POST['id_kh'])) {
    $history_order = history_order($_POST['id_kh'], $_POST['status']);
    if (!$history_order) {
        echo '<p class="text-warning text-center py-5"> Không có đơn hàng nào! </p>';
        die();
    }
}
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Mã đơn hàng</th>
            <th>Trạng thái đơn</th>
            <th>Phương thức thanh toán</th>
            <th>Ngày đặt</th>
            <th>Ghi chú</th>
            <th>Hành đồng</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($history_order as $value) : ?>
        <tr>
            <td class="text-primary"><?= $value['id_don_hang'] ?></td>
            <td><?= $value['name_trang_thai_don'] ?></td>
            <td><?= $value['payment_method'] ?></td>
            <td><?= $value['ngay_tao'] ?></td>
            <td><?= $value['note'] ?></td>
            <td>
                <a href="?act=detail-history-order&id=<?php echo $value['id_don_hang'] ?>">Xem chi tiết</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
include_once '../dao/gio-hang.php';
if (isset($_POST['delete'])) {
    gio_hang_delete($_POST['delete']);
}
if (isset($_POST['so_luong']) && $_POST['id_gio_hang']) {
    gio_hang_update_so_luong_by_id($_POST['so_luong'], $_POST['id_gio_hang']);
}
if (isset($_POST['id_kh'])) {
    $list_cart = gio_hang_select_all($_POST['id_kh']);
    $sumCarts = gio_hang_sum_by_id_kh($_POST['id_kh']);
}
?>
<div class="container">
    <div class="row">
        <div class="col-8 ">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center ">
                    <input type="checkbox" name="checkAll" id="" onclick="inputcheckAll()" value="0">

                    <span class="">Chọn tất cả(<?php echo $sumCarts['tong_sl'] ?> sản phẩm)</span>
                </div>
                <div id="btn-delete">
                    <i class="fas fa-trash-alt"></i>
                    <span>Xoá</span>
                </div>
            </div>
            <?php foreach ($list_cart as $value) : ?>
                <div class="item-cart">
                    <form class="cart-form">
                        <input type="text" hidden value="<?= $value['id_gio_hang'] ?>" name="id_gio_hang">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-between border-top">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="" id="" value="<?php echo $value['id_gio_hang'] ?>">
                                    <img src="assets/images/product/<?= $value['hinh_anh'] ?>" alt="" style="width: 80px; height: 80px; object-fit: cover;" class="py-2">
                                    <div class="">
                                        <h5><?= $value['ten_san_pham'] ?></h5>
                                        <p class="text-black-50">Size: <?= $value['size'] ?>, Màu: <?= $value['mau'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="">
                                    <p class="text-danger price-product"><?= number_format($value['price']) ?>đ</p>
                                </div>
                                <div class="quantity">
                                    <input type="number" value="<?= $value['so_luong'] ?>" class="inputQuantity text-center" min="1">
                                </div>
                                <a href="<?= $value['id_gio_hang'] ?>" id="delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xoá sản phẩm"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Thông tin đơn hàng -->
        <div class="col-4">
            <div class="bg-secondary p-3" style="--bs-bg-opacity: 0.1; border-radius: 5px; ">
                <h4>Thông tin đơn hàng</h4>
                <div class="d-flex align-items-center justify-content-between my-2">
                    <p class="m-0 fw-normal">Tạm
                        tính(<?php echo (isset($sumCarts['tong_sl'])) ? $sumCarts['tong_sl'] : 0 ?> sản phẩm)</p>
                    <p class="text-danger fw-lighter">
                        <?php echo (isset($sumCarts['tong_gia'])) ? number_format($sumCarts['tong_gia']) : 0 ?>đ</p>
                </div>
                <div class="d-flex align-items-center justify-content-between my-2">
                    <p class="m-0 fw-normal">Tổng cộng</p>
                    <p class="text-danger fw-lighter">
                        <?php echo (isset($sumCarts['tong_gia'])) ? number_format($sumCarts['tong_gia']) : 0 ?>đ</p>
                </div>
                <div class="cart-page-total m-0">
                    <a href="?act=checkout" class="proceed-checkout-btn" style="width: 100%; text-align: center;">Mua
                        hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
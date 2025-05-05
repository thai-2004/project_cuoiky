<?php
if (isset($_GET['id'])) {
    $detail_order = detail_history_order($_GET['id']);
    $total_price = payment_price($_GET['id']);
}
?>

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->
<!-- main-content-wrap start -->
<div class="main-content-wrap section-ptb history-cart">
    <div class="container">
        <div class="row">
            <?php include_once 'sidebar-account.php' ?>
            <div class="col-8">
                <h5 style="color: #c89979;">Chi tiết đơn hàng: <span><?= $_GET['id'] ?></span></h5>
                <div class="d-flex justify-content-between align-items-center ">
                    <a href="?act=history-carts">Xem tất cả đơn hàng</a>
                    <?php if ($detail_order[0]['id_trang_thai_don'] == 1) :  ?>
                        <div class="d-flex justify-content-end"><a href="?act=cancel-order&id=<?php echo $_GET['id'] ?>" class="btn btn-outline-danger p-1 ">Huỷ đơn
                                hàng</a>
                        </div>
                    <?php endif ?>
                </div>
                <div class="">
                    <table class="table table-hover">
                        <tbody>
                            <?php foreach ($detail_order as $value) : ?>
                                <tr>
                                    <div class="p-3 bg-secondary my-2" style="--bs-bg-opacity: .09;">
                                        <div class="d-flex justify-content-between align-items-end border-bottom pb-2 mb-1">
                                            <div class="d-flex">
                                                <img src="assets/images/product/<?php echo $value['hinh_anh'] ?>" alt="" style="width: 80px; height: 80px; object-fit: cover;">
                                                <div class="ms-2">
                                                    <h5 class="m-0"><?php echo $value['ten_san_pham'] ?></h5>
                                                    <p class="m-0 text-black-50">Phân loại:
                                                        <?php echo $value['ten_danh_muc'] ?>
                                                        -<?php echo $value['mau'] ?>,<?php echo $value['size'] ?>
                                                    </p>
                                                    <p>x<?php echo $value['so_luong'] ?></p>
                                                </div>
                                            </div>
                                            <p class="text-danger"><?php echo number_format($value['price']) ?>đ</p>
                                        </div>
                                    </div>
                                </tr>
                                <?php if ($value['id_trang_thai_don'] == 5) : ?>
                                    <div class="d-flex justify-content-end"><a href="?act=feedback-order&id=<?php echo $value['id_chi_tiet_don_hang'] ?>" class="btn btn-outline-danger p-1 ">Viết đánh giá</a>
                                    </div>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <h5 class="">Tổng đơn hàng: <span class="text-danger"><?php echo number_format($total_price) ?>đ</span>
                                </h5>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- main-content-wrap end -->
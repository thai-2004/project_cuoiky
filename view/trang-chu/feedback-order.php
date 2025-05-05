<?php
if (isset($_GET['id'])) {
    $order_feedback =  detail_order_feedback($_GET['id']);
    $have_feedback = danh_gia_exist_products($_GET['id']);
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
                    <li class="breadcrumb-item active">Đánh giá sản phẩm</li>
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
        <div class="row mb-3">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title d-flex">
                        <img src="assets/images/product/<?= $order_feedback['hinh_anh'] ?>" alt="" style="width: 120px; height: 120px;">
                        <div class="pt-3">
                            <h5 class="mb-0"><?= $order_feedback['ten_san_pham'] ?></h5>
                            <span style="font-size: 12px;" class="text-black-50"><?= $order_feedback['mau'] ?>,
                                <?= $order_feedback['size'] ?></span>
                        </div>
                    </h5>
                    <div class="d-flex flex-column align-items-center">
                        <?php if (!empty($have_feedback)) : ?>
                            <span class="badge text-bg-success">Bạn đã đánh giá sản phẩm này</span>
                        <?php else : ?>
                            <h6 class="card-subtitle mb-2 text-muted ">
                                <ul class="product-rating d-flex start-feedback-order  ">
                                    <li data-start="1" class="fs-4 btn-start"><i data-toggle="tooltip" data-placement="top" title="Rất tệ" class="fa fa-star-o "></i></li>
                                    <li data-start="2" class="fs-4 btn-start"><i data-toggle="tooltip" data-placement="top" title="Tệ" class="fa fa-star-o "></i></li>
                                    <li data-start="3" class="fs-4 btn-start"><i data-toggle="tooltip" data-placement="top" title="Ok" class="fa fa-star-o "></i></li>
                                    <li data-start="4" class="fs-4 btn-start"><i data-toggle="tooltip" data-placement="top" title="Tốt" class="fa fa-star-o "></i></li>
                                    <li data-start="5" class="fs-4 btn-start"><i data-toggle="tooltip" data-placement="top" title="Xuất sắc" class="fa fa-star-o "></i></li>
                                </ul>
                            </h6>
                            <p>Đánh giá sản phẩm này <span class="text-danger">*</span></p>
                    </div>
                    <p class="card-text">
                    <div class="">
                        <textarea class="form-control content-feedback" placeholder="Bạn có thích hoặc không thích điều gì về sản phẩm này?" style="height: 100px"></textarea>

                    </div>
                    </p>
                    <p class="card-link"><button type="button" class="btn btn-info" value="<?= $order_feedback['id_san_pham'] ?>">Gửi</button></p>
                <?php endif ?>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- main-content-wrap end -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../dao/detail-san-pham.php';
include_once '../dao/giam-gia.php';
date_default_timezone_set("Asia/Ho_Chi_Minh");
$list_sales = giam_gia_select();
if (isset($_POST['byNow'])) {
    $buyNows = buy_now_product($_POST['id_san_pham'], $_POST['id_size'], $_POST['id_mau'], $_POST['so_luong']);
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
                    <li class="breadcrumb-item active">Thanh toán</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- main-content-wrap start -->
<div class="main-content-wrap section-ptb checkout-page">
    <div class="container">
        <!-- checkout-details-wrapper start -->
        <div class="checkout-details-wrapper">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <!-- billing-details-wrap start -->
                    <div class="billing-details-wrap">
                        <form action="#">
                            <h3 class="shoping-checkboxt-title" style="color: #c89979;"><i class="fas fa-map-marker-alt"></i>Địa chỉ
                                nhận
                                hàng</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p class="single-form-row">
                                        <label>Họ và tên<span class="required">*</span></label>
                                        <input type="text" name="ho_ten" value="<?php echo (isset($_SESSION['login'])) ? $_SESSION['login']['ho_ten'] : '' ?>">
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="single-form-row">
                                        <label>Số điện thoại<span class="required">*</span></label>
                                        <input type="text" name="phone" value="<?php echo (isset($_SESSION['login'])) ? $_SESSION['login']['phone'] : '' ?>">
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    <div class="single-form-row">
                                        <label>Tỉnh thành<span class="required">*</span></label>
                                        <div class="">
                                            <select id="city">
                                                <option value="" selected>Chọn tỉnh thành</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-20">
                                    <div class="single-form-row">
                                        <label>Quận huyện<span class="required">*</span></label>
                                        <div class="">
                                            <select id="district">
                                                <option value="" selected>Chọn quận huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="single-form-row">
                                        <label>Phường xã<span class="required">*</span></label>
                                        <div class="">
                                            <select id="ward" style="width: 100;">
                                                <option value="" selected>Chọn phường xã</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <p class="single-form-row m-0">
                                        <label>Ghi chú đặt hàng</label>
                                        <textarea placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: địa chỉ cụ thể, thời gian nhận trong ngày..." class="checkout-mess" rows="2" cols="5"></textarea>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- billing-details-wrap end -->
                </div>
                <div class="col-lg-6 col-md-6">
                    <!-- your-order-wrapper start -->
                    <div class="your-order-wrapper">
                        <h3 class="shoping-checkboxt-title" style="color: #c89979;">Đơn hàng của bạn</h3>
                        <!-- your-order-wrap start-->
                        <div class="your-order-wrap rounded">
                            <!-- your-order-table start -->
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-total">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                <?php echo $buyNows['ten_san_pham'] ?> <strong class="product-quantity">
                                                    ×
                                                    <?php echo $_POST['so_luong'] ?></strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount"><?php echo number_format($buyNows['price']) ?>đ</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="order-total byNow">
                                            <th class="fw-semibold">Tổng số đơn
                                                hàng(<?php echo (isset($_POST['so_luong'])) ? $_POST['so_luong'] : 0 ?>)
                                            </th>
                                            <td>
                                                <strong>
                                                    <span class="amount"><?php echo (isset($buyNows['total_price'])) ? number_format($buyNows['total_price']) : 0 ?>đ</span>
                                                    <span class="amount-new ps-3"></span>

                                                </strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- your-order-table end -->
                            <?php if (isset($_SESSION['login'])) : ?>
                                <div class="coupon-info ps-4">
                                    <p class="checkout-coupon">
                                        <input readonly type="text" placeholder="Mã giảm giá" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <button type="submit" class="btn button-apply-coupon" name="apply_coupon" value="Apply coupon">Áp dụng</button>
                                    </p>
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <?php foreach ($list_sales as $value) : if ($value['display_gg'] == 0) {
                                                    continue;
                                                } ?>
                                                <div class="voucher d-flex align-items-center justify-content-between border-bottom py-2">
                                                    <div class="d-flex">
                                                        <img src="assets/images/icon/sale.png" alt="" style="width: 40px; height: 40px;">
                                                        <div class="info-voucher ms-3">
                                                            <h6 class="mb-1">Giảm <?= $value['giam_gia'] ?>%</h6>
                                                            <span class="text-black-50">Số lượng còn:<?= $value['so_luong'] ?> |
                                                                HSD: <?= $value['ngay_het_han'] ?></span>
                                                        </div>
                                                    </div>
                                                    <?php if ($value['ngay_het_han'] < date('Y-m-d')) : ?>
                                                        <span class="badge text-bg-danger">Hết hạn</span>
                                                    <?php elseif ($value['so_luong'] <= 0) : ?>
                                                        <span class="badge text-bg-danger">Số lượng đã hết</span>
                                                    <?php else : ?>
                                                        <span class="badge text-bg-success use-voucher" style="cursor: pointer;" data-id-voucher="<?= $value['id_ma_giam_gia'] ?>" data-code-voucher="<?= $value['code'] ?>" data-voucher="<?= $value['giam_gia'] ?>">Sử
                                                            dụng</span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <!-- your-order-wrap end -->
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <!-- ACCORDION START -->
                                    <h5>Phương thức thanh toán</h5>
                                    <div class="payment-content">
                                        <div class="d-flex align-items-center mb-1">
                                            <img src="assets/images/icon/cod.png" alt="" style="width:30px; height:30px; object-fit: cover;">
                                            <label for="shipcod">Thanh toán khi nhận hàng</label>
                                            <input type="radio" id="shipcod" class="mx-2" name="payment" value="shipcod">
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/icon/bank.png" alt="" style="width:30px; height:30px; object-fit: cover;">
                                            <label for="atm">Thẻ ATM nội địa</label>
                                            <input type="radio" id="atm" class="mx-2" name="payment" value="atm">
                                        </div>
                                    </div>
                                    <!-- ACCORDION END -->
                                </div>
                                    <div class="order-button-payment">
                                        <input type="text" value="<?php echo $buyNows['id_chi_tiet_san_pham'] ?>" name="id_chi_tiet_san_pham" hidden>
                                        <input type="submit" value="Đặt hàng" />
                                    </div>
                            </div>
                            <!-- your-order-wrapper start -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-details-wrapper end -->
    </div>
</div>
<!-- main-content-wrap end -->
<?php
    if (isset($_SESSION['login'])) {
        $product_checkout = gio_hang_select_all($_SESSION['login']['id_kh']);
        $sum_checkout = gio_hang_checkout($_SESSION['login']['id_kh']);
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
                     <div class="billing-details-wrap p-4 bg-white rounded shadow-sm">
                         <form action="#">
                             <h3 class="shoping-checkboxt-title mb-4" style="color: #c89979;"><i
                                     class="fas fa-map-marker-alt me-2"></i>Địa chỉ
                                 nhận
                                 hàng</h3>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <p class="single-form-row">
                                         <label>Họ và tên<span class="required">*</span></label>
                                         <input type="text" name="ho_ten" class="form-control"
                                             value="<?php echo (isset($_SESSION['login'])) ? $_SESSION['login']['ho_ten'] : '' ?>">
                                     </p>
                                 </div>
                                 <div class="col-lg-6">
                                     <p class="single-form-row">
                                         <label>Số điện thoại<span class="required">*</span></label>
                                         <input type="text" name="phone" class="form-control"
                                             value="<?php echo (isset($_SESSION['login'])) ? $_SESSION['login']['phone'] : '' ?>">
                                     </p>
                                 </div>
                                 <div class="col-lg-12">
                                     <div class="single-form-row">
                                         <label>Tỉnh thành<span class="required">*</span></label>
                                         <div class="">
                                             <select id="city" class="form-select">
                                                 <option value="" selected>Chọn tỉnh thành</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-12 mb-20">
                                     <div class="single-form-row">
                                         <label>Quận huyện<span class="required">*</span></label>
                                         <div class="">
                                             <select id="district" class="form-select">
                                                 <option value="" selected>Chọn quận huyện</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-12">
                                     <div class="single-form-row">
                                         <label>Phường xã<span class="required">*</span></label>
                                         <div class="">
                                             <select id="ward" class="form-select" style="width: 100;">
                                                 <option value="" selected>Chọn phường xã</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-12">
                                     <p class="single-form-row m-0">
                                         <label>Ghi chú đặt hàng</label>
                                         <textarea
                                             placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: địa chỉ cụ thể, thời gian nhận trong ngày..."
                                             class="checkout-mess form-control" rows="2" cols="5"></textarea>
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
                         <h3 class="shoping-checkboxt-title mb-4" style="color: #c89979;">Đơn hàng của bạn</h3>
                         <!-- your-order-wrap start-->
                         <div class="your-order-wrap rounded shadow-sm p-4">
                             <!-- your-order-table start -->
                             <div class="your-order-table table-responsive">
                                 <table class="table">
                                     <thead>
                                         <tr>
                                             <th class="product-name">Sản phẩm</th>
                                             <th class="product-total">Tổng</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php foreach ($product_checkout as $value) : ?>
                                         <tr class="cart_item">
                                             <td class="product-name">
                                                 <?php echo $value['ten_san_pham'] ?> <strong class="product-quantity">
                                                     ×
                                                     <?php echo $value['so_luong'] ?></strong>
                                             </td>
                                             <td class="product-total">
                                                 <span
                                                     class="amount"><?php echo number_format($value['price']) ?>đ</span>
                                             </td>
                                         </tr>
                                         <?php endforeach; ?>
                                     </tbody>
                                     <tfoot>
                                         <tr class="order-total">
                                             <th class="fw-semibold">Tổng số đơn
                                                 hàng(<?php echo (isset($sum_checkout['tong_sl'])) ? $sum_checkout['tong_sl'] : 0 ?>)
                                             </th>
                                             <td>
                                                 <strong>
                                                     <span
                                                         class="amount"><?php echo (isset($sum_checkout['tong_gia'])) ? number_format($sum_checkout['tong_gia']) : 0 ?>đ</span>
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
                                     <input readonly type="text" placeholder="Mã giảm giá" data-bs-toggle="collapse"
                                         href="#collapseExample" role="button" aria-expanded="false"
                                         aria-controls="collapseExample">
                                     <button type="submit" class="btn button-apply-coupon" name="apply_coupon"
                                         value="Apply coupon">Áp dụng</button>
                                 </p>
                                 <div class="collapse" id="collapseExample">
                                     <div class="card card-body">
                                         <?php foreach ($list_sales as $value) : if ($value['display_gg'] == 0) {
                                                    continue;
                                                } ?>
                                         <div
                                             class="voucher d-flex align-items-center justify-content-between border-bottom py-2">
                                             <div class="d-flex">
                                                 <img src="assets/images/icon/sale.png" alt=""
                                                     style="width: 40px; height: 40px;">
                                                 <div class="info-voucher ms-3">
                                                     <h6 class="mb-1">Giảm <?= $value['giam_gia'] ?>%</h6>
                                                     <span class="text-black-50">Số lượng còn:<?= $value['so_luong'] ?>
                                                         |
                                                         HSD: <?= $value['ngay_het_han'] ?></span>
                                                 </div>
                                             </div>
                                             <?php if ($value['ngay_het_han'] < date('Y-m-d')) : ?>
                                             <span class="badge text-bg-danger">Hết hạn</span>
                                             <?php elseif ($value['so_luong'] <= 0) : ?>
                                             <span class="badge text-bg-danger">Số lượng đã hết</span>
                                             <?php else : ?>
                                             <span class="badge text-bg-success use-voucher" style="cursor: pointer;"
                                                 data-id-voucher="<?= $value['id_ma_giam_gia'] ?>"
                                                 data-code-voucher="<?= $value['code'] ?>"
                                                 data-voucher="<?= $value['giam_gia'] ?>">Sử
                                                 dụng</span>
                                             <?php endif; ?>
                                         </div>
                                         <?php endforeach; ?>
                                     </div>
                                 </div>
                             </div>
                             <?php endif ?>
                             <!-- your-order-wrap end -->
                             <div class="payment-method mt-4">
                                 <div class="payment-accordion">
                                     <!-- ACCORDION START -->
                                     <h5 class="mb-3 fw-semibold">Phương thức thanh toán</h5>
                                     <div class="payment-content p-3 bg-light rounded mb-4">
                                         <div class="form-check mb-3 d-flex align-items-center">
                                             <img src="assets/images/icon/cod.png" alt=""
                                                 style="width:30px; height:30px; object-fit: cover; padding-left: 21px;">
                                             <label for="shipcod" class="form-check-label ms-2">Thanh toán khi nhận hàng</label>
                                             <input type="radio" id="shipcod" class="form-check-input ms-2" name="payment"
                                                 value="shipcod">
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
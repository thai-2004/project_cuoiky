 <?php
    if (!isset($_SESSION)) {
        session_start();
        var_dump($_SESSION);
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
                     <li class="breadcrumb-item active">Hoàn thành thanh toán</li>
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
                 <div class="col-lg-6 col-md-6 mx-auto">
                     <!-- your-order-wrapper start -->
                     <div class=" p-5">
                         <!-- your-order-wrap start-->
                         <div class=" border rounded px-5 pb-3">
                             <div class="d-flex justify-content-center">
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="96px" height="96px">
                                     <path fill="#c8e6c9" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z" />
                                     <path fill="#4caf50" d="M34.586,14.586l-13.57,13.586l-5.602-5.586l-2.828,2.828l8.434,8.414l16.395-16.414L34.586,14.586z" />
                                 </svg>
                             </div>
                             <h5 class="text-success text-center fw-semibold">Cảm ơn bạn. Đơn hàng của bạn đã nhận.</h5>
                             <ul class="fw-semibold">
                                 <li>Mã đơn hàng: <span class="fw-light"><?php echo $_SESSION['order']['id_don_hang'] ?></span></li>
                                 <li>Họ tên: <span class="fw-light"><?php echo $_SESSION['order']['ho_ten'] ?></span>
                                 </li>
                                 <li>Số điện thoại: <span class="fw-light"><?php echo $_SESSION['order']['phone'] ?></span></li>
                                 <li>Địa chỉ giao: <span class="fw-light"><?php echo $_SESSION['order']['dia_chi_giao'] ?></span>
                                 </li>
                                 <li>Ngày: <span class="fw-light"><?php echo $_SESSION['order']['date'] ?></span></li>
                                 <li>Tổng cộng: <span class="fw-light "></span><?php echo number_format($_SESSION['order']['total_price']) ?>đ</span>
                                 </li>
                                 <li>Phương thức thanh toán: <span class="fw-light"><?php echo $_SESSION['order']['payment_method']  ?></span>
                                 </li>
                             </ul>
                             <div class="row mt-3">
                                 <?php if (isset($_SESSION['login'])) : ?>
                                     <a href="?act=detail-history-order&id=<?php echo $_SESSION['order']['id_don_hang'] ?>" class="btn btn-outline-success px-2 py-1 justify-content-center">Xem đơn
                                         hàng</a>
                                 <?php endif ?>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- checkout-details-wrapper end -->
     </div>
 </div>
 <!-- main-content-wrap end -->
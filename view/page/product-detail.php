<?php
if (isset($_GET['id']) && $_GET['id']) {
    $detail_product = san_pham_select_by_id($_GET['id']);
    $cout_feedback = danh_gia_count_by_id($_GET['id']);
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
                    <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->
<!-- main-content-wrap start -->
<div class="main-content-wrap shop-page section-ptb">
    <div class="container">
        <form action="#" method="post">
            <div class="row product-details-inner">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-large-slider">
                        <div class="pro-large-img">
                            <img src="assets/images/product/<?php echo $detail_product['hinh_anh'] ?>" alt="product-details" />
                        </div>
                    </div>
                    <!--// Product Details Left -->
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content">
                        <div class="product-info">
                            <h3><?php echo $detail_product['ten_san_pham'] ?></h3>
                            <div class="product-rating d-flex">
                                <p class="border-end pe-2">Số lượng: <?php echo $detail_product['total_quantity'] ?></p>
                                <p class="border-end px-2">Lượt xem: <?php echo $detail_product['luot_xem'] ?></p>
                                <ul class="d-flex ps-2">
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                </ul>
                                <a href="#reviews">(<span class="count"><?= $cout_feedback ?></span> đánh giá)</a>
                            </div>
                            <div class="price-box">
                                <span>Giá: </span><span class="new-price" id="price-detail"><?php echo number_format($detail_product['price']) ?>đ</span>
                            </div>
                            <div class="product-description">
                                <p><?php echo $detail_product['mo_ta'] ?></p>
                            </div>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <?php foreach ($list_size as $value) : ?>
                                        <label for="<?php echo $value['id_size'] ?>" class="" data-bs-toggle="tooltip" data-bs-title="<?php echo $value['kich_thuoc'] ?>"><?php echo $value['size'] ?>
                                            <input type="radio" id="<?php echo $value['id_size'] ?>" name="id_size" value="<?php echo $value['id_size'] ?>">
                                        </label>
                                    <?php endforeach ?>
                                </div>
                                <div class="product__details__option__color">
                                    <span>Màu:</span>
                                    <?php foreach ($list_color as $value) : ?>
                                        <label class="c-<?php echo $value['id_mau'] ?>" for="sp-<?php echo $value['id_mau'] ?>">
                                            <input type="radio" id="sp-<?php echo $value['id_mau'] ?>" name="id_mau" value="<?php echo $value['id_mau'] ?>">
                                        </label>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="single-add-to-cart d-flex flex-wrap align-items-center">
                                <div class="quantity me-3 mb-3 mb-md-0">
                                    <div class="cart-plus-minus">
                                        <input type="text" class="input-text" name="quantity" value="1" title="Qty">
                                    </div>
                                </div>
                                <button class="byNow add-to-cart me-3 mb-3 mb-md-0" type="submit">Mua ngay</button>
                                <div class="addCart add-to-cart mx-2">
                                    <i class="fas fa-cart-plus me-2"></i>
                                    Thêm giỏ hàng
                                </div>
                            </div>
                            <ul class="stock-cont my-4">
                                <li class="product-sku">Mã hàng:
                                    <span><?php echo $detail_product['id_san_pham'] ?></span>
                                </li>
                                <li class="product-stock-status">Thể loại: <a href=""><?php echo $detail_product['ten_danh_muc'] ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        include_once 'binh-luan_danh-gia.php';
        include_once 'san-pham-tuong-tu.php';
        ?>
    </div>
</div>
<!-- main-content-wrap end -->
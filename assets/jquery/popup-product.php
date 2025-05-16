<?php
include_once '../dao/san-pham.php';
include_once '../dao/size.php';
include_once '../dao/mau.php';
include_once '../dao/danh-gia.php';
$list_color = mau_select();
$list_size = size_select();
if (isset($_POST['id_san_pham'])) {
    $popup_product = san_pham_select_by_id($_POST['id_san_pham']);
    $cout_feedback = danh_gia_count_by_id($_POST['id_san_pham']);
}
?>
<div class="modal-body">
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-inner-area">
        <div class="row gx-3 product-details-inner">
            <div class="col-lg-5 col-md-6 col-sm-6">
                <!-- Product Details Left -->
                <div class="product-large-slider">
                    <div class="pro-large-img">
                        <img src="assets/images/product/<?php echo $popup_product['hinh_anh'] ?>" alt="product-details" />
                    </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6 col-sm-6">
                <div class="product-details-view-content">
                    <div class="product-info">
                        <h3><?php echo $popup_product['ten_san_pham'] ?></h3>
                        <div class="product-rating d-flex">
                            <p class="border-end pe-2">Số lượng: <?php echo $popup_product['total_quantity'] ?></p>
                            <p class="border-end px-2">Lượt xem: <?php echo $popup_product['luot_xem'] ?></p>
                            <ul class="d-flex ps-2">
                                <li>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                </li>
                            </ul>
                            <a href="#reviews">(<span class="count"><?= $cout_feedback ?></span> đánh giá)</a>
                        </div>
                        <div class="price-box">
                            <span class="new-price">Giá: <?php echo number_format($popup_product['price']) ?></span>
                        </div>
                        <p>
                            <?php echo $popup_product['mo_ta'] ?>
                        </p>
                        <div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                <?php foreach ($list_size as $value) : ?>
                                    <label for="<?php echo $value['id_size'] ?>" data-bs-toggle="tooltip" data-bs-title="<?php echo $value['kich_thuoc'] ?>"><?php echo $value['size'] ?>
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
                        <div class="single-add-to-cart">
                            <form action="#" class="cart-quantity d-flex">
                                <div class="quantity">
                                    <div class="cart-plus-minus">
                                        <input type="text" class="input-text" name="quantity" value="1" title="Qty">
                                    </div>
                                </div>
                                <button class="byNow add-to-cart" type="submit">Mua ngay</button>
                                <div class="addCart add-to-cart mx-2"><i class="fas fa-cart-plus"></i>
                                    Thêm giỏ hàng</div>
                            </form>
                        </div>
                        <ul class="stock-cont my-2">
                            <li class="product-sku">Mã hàng:
                                <span><?php echo $popup_product['id_san_pham'] ?></span>
                            </li>
                            <li class="product-stock-status">Thể loại: <a href=""><?php echo $popup_product['ten_danh_muc'] ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
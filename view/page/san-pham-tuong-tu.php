<?php
if (isset($_GET['category'])) {
    $product_tt = san_pham_tuong_tu($_GET['category'], $_GET['id']);
}
?>
<div class="related-product-area section-pt">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">
                <h3>Sản phẩm liên quan</h3>
            </div>
        </div>
    </div>
    <div class="row product-active-row-4">
        <?php foreach ($product_tt as $value) : if ($value['display_san_pham'] == 0) {
                            continue;
                        } ?>
        <div class="col-lg-12">
            <!-- single-product-area start -->
            <div class="single-product-area mt-30">
                <div class="product-thumb">
                    <a
                        href="?act=product-details&id=<?php echo  $value['id_san_pham'] ?>&category=<?php echo  $value['id_danh_muc'] ?>">
                        <img class="primary-image" src="assets/images/product/<?php echo $value['hinh_anh'] ?>"
                            alt="" />
                    </a>
                    <!-- <div class="label-product label_new">Mới</div> -->
                    <div class="action-links">
                        <a href="<?php echo $value['id_san_pham'] ?>" class="quick-view" title="Thêm giỏ hàng"
                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i
                                class="icon-basket-loaded"></i></a>
                    </div>

                </div>
                <div class="product-caption">
                    <h4 class="product-name">
                        <a
                            href="?act=product-details&id=<?php echo  $value['id_san_pham'] ?>&category=<?php echo  $value['id_danh_muc'] ?>"><?php echo  $value['ten_san_pham'] ?></a>
                    </h4>
                    <div class="price-box">
                        <span class="new-price"><?php echo number_format($value['price']) ?>đ</span>

                    </div>
                </div>
            </div>
            <!-- single-product-area end -->
        </div>
        <?php endforeach ?>
    </div>
</div>
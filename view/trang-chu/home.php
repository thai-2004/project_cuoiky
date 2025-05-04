<?php
include_once 'slide.php';
include_once 'banner-best-deal.php';
$product_new = san_pham_select_product_new();
$product_seller = san_pham_select_best_seller(); ?>
<!-- Product Area Start -->
<div class="product-area section-pb section-pt-30">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <ul class="nav product-tab-menu" role="tablist">
                    <li class="product-tab-item nav-item active">
                        <a class="product-tab__link active" id="nav-featured-tab" data-bs-toggle="tab"
                            href="#nav-featured" role="tab" aria-selected="true">Sản phẩm mới</a>
                    </li>

                    <li class="product-tab__item nav-item">
                        <a class="product-tab__link" id="nav-bestseller-tab" data-bs-toggle="tab" href="#nav-bestseller"
                            role="tab" aria-selected="false">Sản phẩm bán chạy</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-content product-tab__content" id="product-tabContent">
            <div class="tab-pane fade show active" id="nav-featured" role="tabpanel">
                <div class="product-carousel-group">
                    <div class="row product-active-row-4">
                        <?php foreach ($product_new as $value) : if ($value['display_san_pham'] == 0) {
                            continue;
                        } ?>
                        <div class="col-lg-12">
                            <!-- single-product-area start -->
                            <div class="single-product-area mt-30">
                                <div class="product-thumb">
                                    <a
                                        href="?act=product-details&id=<?php echo  $value['id_san_pham'] ?>&category=<?php echo  $value['id_danh_muc'] ?>">
                                        <img class="primary-image"
                                            src="assets/images/product/<?php echo $value['hinh_anh'] ?>" alt="" />
                                    </a>
                                    <!-- <div class="label-product label_new">Mới</div> -->
                                    <div class="action-links">
                                        <a href="<?php echo $value['id_san_pham'] ?>" class="quick-view"
                                            title="Thêm giỏ hàng" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter"><i class="icon-basket-loaded"></i></a>
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
            </div>

            <div class="tab-pane fade" id="nav-bestseller" role="tabpanel">
                <div class="product-carousel-group">
                    <div class="row product-active-row-4">
                        <?php foreach ($product_seller as $value) : if ($value['display_san_pham'] == 0) {
                            continue;
                        } ?>
                        <div class="col-lg-12">
                            <!-- single-product-area start -->
                            <div class="single-product-area mt-30">
                                <div class="product-thumb">
                                    <a
                                        href="?act=product-details&id=<?php echo  $value['id_san_pham'] ?>&category=<?php echo  $value['id_danh_muc'] ?>">
                                        <img class="primary-image"
                                            src="assets/images/product/<?php echo $value['hinh_anh'] ?>" alt="" />
                                    </a>
                                    <!-- <div class="label-product label_new">Mới</div> -->
                                    <div class="action-links">
                                        <a href="<?php echo $value['id_san_pham'] ?>" class="quick-view"
                                            title="Thêm giỏ hàng" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter"><i class="icon-basket-loaded"></i></a>
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
            </div>
        </div>
    </div>
</div>
<!-- Product Area End -->

<!-- Blog Area Start -->
<div class="letast-blog-area section-pb">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h3 class="mb-3">Bài viết mới nhất</h3>
                <p class="text-muted mb-4">Khám phá tin tức và cập nhật mới nhất về đồng hồ</p>
            </div>
        </div>
        <div class="row" style="height: 400px;">
            <div class="col-lg-4">
                <div class="singel-latest-blog">
                    <div class="aritcles-content">
                        <div class="author-name">
                            đăng bởi: <a href="#"> Nguyễn Minh Thái</a> - 30 Oct 2024
                        </div>
                        <h4>
                            <a href="#" class="articles-name">
                                Ruiz Watch là một trong những trang web hay nhất
                                đã truy cập các trang web xem
                            </a>
                        </h4>
                    </div>
                    <div class="articles-image">
                        <a href="#">
                            <img src="assets/images/blog/blog-01.jpg" alt="" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="singel-latest-blog">
                    <div class="aritcles-content">
                        <div class="author-name">
                            đăng bởi: <a href="#"> Nguyễn Minh Thái</a> - 20 Oct 2024
                        </div>
                        <h4>
                            <a href="#" class="articles-name">Đánh giá Ruiz Watch và đồng hồ phổ biến
                                nhất
                                & đồng hồ
                                blog nghiêm túc
                            </a>
                        </h4>
                    </div>
                    <div class="articles-image">
                        <a href="#">
                            <img src="assets/images/blog/blog-02.jpg" alt="" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="singel-latest-blog">
                    <div class="aritcles-content">
                        <div class="author-name">
                            đăng bởi: <a href="#"> Nguyễn Minh Thái</a> - 13 Oct 2024
                        </div>
                        <a href="#" class="articles-name">Kết nối với thế giới: Giới thiệu
                            G-Sốc
                            MTG-B1000-1A</a>
                    </div>
                    <div class="articles-image">
                        <a href="#">
                            <img src="assets/images/blog/blog-03.jpg" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Area End -->
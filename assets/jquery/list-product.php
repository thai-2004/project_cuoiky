<?php
include_once '../dao/san-pham.php';
include_once '../dao/loai.php';
include_once '../dao/mau.php';
$list_color = mau_select(); // lấy ra các màu sản phẩm
$list_danhMuc = loai_select_all(); //lấy ra các danh mục sản phẩm
$min_max_price = san_pham_min_max_price(); //lấy ra giá min và max sản phẩm
$sum_product = san_pham_count(); //lấy ra số lượng sản phẩm
$cout_page = ceil($sum_product / 9); //tính số trang
$id_danh_muc = isset($_POST['id_danh_muc']) ? $_POST['id_danh_muc'] : '21,22,23'; // id danh mục sản phẩm
$page = isset($_POST['page']) ? $_POST['page'] : 0; // xác định trang
$start = $page * 9; // limit bắt đầu
if (isset($_POST['filter_price'])) {
    $list_products = san_pham_filter_price($id_danh_muc, $_POST['price_min'], $_POST['price_max'], $start, 9);
} elseif (isset($_POST['filter_color'])) {
    $list_products = san_pham_filter_color($id_danh_muc, $_POST['id_color'], $start, 9);
} elseif (isset($_POST['keywork'])) {
    $list_products =  result_search($_POST['keywork'],  $start, 9);
} elseif (isset($_POST['short_act'])) {
    switch ($_POST['short_act']) {
        case 'name-asc':
            $list_products = san_pham_short_name($id_danh_muc, 'ten_san_pham', $start, 9);
            break;
        case 'name-desc':
            $list_products = san_pham_short($id_danh_muc, 'ten_san_pham', $start, 9);
            break;
        case 'price':
            $list_products = san_pham_short($id_danh_muc, 'price', $start, 9);
            break;
        case 'view':
            $list_products = san_pham_short($id_danh_muc, 'luot_xem', $start, 9);
            break;
        default:
            $list_products = san_pham_short($id_danh_muc, 'id_san_pham', $start, 9);
            break;
    }
} else
    $list_products = san_pham_select_top_colum_by_loai($start, 9, 'id_san_pham', $id_danh_muc);
?>
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh mục sản phẩm</li>
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
        <div class="row">
            <div class="col-lg-3 order-lg-1 order-2">
                <!-- shop-sidebar-wrap start -->
                <div class="shop-sidebar-wrap">
                    <div class="shop-box-area">

                        <!--sidebar-categores-box start  -->
                        <div class="sidebar-categores-box shop-sidebar mb-30">
                            <h4 class="title">Danh mục sản phẩm</h4>
                            <!-- category-sub-menu start -->
                            <div class="category-sub-menu">
                                <ul class="">
                                    <?php foreach ($list_danhMuc as $value) : if ($value['display_danh_muc'] == 0) {
                                            continue;
                                        } ?>
                                    <li class="has-sub"><a href="#"
                                            data-id-category="<?php echo $value['id_danh_muc'] ?>"><?php echo $value['ten_danh_muc'] ?></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <!-- category-sub-menu end -->
                        </div>
                        <!--sidebar-categores-box end  -->

                        <!-- shop-sidebar start -->
                        <div class="shop-sidebar mb-30">
                            <h4 class="title">Lọc theo giá</h4>
                            <!-- filter-price-content start -->
                            <div class="filter-price-content">
                                <form action="#" method="post">
                                    <div id="price-slider" class="price-slider"></div>
                                    <div class="filter-price-wapper">
                                        <div class="slide-input-range-price ">
                                            <label for="customRange1" class="form-label">Giá thấp</label>
                                            <input type="range" name="price_min" class="form-range" id="customRange1"
                                                min="<?php echo $min_max_price['price_min'] ?>"
                                                max="<?php echo $min_max_price['price_max'] ?>">
                                            <label for="customRange2" class="form-label">Giá cao</label>
                                            <input type="range" name="price_max" class="form-range" id="customRange2"
                                                min="<?php echo $min_max_price['price_min'] ?>"
                                                max="<?php echo $min_max_price['price_max'] ?>">
                                        </div>
                                        <a class="add-to-cart-button btn-filter-price" href="#">
                                            <span>
                                                LỌC</span>
                                        </a>
                                        <div class="filter-price-cont">

                                            <span>Price:</span>
                                            <div class="input-type">
                                                <p id="min-price"> </p>
                                            </div>
                                            <span>—</span>
                                            <div class="input-type">
                                                <p id="max-price"> </p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- filter-price-content end -->
                        </div>
                        <!-- shop-sidebar end -->

                        <!-- shop-sidebar start -->
                        <div class="shop-sidebar mb-30">
                            <h4 class="title">
                                Lọc theo màu</h4>

                            <ul class="sidebar-tag filter-color">
                                <?php foreach ($list_color as $value) : ?>
                                <li><a href="<?= $value['id_mau'] ?>"><?= $value['mau'] ?></a></li>
                                <?php endforeach ?>
                            </ul>

                        </div>
                        <!-- shop-sidebar end -->



                    </div>
                </div>
                <!-- shop-sidebar-wrap end -->
            </div>
            <div class="col-lg-9 order-lg-2 order-1">

                <!-- shop-product-wrapper start -->
                <div class="shop-product-wrapper">
                    <div class="row align-itmes-center">
                        <div class="col">
                            <!-- shop-top-bar start -->
                            <div class="shop-top-bar">
                                <!-- product-view-mode start -->

                                <div class="product-mode">
                                    <!--shop-item-filter-list-->
                                    <ul class="nav shop-item-filter-list" role="tablist">
                                        <li class="active"><a class="active grid-view" data-bs-toggle="tab"
                                                href="#grid"><i class="fa fa-th"></i></a></li>
                                    </ul>
                                    <!-- shop-item-filter-list end -->
                                </div>
                                <!-- product-view-mode end -->
                                <!-- product-short start -->
                                <div class="product-short">
                                    <p>Sắp xếp theo :</p>
                                    <select class="nice-select" name="sortby">
                                        <option value="">--Chọn--</option>
                                        <option value="name-asc">Tên(A - Z)</option>
                                        <option value="name-desc">Tên(Z - A)</option>
                                        <option value="price">Giá(Cao > Thấp)</option>
                                        <option value="view">Lượt xem</option>
                                    </select>
                                </div>
                                <!-- product-short end -->
                            </div>
                            <!-- shop-top-bar end -->
                        </div>
                    </div>

                    <!-- shop-products-wrap start -->
                    <div class="shop-products-wrap">
                        <div class="tab-content">
                            <div class="tab-pane active" id="grid">
                                <div class="shop-product-wrap">
                                    <div class="row">
                                        <?php foreach ($list_products as $value) : if ($value['display_san_pham'] == 0) {
                            continue;
                        } ?>
                                        <div class="col-lg-4 col-md-6">
                                            <!-- single-product-area start -->
                                            <div class="single-product-area mt-30">
                                                <div class="product-thumb">
                                                    <a
                                                        href="?act=product-details&id=<?php echo  $value['id_san_pham'] ?>&category=<?php echo  $value['id_danh_muc'] ?>">
                                                        <img class="primary-image"
                                                            src="assets/images/product/<?php echo $value['hinh_anh'] ?>"
                                                            alt="" />
                                                    </a>
                                                    <!-- <div class="label-product label_new">Mới</div> -->
                                                    <div class="action-links">
                                                        <a href="<?php echo $value['id_san_pham'] ?>" class="quick-view"
                                                            title="Thêm giỏ hàng" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalCenter"><i
                                                                class="icon-basket-loaded"></i></a>
                                                    </div>

                                                </div>
                                                <div class="product-caption">
                                                    <h4 class="product-name">
                                                        <a
                                                            href="?act=product-details&id=<?php echo  $value['id_san_pham'] ?>&category=<?php echo  $value['id_danh_muc'] ?>"><?php echo  $value['ten_san_pham'] ?></a>
                                                    </h4>
                                                    <div class="price-box">
                                                        <span
                                                            class="new-price"><?php echo number_format($value['price']) ?>đ</span>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-area end -->
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop-products-wrap end -->

                    <!-- paginatoin-area start -->
                    <div class="paginatoin-area">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <ul class="pagination-box">
                                    <li class="active" data-page="1"><a href="1">1</a></li>
                                    <?php for ($i = 2; $i <= $cout_page; $i++) : ?>
                                    <li data-page="<?php echo $i ?>"><a href="<?php echo $i ?>"><?php echo $i ?></a>
                                    </li>
                                    <?php endfor ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- paginatoin-area end -->
                </div>
                <!-- shop-product-wrapper end -->
            </div>
        </div>
    </div>
</div>
<!-- main-content-wrap end -->
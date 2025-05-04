<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Cửa hàng đồng hồ - Ruiz</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css" />
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/simple-line-icons.css" />

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins/animation.css" />
    <link rel="stylesheet" href="assets/css/plugins/slick.css" />
    <link rel="stylesheet" href="assets/css/plugins/animation.css" />
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css" />
    <link rel="stylesheet" href="assets/css/plugins/fancy-box.css" />
    <link rel="stylesheet" href="assets/css/plugins/jqueryui.min.css" />

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from avobe) -->
    <!--
    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    -->

    <!-- Main Style CSS (Please use minify version for better website load performance) -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <!--<link rel="stylesheet" href="assets/css/style.min.css">-->
    <!-- Custom CSS for improved UI -->
    <link rel="stylesheet" href="assets/css/custom.css" />
    <!-- Mobile Responsive CSS -->
    <link rel="stylesheet" href="assets/css/mobile.css" />
</head>

<body>

    <div class="main-wrapper">
        <!--  Header Start -->
        <header class="header">
            <!-- haeader Mid Start -->
            <div class="haeader-mid-area bg-gren border-bm-1 d-none d-lg-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-4 col-5">
                            <div class="logo-area">
                                <a href="index.php"><img src="assets/images/logo/logo.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="search-box-wrapper">
                                <div class="search-box-inner-wrap">
                                    <div class="search-box-inner">
                                        <div class="search-field-wrap">
                                            <input id="tags" autocomplete="off" type="text"
                                                class="search-field rounded-start" placeholder="Tìm kiếm sản phẩm..." />
                                            <div class="search-btn">
                                                <button type="button"><i class="icon-magnifier"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="autocomplete">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="right-blok-box text-white d-flex align-items-center">
                                <div class="shopping-cart-wrap">
                                    <a href="?act=cart"><i class="icon-basket-loaded"></i><span
                                            class="cart-total">0</span></a>
                                </div>
                                <?php if (!isset($_SESSION['login'])) : ?>
                                <div class="px-3">
                                    <a href="?act=login"><i class="fa fa-user-o" aria-hidden="true"></i></a>
                                </div>
                                <?php else : ?>
                                <!-- tài khoản -->

                                <div class="px-2 pb-2 position-relative user-account" style="cursor: pointer;">
                                    <img src="assets/images/avatar/<?php $login = user_select_by_id($_SESSION['login']['id_kh']);
                                                                        echo  $login['hinh_anh'] ?>" alt=""
                                        width="30px" height="30px" style="border-radius: 50%" />
                                    <svg viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor"
                                        class="x1lliihq x1k90msu x2h7rmj x1qfuztq x198g3q0 x1kpxq89 xsmyaan position-absolute icon-down-user">
                                        <g fill-rule="evenodd" transform="translate(-448 -544)">
                                            <path fill-rule="nonzero"
                                                d="M452.707 549.293a1 1 0 0 0-1.414 1.414l4 4a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L456 552.586l-3.293-3.293z">
                                            </path>
                                        </g>
                                    </svg>
                                    <ul class="menu-user-hover ">
                                        <input type="text" hidden name="id_kh"
                                            value="<?php echo $_SESSION['login']['id_kh'] ?>">
                                        <?php if ($_SESSION['login']['id_roles'] == 2 || $_SESSION['login']['id_roles'] == 3) : ?>
                                        <li class="dropdown-item "><a class="fs-6" href="admin/index.php">Vào trang quản
                                                trị</a></li>
                                        <?php endif ?>
                                        <li class="dropdown-item "><a class="fs-6" href="?act=setting-user">Quản lý tài
                                                khoản</a></li>
                                        <li class="dropdown-item "><a class="fs-6" href="?act=history-carts">Xem lịch sử
                                                mua hàng</a>
                                        </li>
                                        <li class="dropdown-item "><a class="fs-6" href="?act=logout">Đăng xuất</a></li>
                                    </ul>
                                </div>


                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- haeader Mid End -->

            <!-- haeader bottom Start -->
            <div class="haeader-bottom-area bg-gren header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 d-none d-lg-block">
                            <div class="main-menu-area white_text">
                                <!--  Start Mainmenu Nav-->
                                <nav class="main-navigation text-center">
                                    <ul>
                                        <li class="active">
                                            <a href="index.php">Trang chủ </a>
                                        </li>

                                        <li>
                                            <a class="btn-list-product" href="?act=list-shop"
                                                data-id-category="<?php echo $id_danh_muc_all ?>">Danh mục
                                                <i class="fa fa-angle-down"></i></a>
                                            <ul class="mega-menu">
                                                <li>
                                                    <a class="btn-list-product" href="?act=list-shop"
                                                        data-id-category="<?php echo $id_danh_muc_all ?>">Đồng hồ</a>
                                                    <ul>
                                                        <?php foreach ($list_danhMuc as $value) : if ($value['display_danh_muc'] == 0) {
                                                                continue;
                                                            } ?>
                                                        <li><a data-id-category="<?php echo $value['id_danh_muc'] ?>"
                                                                class="btn-list-product"
                                                                href="<?php echo $value['id_danh_muc'] ?>"><?php echo $value['ten_danh_muc'] ?></a>
                                                        </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="?act=blog-details">Tin tức </a>
                                        </li>


                                        <li><a href="?act=about-us">Về chúng tôi</a></li>
                                        <li><a href="?act=contact-us">Liên hệ</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="col-5 col-md-6 d-block d-lg-none">
                            <div class="logo">
                                <a href="index.php"><img src="assets/images/logo/logo.png" alt="" /></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-7 d-block d-lg-none">
                            <div class="right-blok-box text-white d-flex">
                                <div class="shopping-cart-wrap">
                                    <a href="?act=cart"><i class="icon-basket-loaded"></i><span
                                            class="cart-total">0</span></a>
                                </div>

                                <div class="mobile-menu-btn d-block d-lg-none">
                                    <div class="off-canvas-btn">
                                        <a href="#"><img src="assets/images/icon/bg-menu.png" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- haeader bottom End -->

            <!-- off-canvas menu start -->
            <aside class="off-canvas-wrapper">
                <div class="off-canvas-overlay"></div>
                <div class="off-canvas-inner-content">
                    <div class="btn-close-off-canvas">
                        <i class="fa fa-times"></i>
                    </div>

                    <div class="off-canvas-inner">
                        <div class="search-box-offcanvas">
                            <form>
                                <input type="text" placeholder="Search product..." />
                                <button class="search-btn">
                                    <i class="icon-magnifier"></i>
                                </button>
                            </form>
                        </div>

                        <!-- mobile menu start -->
                        <div class="mobile-navigation">
                            <!-- mobile menu navigation start -->
                            <nav>
                                <ul class="mobile-menu">
                                    <li class="menu-item-has-children">
                                        <a href="index.php">Trang chủ</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="shop.html">Danh mục</a>
                                        <ul class="megamenu dropdown">
                                            <li class="mega-title has-children">
                                                <a href="#">Đồng hồ</a>
                                                <ul class="dropdown">
                                                    <li>1</li>
                                                    <li>2</li>
                                                    <li>3</li>
                                                    <li>4</li>
                                                    <li>5</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="blog-details.html">Tin tức</a>
                                    </li>

                                    <li><a href="about-us.html">Về chúng tôi</a></li>
                                    <li><a href="contact-us.html">Liên hệ</a></li>
                                </ul>
                            </nav>
                            <!-- mobile menu navigation end -->
                        </div>
                        <!-- mobile menu end -->
                        <!-- offcanvas widget area start -->
                        <div class="offcanvas-widget-area">
                            <div class="top-info-wrap text-left text-black">
                                <h5>Tài khoản của tôi</h5>
                                <ul class="offcanvas-account-container">
                                    <li><a href="my-account.html">Tài khoản của tôi</a></li>
                                    <li><a href="cart.html">Giỏ hàng</a></li>
                                    <li><a href="wishlist.html">Danh sách yêu thích</a></li>
                                    <li><a href="checkout.html">Thủ tục thanh toán</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- offcanvas widget area end -->
                    </div>
                </div>
            </aside>
            <!-- off-canvas menu end -->
        </header>
        <!--  Header End -->

        <!-- Thêm menu mobile -->
        <div class="mobile-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="mobile-menu">
                            <nav id="mobile-menu-active">
                                <ul class="menu-overflow">
                                    <li><a href="index.php">Trang chủ</a></li>
                                    <li>
                                        <a href="#">Danh mục</a>
                                        <ul>
                                            <?php foreach ($list_danhMuc as $value) : if ($value['display_danh_muc'] == 0) {
                                                    continue;
                                                } ?>
                                            <li><a href="?act=list-shop&id_danh_muc=<?php echo $value['id_danh_muc'] ?>"><?php echo $value['ten_danh_muc'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li><a href="?act=blog-details">Tin tức</a></li>
                                    <li><a href="?act=about-us">Về chúng tôi</a></li>
                                    <li><a href="?act=contact-us">Liên hệ</a></li>
                                    <?php if (isset($_SESSION['login'])) : ?>
                                    <li>
                                        <a href="#">Tài khoản</a>
                                        <ul>
                                            <?php if ($_SESSION['login']['id_roles'] == 2 || $_SESSION['login']['id_roles'] == 3) : ?>
                                            <li><a href="admin/index.php">Vào trang quản trị</a></li>
                                            <?php endif ?>
                                            <li><a href="?act=setting-user">Quản lý tài khoản</a></li>
                                            <li><a href="?act=history-carts">Xem lịch sử mua hàng</a></li>
                                            <li><a href="?act=logout">Đăng xuất</a></li>
                                        </ul>
                                    </li>
                                    <?php else : ?>
                                    <li><a href="?act=login">Đăng nhập</a></li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS
	============================================ -->

    <!-- jQuery -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <!-- Plugins JS -->
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/nice-select.min.js"></script>
    <script src="assets/js/plugins/fancy-box.min.js"></script>
    <script src="assets/js/plugins/jqueryui.min.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
</body>

</html>
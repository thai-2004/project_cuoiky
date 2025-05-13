        <!-- breadcrumb-area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list">
                            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Xem lịch sử mua hàng</li>
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
                <div class="row">
                    <?php include_once 'sidebar-account.php' ?>
                    <div class="col-8">
                        <nav class="flex-grow ">
                            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                <button class="nav-link flex-fill text-dark active px-1" value="1,2,4,5,6,7">Tất
                                    cả</button>
                                <button class="nav-link flex-fill text-dark px-1" type="button" value="1">Chờ xác
                                    nhận</button>
                                <button class="nav-link flex-fill text-dark px-1" type="button" value="2">Chờ lấy
                                    hàng</button>
                                <button class="nav-link flex-fill text-dark px-1" type="button" value="4">Chờ giao
                                    hàng</button>
                                <button class="nav-link flex-fill text-dark px-1" type="button" value="5">Hoàn
                                    thành</button>
                                <button class="nav-link flex-fill text-dark px-1" value="6">Đã huỷ</button>

                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- main-content-wrap end -->
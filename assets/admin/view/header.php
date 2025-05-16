<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Quản lý Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Quản lý Website bán đồng hồ" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar ">
            <div class="navbar-header ">

                <div class="float-right " style="width: 100%;">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect"
                                id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="mdi mdi-bell"></i>
                                <span class="badge badge-danger badge-pill"
                                    style="top: 21px; right: 10px; border-radius: 50%; width: 6px; height: 12px;">
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0">Thông báo</h6>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px">
                                    <?php $message = thong_ke_thong_bao(); ?>

                                    <a href="#" class="text-reset notification-item">
                                        <div class="media">
                                            <img src="../assets/images/avatar/<?php echo $message[1]['hinh_anh'] ?>"
                                                class="mr-3 rounded-circle avatar-xs" alt="user-pic" />
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1"><?php echo $message[0]['ho_ten'] ?></h6>
                                                <p class="font-size-13 mb-1">
                                                    Vừa đặt đơn hàng cần chờ bạn xác nhận
                                                </p>
                                                <p class="font-size-12 mb-0 text-muted">
                                                    <i class="mdi mdi-clock-outline"></i> Vài phút trước
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="text-reset notification-item">
                                        <div class="media">
                                            <img src="../assets/images/avatar/<?php echo $message[0]['hinh_anh'] ?>"
                                                class="mr-3 rounded-circle avatar-xs" alt="user-pic" />
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1"><?php echo $message[0]['ho_ten'] ?></h6>
                                                <p class="font-size-13 mb-1">
                                                    Bạn có thêm 1 khách hàng vừa đăng ký tài khoản
                                                </p>
                                                <p class="font-size-12 mb-0 text-muted">
                                                    <i class="mdi mdi-clock-outline"></i> Vài phút trước
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top">
                                    <!-- <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-down-circle mr-1"></i> Tải thêm..
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
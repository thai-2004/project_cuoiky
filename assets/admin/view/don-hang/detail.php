<?php $detail_don_hang = detail_don_hang_select_all($_GET['id']) ?>
<div class="main-content">
    <div class="page-content pt-4">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Quản lý đơn hàng</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Quản lý đơn hàng</a>
                                </li>
                                <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="?act=delete-binhluan" method="post">
                            <div class="card-body">
                                <h4 class="card-title">Chi tiết đơn hàng: <span class="text-primary"><?php echo $_GET['id'] ?></span>
                                    <a href="?act=list-order" class="btn btn-success float-right " style="transform: translateY(-30%);">Danh sách đơn hàng</a>
                                </h4>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Màu</th>
                                            <th>Size</th>
                                            <th>Tổng giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detail_don_hang as $value) : ?>
                                            <tr>
                                                <td><?php echo $value['ten_san_pham'] ?></td>
                                                <td class="text-danger"><?php echo number_format($value['price']) ?>đ</td>
                                                <td><?php echo $value['so_luong'] ?></td>
                                                <td><?php echo $value['mau'] ?></td>
                                                <td><?php echo $value['size'] ?></td>
                                                <td class="text-danger"><?php echo number_format($value['total_price']) ?>đ
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end card-body-->
                        </form>
                    </div>
                </div>
            </div>
            <!-- end page title -->

        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">2025 © Nguyễn Minh Thái.</div>
                <div class="col-sm-6">
                    <div class="text-sm-right d-none d-sm-block">
                        Quản lý Website
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
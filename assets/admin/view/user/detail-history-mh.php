<?php $detail_history_mh = don_hang_detail($_GET['id']) ?>
<div class="main-content">
    <div class="page-content pt-4">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Quản lý khách hàng</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Quản lý khách hàng</a>
                                </li>
                                <li class="breadcrumb-item active">Lịch sử chi tiết mua sắm của khách hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Lịch sử chi tiết mua sắm của khách hàng</h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Size</th>
                                        <th>Màu</th>
                                        <th>Tổng số tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail_history_mh as $value) : ?>
                                        <tr>
                                            <td class="font-weight-bolder text-primary">
                                                <?php echo $value['id_chi_tiet_don_hang'] ?></td>
                                            <td><?php echo $value['ten_san_pham'] ?></td>
                                            <td><?php echo number_format($value['price']) ?>đ</td>
                                            <td><?php echo $value['so_luong'] ?></td>
                                            <td data-toggle="tooltip" data-placement="top" title="<?php echo $value['kich_thuoc'] ?>"><?php echo $value['size'] ?></td>
                                            <td><?php echo $value['mau'] ?></td>
                                            <td><?php echo number_format($value['total_price']) ?>đ</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end card-body-->
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
<?php $don_hang_all =  don_hang_view_select(); ?>
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
                                <li class="breadcrumb-item active">Tất cả đơn hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tất cả đơn hàng</h4>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ giao</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Ghi chú</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($don_hang_all as $value) : ?>
                                        <tr>
                                            <td class="text-primary font-weight-normal"><?php echo $value['id_don_hang'] ?>
                                            </td>
                                            <td>Ghé thăm</td>
                                            <td><?php echo $value['phone'] ?></td>
                                            <td><?php echo $value['dia_chi_giao'] ?></td>
                                            <td>
                                                <span class="badge badge-pill badge-info">
                                                    <?php echo $value['name_trang_thai_don'] ?>
                                                </span>
                                                <input type="text" hidden value="<?php echo $value['id_trang_thai_don'] ?>" name="status_order">
                                            </td>
                                            <td><?php echo $value['ngay_tao'] ?></td>
                                            <td class="text-info"><?php echo $value['payment_method'] ?></td>
                                            <td><?php echo $value['note'] ?></td>
                                            <td class="order-btn">
                                                <a href="?act=list-detail-order&id=<?php echo $value['id_don_hang'] ?>" class="btn btn-light text-center p-2 " data-toggle="tooltip" data-placement="top" title="Xem chi tiết"><i class="bx bx-show font-weight-bold"></i></a>
                                                <button type="button" class="btn btn-light text-center p-2" data-toggle="modal" data-target="#exampleModal" value="<?= $value['id_don_hang'] ?>">
                                                    <i class="bx bx-pencil font-weight-bold"></i>
                                                </button>
                                            </td>
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
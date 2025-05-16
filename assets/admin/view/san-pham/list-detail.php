<?php $detail_sp_all = detail_san_pham_select_by($_GET['id']); ?>
<div class="main-content">
    <div class="page-content pt-4">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Quản lý sản phẩm</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Quản lý sản phẩm</a>
                                </li>
                                <li class="breadcrumb-item active">Danh sách sản phẩm</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="?act=delete-detail-sp" method="post">
                            <div class="card-body">
                                <h4 class="card-title">Chi tiết sản phẩm
                                    <a href="?act=addsp" class="btn btn-success float-right " style="transform: translateY(-30%);"> <i class="bx bx-plus pr-1"></i>Thêm sản
                                        phẩm</a>
                                </h4>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Size</th>
                                            <th>Màu</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detail_sp_all as $value) : if ($value['display_detail_san_pham'] == 0) {
                                                continue;
                                            } ?>
                                            <tr>
                                                <td><input type="checkbox" value="<?php echo $value['id_chi_tiet_san_pham'] ?>" <?php echo isset($_GET['checkAll']) ? 'checked' : '' ?> name="checkAll[]"></td>

                                                <td class="font-weight-bolder text-primary">
                                                    <?php echo $value['id_chi_tiet_san_pham'] ?></td>
                                                <td><?php echo $value['ten_san_pham'] ?></td>
                                                <td><?php echo $value['so_luong'] ?></td>
                                                <td class="text-info"><?php echo $value['size'] ?></td>
                                                <td><?php echo $value['mau'] ?></td>
                                                <td>
                                                    <a href="?act=update-detail-sp&id=<?php echo $value['id_chi_tiet_san_pham'] ?>&idsp=<?php echo $value['id_san_pham'] ?>" class="btn btn-light text-center p-2 " data-toggle="tooltip" data-placement="top" title="Sửa"><i class="bx bx-pencil font-weight-bold"></i></a>
                                                    <a href="?act=delete-detail-sp&id=<?php echo $value['id_chi_tiet_san_pham'] ?>&idsp=<?php echo $value['id_san_pham'] ?>" class="btn btn-light text-center p-2" data-toggle="tooltip" data-placement="top" title="Xoá" onclick="return confirm('Bạn chắc chắn muốn xoá nó chứ?')"><i class="bx bx-x font-weight-bold"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-transparent ">
                                <div class="float-right m-2">
                                    <input type="text" value="<?php echo  $detail_sp_all[0]['id_san_pham'] ?>" hidden name="id_san_pham">
                                    <input type="submit" value="Xoá các mục đã chọn" name="delete-detail-sp" class="btn btn-outline-danger" onclick="return confirm('Bạn chắc chắn muốn xoá hết tất cả chứ?')">
                                    <a href="?act=list-detail&id=<?php echo  $detail_sp_all[0]['id_san_pham'] ?>" class="btn btn-outline-success">Bỏ chọn tất cả</a>
                                    <a href="?act=list-detail&id=<?php echo $detail_sp_all[0]['id_san_pham'] ?>&checkAll" class="btn btn-outline-success">Chọn tất cả</a>
                                    <a href="?act=addsp" class="btn btn-success "> <i class="bx bx-plus pr-1"></i>Thêm
                                        sản phẩm </a>
                                </div>
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
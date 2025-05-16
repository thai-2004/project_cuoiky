<?php
$san_pham_all = san_pham_select_all();
?>
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
                        <form action="?act=delete-sp" method="post">
                            <div class="card-body">
                                <h4 class="card-title">Tất cả sản phẩm
                                    <a href="?act=addsp" class="btn btn-success float-right "
                                        style="transform: translateY(-30%);"> <i class="bx bx-plus pr-1"></i>Thêm sản
                                        phẩm</a>
                                </h4>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Mô tả</th>
                                            <th>Hình ảnh</th>
                                            <th>Lượt xem</th>
                                            <th>Danh mục</th>
                                            <th>Số lượng</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($san_pham_all as $value) : if ($value['display_san_pham'] == 0) {
                                                continue;
                                            } ?>
                                        <tr>
                                            <td><input type="checkbox" value="<?php echo $value['id_san_pham'] ?>"
                                                    <?php echo isset($_GET['checkAll']) ? 'checked' : '' ?>
                                                    name="checkAll[]"></td>
                                            <td class="font-weight-bolder text-primary">
                                                <?php echo $value['id_san_pham'] ?>
                                            </td>
                                            <td><?php echo $value['ten_san_pham'] ?></td>
                                            <td><?php echo number_format($value['price']) ?></td>
                                            <td><?php echo $value['mo_ta'] ?></td>
                                            <td><img src="../assets/images/product/<?php echo $value['hinh_anh'] ?>"
                                                    width="50px" height="50px" alt="">
                                            </td>
                                            <td><?php echo $value['luot_xem'] ?></td>
                                            <td><?php echo $value['ten_danh_muc'] ?></td>
                                            <td><?php echo detail_san_pham_value($value['id_san_pham']) ?></td>
                                            <td>
                                                <a href="?act=list-detail&id=<?php echo $value['id_san_pham'] ?>"
                                                    class="btn btn-light text-center p-2 " data-toggle="tooltip"
                                                    data-placement="top" title="Xem chi tiết"><i
                                                        class="bx bx-show font-weight-bold"></i></a>
                                                <a href="?act=update-sp&id=<?php echo $value['id_san_pham'] ?>"
                                                    class="btn btn-light text-center p-2 " data-toggle="tooltip"
                                                    data-placement="top" title="Sửa"><i
                                                        class="bx bx-pencil font-weight-bold"></i></a>
                                                <a href="?act=delete-sp&id=<?php echo $value['id_san_pham'] ?>"
                                                    class="btn btn-light text-center p-2" data-toggle="tooltip"
                                                    data-placement="top" title="Xoá"
                                                    onclick="return confirm('Bạn chắc muốn xoá chứ?')"><i
                                                        class="bx bx-x font-weight-bold"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-transparent ">
                                <div class="float-right m-2">
                                    <input type="submit" value="Xoá các mục đã chọn" name="delete-dm"
                                        class="btn btn-outline-danger"
                                        onclick="return confirm('Bạn chắc chắn muốn xoá hết tất cả chứ?')">
                                    <a href="?act=listsp" class="btn btn-outline-success">Bỏ chọn tất cả</a>
                                    <a href="?act=listsp&checkAll" class="btn btn-outline-success">Chọn tất cả</a>
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
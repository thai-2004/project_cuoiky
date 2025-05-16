<?php $detail_binh_luan = binh_luan_select_by_id($_GET['id']) ?>
<div class="main-content">
    <div class="page-content pt-4">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Quản lý bình luận</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Quản lý bình luận</a>
                                </li>
                                <li class="breadcrumb-item active">Chi tiết bình luận</li>
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
                                <h4 class="card-title">Chi tiết bình luận
                                    <a href="?act=list-comment" class="btn btn-success float-right "
                                        style="transform: translateY(-30%);">Danh sách bình luận</a>
                                </h4>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Họ tên</th>
                                            <th>Tên đăng nhập</th>
                                            <th>Nội dung</th>
                                            <th>Ngày bình luận</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detail_binh_luan as $value) : if ($value['display_binh_luan'] == 0) {
                                                continue;
                                            } ?>
                                        <tr>
                                            <td><input type="checkbox" value="<?php echo $value['id_binh_luan'] ?>"
                                                    <?php echo isset($_GET['checkAll']) ? 'checked' : '' ?>
                                                    name="checkAll[]"></td>
                                            <td class="d-flex">
                                                <img src="../assets/images/avatar/<?php echo $value['hinh_anh'] ?>"
                                                    alt="" width="50px" height="50px"
                                                    style="border-radius: 50%; object-fit: cover;">
                                                <div class="p-2">
                                                    <h6 class="mb-0 text-primary"><?php echo $value['ho_ten'] ?></h6>
                                                    <p class=""><?php echo $value['email'] ?></p>
                                                </div>
                                            </td>
                                            <td><?php echo $value['ten_dang_nhap'] ?></td>
                                            <td><?php echo $value['noi_dung'] ?></td>
                                            <td><?php echo $value['ngay_bl'] ?></td>
                                            <td>
                                                <a href="?act=reply-comment&id=<?php echo $value['id_binh_luan'] ?>"
                                                    class="btn btn-light text-center p-2 " data-toggle="tooltip"
                                                    data-placement="top" title="Trả lời"><i
                                                        class="bx bx-comment-dots"></i></a>
                                                <a href="?act=delete-binhluan&id=<?php echo $value['id_binh_luan'] ?>&idsp=<?php echo $value['id_san_pham'] ?>"
                                                    class="btn btn-light text-center p-2" data-toggle="tooltip"
                                                    data-placement="top" title="Xoá"
                                                    onclick="return confirm('Bạn chắc chắc muốn xoá chứ?')"><i
                                                        class="bx bx-x font-weight-bold"></i></a>
                                            </td>

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-transparent ">
                                <div class="float-right m-2">
                                    <input type="text" hidden value="<?php echo $detail_binh_luan[0]['id_san_pham'] ?>"
                                        name="id_san_pham">
                                    <input type="submit" value="Xoá các mục đã chọn" name="delete-binhluan"
                                        class="btn btn-outline-danger"
                                        onclick="return confirm('Bạn chắc chắn muốn xoá hết tất cả chứ?')">
                                    <a href="?act=detail-comment&id=<?php echo $_GET['id'] ?>"
                                        class="btn btn-outline-success">Bỏ chọn tất cả</a>
                                    <a href="?act=detail-comment&id=<?php echo $_GET['id'] ?>&checkAll"
                                        class="btn btn-outline-success">Chọn tất cả</a>

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
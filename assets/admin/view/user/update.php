<?php $roles = roles_select();
$khach_hang_one = user_select_by_id($_GET['id']) ?>
<div class="main-content">
    <div class="page-content pt-4 ">
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
                                <li class="breadcrumb-item active">Sửa thông tin khách hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Sửa thông tin khách hàng</h4>
                            <form action="?act=update-kh" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ho_ten">Họ tên</label>
                                            <input type="text" id="ho_ten" class="form-control" placeholder="Họ tên"
                                                name="ho_ten" value="<?php echo $khach_hang_one['ho_ten'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tenDN">Tên đăng nhập</label>
                                            <input type="text" id="tenDN" class="form-control"
                                                placeholder="Tên đăng nhập" name="ten_dang_nhap"
                                                value="<?php echo $khach_hang_one['ten_dang_nhap'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Mật khẩu</label>
                                            <input type="text" id="password" class="form-control" placeholder="Mật khẩu"
                                                name="mat_khau" value="<?php echo $khach_hang_one['mat_khau'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" class="form-control" placeholder="Nhập Email"
                                                name="email" value="<?php echo $khach_hang_one['email'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại</label>
                                            <input type="text" id="phone" class="form-control"
                                                placeholder="Nhập Số điện thoại" name="phone"
                                                value="<?php echo $khach_hang_one['phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="img">Hình ảnh</label>
                                            <input type="file" id="img" class="form-control" name="hinh_anh">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input type="text" id="address" class="form-control"
                                                placeholder="Nhập Địa chỉ" name="dia_chi"
                                                value="<?php echo $khach_hang_one['dia_chi'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="kich_hoat">Kích hoạt</label>
                                            <select name="kich_hoat" id="kich_hoat" class="form-control">
                                                <option value="" hidden>--Chọn kích hoạt--</option>
                                                <option value="0"
                                                    <?php echo $khach_hang_one['kich_hoat'] == 0 ? 'selected' : '' ?>>
                                                    Khoá</option>
                                                <option value="1"
                                                    <?php echo $khach_hang_one['kich_hoat'] == 1 ? 'selected' : '' ?>>
                                                    Kích hoạt</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="vai_tro">Vai trò</label>
                                            <select name="id_roles" id="vai_tro" class="form-control">
                                                <option value="" hidden>--Chọn vai trò--</option>
                                                <?php foreach ($roles as $value) : ?>
                                                <option value="<?php echo $value['id_roles'] ?>"
                                                    <?php echo $khach_hang_one['id_roles'] == $value['id_roles'] ? 'selected' : '' ?>>
                                                    <?php echo $value['ten_vai_tro'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="float-right">
                                    <input type="text" hidden value="<?php echo $khach_hang_one['id_kh']?>"
                                        name="id_kh">
                                    <a href="?act=listkh" class="btn btn-outline-success">Danh sách khách hàng</a>
                                    <input type="submit" class="btn btn-success" value="Sửa thông tin khách hàng"
                                        name="update-kh">
                                </div>
                            </form>
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
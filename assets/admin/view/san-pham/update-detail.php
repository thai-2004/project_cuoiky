<?php $san_pham_all = san_pham_select_all();
$san_pham_one =  detail_san_pham_select_by_one($_GET['id']);
$size_all = size_select();
$mau_all = mau_select();   ?>
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
                                <li class="breadcrumb-item active">Sửa chi tiết sản phẩm</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Sửa chi tiết sản phẩm</h4>
                            <form action="?act=update-detail-sp" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Sản phẩm</label>
                                            <select name="id_san_pham" id="" class="form-control">
                                                <?php foreach ($san_pham_all as $value) : ?>
                                                    <option value="" hidden>--Chọn sản phẩm--</option>
                                                    <option value="<?php echo $value['id_san_pham'] ?>" <?php echo ($value['id_san_pham'] == $san_pham_one['id_san_pham']) ? 'selected' : '' ?>>
                                                        <?php echo $value['ten_san_pham'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Số lượng</label>
                                            <input type="text" id="" class="form-control" name="so_luong" value="<?php echo $san_pham_one['so_luong'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Size</label>
                                            <select name="id_size" id="" class="form-control">
                                                <option value="" hidden>--Chọn Size--</option>
                                                <?php foreach ($size_all as $value) : ?>
                                                    <option value="<?php echo $value['id_size'] ?>" <?php echo ($value['id_size'] == $san_pham_one['id_size']) ? 'selected' : '' ?>>
                                                        <?php echo $value['size'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Màu</label>
                                            <select name="id_mau" id="" class="form-control">
                                                <option value="" hidden>--Chọn màu--</option>
                                                <?php foreach ($mau_all as $value) : ?>
                                                    <option value="<?php echo $value['id_mau'] ?>" <?php echo ($value['id_mau'] == $san_pham_one['id_mau']) ? 'selected' : '' ?>>
                                                        <?php echo $value['mau'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="float-right">
                                    <input type="text" hidden value="<?php echo $san_pham_one['id_chi_tiet_san_pham'] ?>" name="id_chi_tiet_san_pham">
                                    <a href="?act=list-detail&id=<?php echo $san_pham_one['id_san_pham'] ?>" class="btn btn-outline-success">Danh chi tiết sản
                                        phẩm</a>
                                    <input type="submit" class="btn btn-success" value="Sửa chi tiết sản phẩm" name="update-detail-sp">
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
<?php $danh_muc_all = loai_select_all();
$san_pham_one = san_pham_select_by_id($_GET['id']) ?>
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
                                <li class="breadcrumb-item active">Sửa sản phẩm</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Sửa sản phẩm</h4>
                            <form action="?act=update-sp" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tên sản phẩm</label>
                                            <input type="text" id="" class="form-control" name="ten_san_pham" value="<?php echo $san_pham_one['ten_san_pham'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Loại sản phẩm</label>
                                            <select id="" class="form-control" name="id_danh_muc">
                                                <option value="" hidden>--Chọn loại--</option>
                                                <?php foreach ($danh_muc_all as $value) : ?>
                                                    <option value="<?php echo $value['id_danh_muc'] ?>" <?php echo ($value['id_danh_muc'] == $san_pham_one['id_danh_muc']) ? 'selected' : '' ?>>
                                                        <?php echo $value['ten_danh_muc'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ảnh sản phẩm</label>
                                            <input type="file" class="form-control" name="hinh_anh">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Giá </label>
                                            <input type="text" id="" class="form-control" name="price" value="<?php echo $san_pham_one['price'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Mô tả</label>
                                            <textarea name="mo_ta" id="" cols="30" rows="10" class="form-control"><?php echo $san_pham_one['mo_ta'] ?></textarea>

                                        </div>

                                    </div>
                                </div>
                                <div class="float-right">
                                    <input hidden type="text" value="<?php echo $san_pham_one['id_san_pham'] ?>" name="id_san_pham">
                                    <a href="?act=listsp" class="btn btn-outline-success">Danh sách sản phẩm</a>
                                    <input type="submit" class="btn btn-success" value="Sửa sản phẩm" name="update-sp">
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
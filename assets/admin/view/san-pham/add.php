<?php $danh_muc_all = loai_select_all(); ?>
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
                                <li class="breadcrumb-item active">Thêm sản phẩm</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thêm sản phẩm</h4>
                            <form action="?act=addsp" method="post" enctype="multipart/form-data" id="myForms"
                                onsubmit="return checkForms()">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tên sản phẩm</label>
                                            <input type="text" id="" class="form-control" name="ten_san_pham">
                                            <div class="invalid-feedback">Tên sản phẩm không được bỏ trống</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Loại sản phẩm</label>
                                            <select id="" class="form-control" name="id_danh_muc">
                                                <option value="" hidden>--Chọn loại--</option>
                                                <?php foreach ($danh_muc_all as $value) : ?>
                                                <option value="<?php echo $value['id_danh_muc'] ?>">
                                                    <?php echo $value['ten_danh_muc'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">Loại sản phẩm không được bỏ trống</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ảnh sản phẩm</label>
                                            <input type="file" class="form-control" name="hinh_anh">
                                            <div class="invalid-feedback">Ảnh sản phẩm không được bỏ trống</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Giá </label>
                                            <input type="text" id="" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Mô tả</label>
                                            <textarea name="mo_ta" id="" cols="30" rows="10"
                                                class="form-control"></textarea>
                                            <div class="invalid-feedback">Mô tả sản phẩm không được bỏ trống</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="float-right">
                                    <a href="?act=listsp" class="btn btn-outline-success">Danh sách sản phẩm</a>
                                    <input type="submit" class="btn btn-success" value="Thêm sản phẩm" name="add-sp">
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
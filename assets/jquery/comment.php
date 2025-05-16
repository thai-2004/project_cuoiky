<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../dao/binh-luan.php';
date_default_timezone_set("Asia/Ho_Chi_Minh");
$date = date('Y-m-d H:i:s');
if (isset($_POST['content']) && isset($_POST['submit'])) {
    binh_luan_insert($_POST['id_kh'], $_POST['id_san_pham'], $_POST['content'], $date, 1);
}
if (isset($_POST['id_san_pham']) && isset($_POST['load'])) {
    $list_comment = binh_luan_select_all_by_product($_POST['id_san_pham']);
}
if (isset($_POST['delete']) && isset($_POST['id_binh_luan'])) {
    binh_luan_delete_none($_POST['id_binh_luan']);
}
if (isset($_POST['update']) && isset($_POST['id_binh_luan'])) {
    binh_luan_update_content($_POST['id_binh_luan'], $_POST['content']);
}
?>
<?php $i = 0;
foreach ($list_comment as $value) : $i++;
    if ($value['display_binh_luan'] == 0) {
        continue;
    } ?>
<div class="wapper-comment border-bottom mt-3">
    <div class="d-flex position-relative commnet">
        <img src="assets/images/avatar/<?= $value['hinh_anh'] ?>" alt=""
            style="width: 40px; height: 40px; border-radius: 50%;">
        <div class="info-comment ms-2" style="width: 100%;">
            <h6 class="m-0"><?= $value['ho_ten'] ?></h6>
            <p class="noiDung mb-0"><?= $value['noi_dung'] ?></p>
            <textarea class="form-control ms-2 border-bottom" placeholder="" id="floatingTextarea"
                style="display: none; width: 100%; overflow: hidden; resize: none; border: none; outline: none; box-shadow: none;"><?= $value['noi_dung'] ?></textarea>

            <span class="date-comment text-secondary" style="font-size: 11px;"><?= $value['ngay_bl'] ?></span>
            <!-- Xem thêm câu trả lời btn -->
            <?php $replys = reply_binh_luan_by_dropdown($value['id_binh_luan']);
                if (!empty($replys)) :
                ?>
            <p class="d-flex gap-1 mb-1 dropdown-comment">
                <a class="text-muted btn-link" style="font-size: 12px;" data-bs-toggle="collapse"
                    href="#collapseExample<?= $i ?>" role="button" aria-expanded="false"
                    aria-controls="collapseExample<?= $i ?>">
                    Xem thêm câu trả lời phía cửa hàng<i class="fa fa-angle-down ms-1" aria-hidden="true"></i>
                </a>
            </p>
            <?php endif ?>
            <button type="button" class="btn-edit-comment btn btn-info px-2 py-0 float-end mt-1 fw-normal "
                style="display: none; border:none; color: #333;">Lưu</button>
            <div class="feature-commnet position-absolute top-0 end-0 dropdown">

                <i class="fa fa-ellipsis-v px-3 pt-3 pb-1 btn-feature-comment" aria-hidden="true"
                    data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                <ul class="dropdown-menu dropdown-menu-end" style="margin-top: -5px;">
                    <?php if (isset($_SESSION['login']) && $_SESSION['login']['id_kh'] == $value['id_kh']) : ?>
                    <li><a class="dropdown-item edit-comment" href="<?= $value['id_binh_luan'] ?>"><i
                                class="fas fa-pen pe-3"></i>Chỉnhsửa</a>
                    </li>
                    <li><a class="dropdown-item delete-comment" href="<?= $value['id_binh_luan'] ?>"><i
                                class="far fa-trash-alt pe-3"></i>Xoá</a></li>
                    <?php else : ?>
                    <li><a class="dropdown-item repost-comment" href="<?= $value['id_binh_luan'] ?>"><i
                                class="far fa-flag pe-3"></i>Báo vi
                            phạm</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- Xem thêm câu trả lời text -->
    <?php foreach ($replys as $value) : ?>
    <div class="collapse ms-5" id="collapseExample<?= $i ?>">
        <div class=" commnet-feedback">
            <div class="d-flex position-relative">
                <img src="assets/images/avatar/<?= $value['hinh_anh'] ?>" alt=""
                    style="width: 24px; height: 24px; border-radius: 50%;">
                <div class="info-comment ms-2">
                    <h6 class="m-0"><?= $value['ho_ten'] ?></h6>
                    <p class=" mb-0"><?= $value['content'] ?></p>
                    <span class="text-secondary" style="font-size: 11px;"><?= $value['ngay_reply'] ?></span>
                </div>
                <!-- Hành động -->
                <!-- <div class="feature-commnet-feedback position-absolute top-0 end-0 dropdown">

                    <i class="fa fa-ellipsis-v px-3 pt-3 pb-1 btn-feature-comment" aria-hidden="true"
                        data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                    <ul class="dropdown-menu dropdown-menu-end" style="margin-top: -5px;">
                        <?php if (isset($_SESSION['login']) && $_SESSION['login']['id_kh'] == $value['id_kh']) : ?>
                        <li><a class="dropdown-item" href="<?= $value['id_binh_luan'] ?>"><i
                                    class="fas fa-pen pe-3"></i>Chỉnhsửa</a>
                        </li>
                        <li><a class="dropdown-item delete-comment" href="<?= $value['id_binh_luan'] ?>"><i
                                    class="far fa-trash-alt pe-3"></i>Xoá</a></li>
                        <?php else : ?>
                        <li><a class="dropdown-item" href="<?= $value['id_binh_luan'] ?>"><i
                                    class="far fa-flag pe-3"></i>Báo vi
                                phạm</a></li>
                        <?php endif ?>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endforeach; ?>
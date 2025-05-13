<?php
if (isset($_SESSION['login'])) {
    $login = user_select_by_id($_SESSION['login']['id_kh']);
}
?>
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title shadow-none bg-light rounded p-0">
                <img src="assets/images/avatar/<?php echo empty($login['hinh_anh']) ? 'no-avatar.jpg' : $login['hinh_anh'] ?>" alt="" width="40px" height="40px" style="border-radius: 50%; object-fit: cover;">
                <span class="px-2 fw-normal"><?php echo $login['ho_ten'] ?></span>
            </div>
            <h5>Tên đăng nhập: <span class="fw-lighter"><?php echo $login['ten_dang_nhap'] ?></span>
            </h5>
            <h5>Email: <span class="fw-lighter"><?php echo $login['email'] ?></span></h5>
            <h5>Số điện thoại: <span class="fw-lighter"><?php echo $login['phone'] ?></span>
            </h5>
            <h5>Địa chỉ: <span class="fw-lighter"><?php echo $login['dia_chi'] ?></span>
            </h5>
            <h5 class="d-flex align-align-items-start"><a href="?act=history-carts"><i class=" fas fa-clipboard-list pe-1 "></i>Đơn mua</a>
            </h5>
        </div>
    </div>
</div>
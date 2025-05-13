<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quên mật khẩu</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- main-content-wrap start -->
<div class="main-content-wrap section-ptb lagin-and-register-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 m-auto">
                <div class="login-register-wrapper">
                    <!-- login-register-tab-list start -->
                    <div class="login-register-tab-list nav">
                        <a href="#lg1">
                            <h4> Quên mật khẩu </h4>
                        </a>

                    </div>
                    <!-- login-register-tab-list end -->
                    <div class="">
                        <div class="">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="?act=newPassword" method="post" id="myForms" onsubmit="return checkForms()">
                                        <div class="login-input-box">
                                            <label for="" class="form-label">Mã xác nhận</label>
                                            <div id="passwordHelpBlock" class="form-text text-danger errorMa" style="display: none;">
                                                Mã xác nhận bạn nhập không chính xác
                                            </div>
                                            <input class="form-control" type="text" name="maXacNhan" placeholder="Điền mã xác nhận" onkeyup="xacNhanMa()" autofocus>
                                            <div class="valid-feedback">Mã xác nhận đã đúng mời bạn nhập mật khẩu mới
                                            </div>
                                            <div class="invalid-feedback">Mã xác nhận không được bỏ trống</div>
                                            <label for="" class="form-label">Mật khẩu mới</label>
                                            <div class="position-relative">
                                                <input type="password" disabled name="newPassword" placeholder="Điền mật khẩu mới " class="mb-0 js-input-pass" style="opacity: 0.2;">
                                                <i class="fa fa-eye position-absolute js-icon-eye" aria-hidden="true"></i>
                                                <i class="fa fa-eye-slash position-absolute js-icon-eye" aria-hidden="true"></i>
                                                <div id="passwordHelpBlock " class="form-text text-danger errorNewPassword">
                                                    Bạn phải xác nhận mã trước mới nhập được mật khẩu mới!
                                                </div>
                                                <div class="invalid-feedback">Mật khẩu không được bỏ trống</div>
                                            </div>

                                        </div>
                                        <div class="button-box my-3">
                                            <div class="login-toggle-btn">

                                                <a href="?act=login">Quay lại đăng nhập</a>
                                            </div>
                                            <div class="button-box">
                                                <button class="login-btn btn" name="xacNhan" value="login" type="submit"><span>Xác nhận</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main-content-wrap end -->
<script>
    function xacNhanMa() {
        let errorNewPassword = document.querySelector(".errorNewPassword");
        let errorMa = document.querySelector(".errorMa");
        let xacNhanMa = document.querySelector('input[name="maXacNhan"')
        let newPassword = document.querySelector('input[name="newPassword"');
        if (xacNhanMa.value == <?php echo $_SESSION['maXacNhan'] ?>) {
            errorNewPassword.style.display = "none";
            errorMa.style.display = "none";
            newPassword.disabled = false;
            xacNhanMa.classList.add('is-valid');
            xacNhanMa.classList.remove('is-invalid');
            xacNhanMa.autofocus = false;
            newPassword.style.opacity = '1';
            newPassword.autofocus = true;
        } else {
            newPassword.disabled = true;
            newPassword.style.opacity = '0.2';
            xacNhanMa.classList.remove('is-valid');
            errorNewPassword.style.display = "block";
            errorMa.style.display = "block";
        }

    }
</script>
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
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
                                    <form action="?act=forgot_password" method="post" id="myForms" onsubmit="return checkForms()">
                                        <div class="login-input-box">
                                            <label for="" class="form-label">Tên đăng nhập</label>
                                            <input type="text" name="user-name" placeholder="Điền tên đăng nhập">
                                            <div class="invalid-feedback">Tên đăng nhập không được bỏ trống</div>
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" name="user-email" placeholder="Điền email ">
                                            <div class="invalid-feedback">Email không được bỏ trống</div>
                                        </div>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">

                                                <a href="?act=login">Quay lại đăng nhập</a>
                                            </div>
                                            <div class="button-box">
                                                <button class="login-btn btn" name="forgot" value="login" type="submit"><span>Gửi mã</span></button>
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
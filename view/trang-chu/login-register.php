        <!-- breadcrumb-area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list">
                            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Đăng nhập &amp; Đăng ký</li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb-area end -->

        <!-- main-content-wrap start -->
        <div class="main-content-wrap section-ptb lagin-and-register-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 m-auto">
                        <div class="login-register-wrapper">
                            <!-- login-register-tab-list start -->
                            <div class="login-register-tab-list nav">
                                <a class="active" data-bs-toggle="tab" href="#lg1">
                                    <h4> Đăng nhập </h4>
                                </a>
                                <a data-bs-toggle="tab" href="#lg2">
                                    <h4> Đăng ký </h4>
                                </a>
                            </div>
                            <!-- login-register-tab-list end -->
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="?act=login" method="post" id="myForms" onsubmit="return checkForms()">
                                                <div class="login-input-box">
                                                    <input type="text" name="user-name" placeholder="Tên đăng nhập">
                                                    <div class="invalid-feedback">Tên đăng nhập không được bỏ trống
                                                    </div>
                                                    <div class="position-relative">
                                                        <input type="password" name="user-password" class="js-input-pass" placeholder="Mật khẩu">
                                                        <i class="fa fa-eye position-absolute js-icon-eye" aria-hidden="true"></i>
                                                        <i class="fa fa-eye-slash position-absolute js-icon-eye" aria-hidden="true"></i>
                                                        <div class="invalid-feedback">Mật khẩu không được bỏ trống</div>
                                                    </div>

                                                </div>
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">

                                                        <a href="?act=forgot_password">Quên mật khẩu?</a>
                                                    </div>
                                                    <div class="button-box">
                                                        <button class="login-btn btn" name="login" value="login" type="submit"><span>Đăng
                                                                nhập</span></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="?act=register" method="post" id="myForms2" onsubmit="return checkForms2()">
                                                <div class="login-input-box">
                                                    <input type="text" name="ho_ten" placeholder="Họ và tên">
                                                    <div class="invalid-feedback">Tên không được bỏ trống</div>
                                                    <input type="text" name="user-name" placeholder="Tên đăng nhập">
                                                    <div class="invalid-feedback">Tên đăng nhập không được bỏ trống
                                                    </div>
                                                    <div class="position-relative">
                                                        <input type="password" name="user-password" class="js-input-pass" placeholder="Mật khẩu">
                                                        <i class="fa fa-eye position-absolute js-icon-eye" aria-hidden="true"></i>
                                                        <i class="fa fa-eye-slash position-absolute js-icon-eye" aria-hidden="true"></i>
                                                        <div class="invalid-feedback">Mật khẩu không được bỏ trống</div>
                                                    </div>
                                                    <input name="user-email" placeholder="Email" type="email">
                                                    <div class="invalid-feedback">Email không được bỏ trống</div>
                                                </div>
                                                <div class="button-box">
                                                    <button class="register-btn btn" type="submit" name="register" value="register"><span>Đăng
                                                            ký</span></button>
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
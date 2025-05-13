<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Giỏ hàng</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- main-content-wrap start -->
<div class="main-content-wrap section-ptb cart-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive mb-5">
                    <div class="cart-heading mb-4">
                        <h3>Giỏ hàng của bạn</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main-content-wrap end -->
<script>
    function inputcheckAll() {
        let checkAll = document.querySelector('input[name="checkAll"]');
        let checks = document.querySelectorAll('input[type="checkbox"]');
        if (checkAll.checked) {
            checks.forEach(function(check) {
                check.checked = true;
            });
        } else {
            checks.forEach(function(check) {
                check.checked = false;
            });
        }
    }
</script>
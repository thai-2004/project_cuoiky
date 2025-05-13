<div class="product-description-area section-pt">
    <div class="row">
        <div class="col-lg-12">
            <div class="product-details-tab">
                <ul role="tablist" class="nav">
                    <li class="active" role="presentation">
                        <a data-bs-toggle="tab" role="tab" href="#description" class="active">Bình luận</a>
                    </li>
                    <li role="presentation">
                        <a data-bs-toggle="tab" role="tab" href="#reviews">Đánh giá</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="product_details_tab_content tab-content">
                <!-- Start Single Content -->
                <div class="product_tab_content tab-pane active" id="description" role="tabpanel">
                    <div class="product_description_wrap  mt-30">
                        <div class="product_desc mb-30">
                            <!-- Gửi bình luận -->
                            <?php if (isset($_SESSION['login'])) : ?>
                                <div class="write-comment mb-5">
                                    <div class="d-flex position-relative mb-1">
                                        <img src="assets/images/avatar/<?php echo (!empty($_SESSION['login']['hinh_anh'])) ? $_SESSION['login']['hinh_anh'] : 'no-avatar.jpg' ?>" alt="" style="width: 40px; height: 40px; border-radius: 50%;">
                                        <div class="form-floating" style="width: 100%;">
                                            <textarea class="form-control ms-2 " placeholder="Leave a comment here" id="floatingTextarea" style="width: 100%; overflow: hidden; resize: none;"></textarea>
                                            <label for="floatingTextarea">Viết bình luận...</label>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-comment btn btn-info px-2 py-0 float-end mt-1 fw-normal " style="display: none; border:none; color: #333;">Bình luận</button>
                                </div>
                            <?php endif; ?>
                            <!-- Danh sách comment -->
                            <div class="list-comment">

                            </div>

                        </div>
                    </div>
                    <!-- End Single Content -->
                </div>
                <!-- Start Single Content -->
                <?php $list_feedback = danh_gia_feedback($_GET['id']) ?>
                <div class="product_tab_content tab-pane" id="reviews" role="tabpanel">
                    <?php foreach ($list_feedback as $value) : ?>
                        <div class="review_address_inner mt-30">
                            <!-- Start Single Review -->
                            <div class="pro_review">
                                <div class="review_thumb">
                                    <img alt="review images" src="assets/images/avatar/<?= $value['hinh_anh'] ?>" style="width: 40px; height: 40px; border-radius: 50%;">
                                </div>
                                <div class="review_details ms-0">
                                    <div class="review_info mb-10">
                                        <h6><?= $value['ho_ten'] ?></h6>
                                        <ul class="product-rating d-flex " style="font-size: 10px;">
                                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                                <?php if ($i < $value['danh_gia']) : ?>
                                                    <li><i class="fa fa-star"></i></li>
                                                <?php else : ?>
                                                    <li><i class="fa fa-star-o"></i></li>
                                            <?php endif;
                                            endfor; ?>
                                        </ul>
                                        <span class=" fw-lighter"><?= $value['ngay_danh_gia'] ?> | Phân loại hàng:
                                            <?= $value['id_san_pham'] ?></span>

                                    </div>
                                    <p><?= $value['noi_dung'] ?></p>
                                </div>
                            </div>
                            <!-- End Single Review -->
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- End Single Content -->
            </div>
        </div>
    </div>
</div>
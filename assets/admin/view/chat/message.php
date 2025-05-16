<?php
$list_chat = chat_select();
?>
<div class="main-content" style="height: calc(100vh - 70px);">
    <div class="page-content pt-4">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Trò chuyện</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Admin</a>
                                </li>
                                <li class="breadcrumb-item active">Trò chuyện</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-3"
                    style="overflow: auto; width: auto; height: calc(100vh - 203px);margin-bottom: 60.8px">
                    <div id="chat-contact" class="media-list media-list-hover media-list-divided "
                        style="overflow: auto; width: auto;">
                        <?php foreach ($list_chat as $value) : ?>
                        <div class="media media-single py-3  border-bottom" data-id-chat="<?= $value['id_chat'] ?>"
                            style="cursor: pointer;">
                            <a href="#">
                                <img style="width: 50px; height: 50px; border-radius: 50%;"
                                    class="avatar avatar-xl mr-2" src="../assets/images/avatar/no-avatar.jpg" alt="...">
                            </a>
                            <div class="media-body">
                                <h6><a href="#">Cuộc trò chuyện: <?= $value['id_chat'] ?></a></h6>
                                <small
                                    class="text-green"><?php $new_mess = message_new($value['id_chat']);
                                  echo ($new_mess['id_send'] == 1) ? 'Bạn:  ' : 'Khách hàng:  ';echo $new_mess['content'] ?><i
                                        class="bx bx-check-circle float-right" style="line-height: 20px;"></i></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-9 position-relative detail-chat-message" style="height: 72vh;">


                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">2023 © Nguyễn Huy Tới.</div>
                <div class="col-sm-6">
                    <div class="text-sm-right d-none d-sm-block">
                        Quản lý Website
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
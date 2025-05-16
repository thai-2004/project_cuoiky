<?php
include_once '../../../assets/dao/chat.php';
$list_chat = chat_select();
?>
<?php foreach ($list_chat as $value) : ?>
    <div class="media media-single py-3  border-bottom" data-id-chat="<?= $value['id_chat'] ?>" style="cursor: pointer;">
        <a href="#">
            <img style="width: 50px; height: 50px; border-radius: 50%;" class="avatar avatar-xl mr-2" src="../assets/images/avatar/no-avatar.jpg" alt="...">
        </a>
        <div class="media-body">
            <h6><a href="#">Cuộc trò chuyện: <?= $value['id_chat'] ?></a></h6>
            <small class="text-green"><?php $new_mess = message_new($value['id_chat']);
                                        echo ($new_mess['id_send'] == 1) ? 'Bạn:  ' : 'Khách hàng:  ';
                                        echo $new_mess['content'] ?><i class="bx bx-check-circle float-right" style="line-height: 20px;"></i></small>
        </div>
    </div>
<?php endforeach; ?>
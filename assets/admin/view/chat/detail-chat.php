<?php
include_once '../../../assets/dao/chat.php';
if (isset($_POST['create'])) {
    message_insert($_POST['id_chat'], 1, $_POST['content']);
} else {
    $detail_chat = message_select($_POST['id_chat']);
}
?>
<div class="top_menu">
    <div class="title">Chat</div>
</div>
<ul class="messages">
    <?php foreach ($detail_chat as $value) : if ($value['id_send'] == 1) : ?>
            <li class="message right appeared">
                <div>
                    <div class="avatar"></div>
                    <div class="text_wrapper">
                        <div class="text"><?= $value['content'] ?></div>
                    </div>
                </div>
                <span class="align-self-end" style="opacity: 0.6; font-size: 12px; color: #2f2c2ccc; text-align: end; margin-right: 80px;"><?= $value['time'] ?></span>
            </li>
        <?php else : ?>
            <li class="message left appeared">
                <div>
                    <div class="avatar"></div>
                    <div class="text_wrapper">
                        <div class="text"><?= $value['content'] ?></div>
                    </div>
                </div>
                <span class=" align-self-start" style="opacity: 0.6; font-size: 12px; color: #2f2c2ccc; text-align: end; margin-left: 80px;"><?= $value['time'] ?></span>
            </li>
    <?php endif;
    endforeach ?>

</ul>
<div class="bottom_wrapper clearfix border-top">
    <div class="message_input_wrapper">
        <input class="message_input" placeholder="Nhập tin nhắn của bạn ở đây..." />
    </div>
    <div class="send_message">
        <div class="icon"></div>
        <div class="text">Gửi</div>
    </div>
</div>

<div class="message_template">
    <li class="message">
        <div class="avatar"></div>
        <div class="text_wrapper">
            <div class="text"></div>
        </div>
    </li>
</div>
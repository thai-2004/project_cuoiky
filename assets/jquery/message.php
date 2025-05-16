<?php
include_once '../dao/chat.php';
if (isset($_POST['create'])) {
    if (isset($_POST['create_chat'])) {
        chat_insert($_POST['id_chat']);
        message_insert($_POST['id_chat'], 0, $_POST['content']);
    } else {
        message_insert($_POST['id_chat'], 0, $_POST['content']);
    }
}
$list_chat =  message_select($_POST['id_chat']);
?>
<?php foreach ($list_chat as $value) : ?>
    <?php if ($value['id_send'] == 0) : ?>
        <li class="message right appeared">
            <div>
                <div class="avatar"></div>
                <div class="text_wrapper">
                    <div class="text"><?= $value['content'] ?></i></div>
                </div>
            </div>
            <span class="align-self-end" style="opacity: 0.6; font-size: 9px; color: #2f2c2ccc; text-align: end;"><?= $value['time'] ?> <i class="far fa-check"></i></span>
        </li>
    <?php else : ?>
        <li class="message left appeared">
            <div>
                <div class="avatar"></div>
                <div class="text_wrapper">
                    <div class="text"><?= $value['content'] ?></i></div>
                </div>
            </div>
            <span class="align-self-start" style="opacity: 0.6; font-size: 9px; color: #2f2c2ccc; text-align: end;"><?= $value['time'] ?> <i class="far fa-check"></i></span>
        </li>
<?php endif;
endforeach ?>
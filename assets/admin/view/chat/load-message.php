<?php
include_once '../../../assets/dao/chat.php';
$detail_chat = message_select($_POST['id_chat']);
?>
<?php foreach ($detail_chat as $value) : if ($value['id_send'] == 1) : ?>
<li class="message right appeared">
    <div>
        <div class="avatar"></div>
        <div class="text_wrapper">
            <div class="text"><?= $value['content'] ?></div>
        </div>
    </div>
    <span class="align-self-end"
        style="opacity: 0.6; font-size: 12px; color: #2f2c2ccc; text-align: end; margin-right: 80px;"><?= $value['time'] ?></span>
</li>
<?php else : ?>
<li class="message left appeared">
    <div>
        <div class="avatar"></div>
        <div class="text_wrapper">
            <div class="text"><?= $value['content'] ?></div>
        </div>
    </div>
    <span class=" align-self-start"
        style="opacity: 0.6; font-size: 12px; color: #2f2c2ccc; text-align: end; margin-left: 80px;"><?= $value['time'] ?></span>
</li>
<?php endif;
endforeach ?>
<?php
include_once '../dao/san-pham.php';
if (isset($_POST['keywork'])) {
    $autocompletes = search_autocomplete($_POST['keywork']);
}
?>
<ul>
    <?php foreach ($autocompletes as $value) : ?>
        <li><?= $value['ten_san_pham'] ?></li>
    <?php endforeach; ?>
</ul>
<?php
include_once '../../../assets/dao/don-hang.php';
$id_don_hang = $_POST['id_don_hang'];
$history_status = pdo_query_one("SELECT don_hang.id_trang_thai_don FROM `don_hang` WHERE id_don_hang = '$id_don_hang'");
$sql = "SELECT * FROM trang_thai_don";
$status = pdo_query($sql); ?>

<!--  -->
<?php foreach ($status as $value) : ?>
    <option value="<?php echo $value['id_trang_thai_don'] ?>" <?php echo ($history_status == $value['id_trang_thai_don']) ? 'selected' : '' ?>>
        <?php echo $value['name_trang_thai_don'] ?>
    </option>
<?php endforeach ?>
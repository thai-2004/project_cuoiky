<?php
require_once 'pdo.php';
function mau_select()
{
    $sql = "SELECT * FROM mau";
    return pdo_query($sql);
}

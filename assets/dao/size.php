<?php
require_once 'pdo.php';
function size_select()
{
    $sql = "SELECT * FROM size";
    return pdo_query($sql);
}

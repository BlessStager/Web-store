<?php
require_once("config.php");
$num = getNumItemsOfCart();
echo json_encode($num);
?>
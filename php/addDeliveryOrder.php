<?php 
require_once("config.php");
$order = $_POST['order'];
$message = addDeliveryOrder($order);
echo json_encode($message);
?>
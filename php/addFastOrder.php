<?php 
require_once("config.php");
$order = $_POST['order'];
$message = addFastOrder($order);
echo json_encode($message);
?>
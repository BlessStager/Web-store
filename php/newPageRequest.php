<?php
require_once("config.php");
$id = $_GET['id'];
$newPage = newPage($id);
echo json_encode($newPage);
?>
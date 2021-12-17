<?php
require_once("config.php");
$currentPage = $_GET['dt'];
$newsArray = news($currentPage);
echo json_encode($newsArray);
?>
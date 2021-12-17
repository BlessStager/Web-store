<?php
require_once("config.php");
$type = $_GET['type'];
$pageNumber = $_GET['page'];
$catalogPage = displayCatalogPage($type, $pageNumber);
echo json_encode($catalogPage);
?>
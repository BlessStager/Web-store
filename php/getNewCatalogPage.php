<?php
$type = $_GET['type'];
$pageNumber = $_GET['page'];
$newPageUrl = "catalog.php?type=$type&page=$pageNumber";
echo json_encode($newPageUrl);
?>
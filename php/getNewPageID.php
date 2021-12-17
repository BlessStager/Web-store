<?php
$pageID = $_GET['pageID'];
$newPageUrl = "new.php?pageID=$pageID";
echo json_encode($newPageUrl);
?>
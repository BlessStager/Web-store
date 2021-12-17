<?php
require_once("config.php");
$name = $_POST['name'];
deleteFromCart($name);
?>
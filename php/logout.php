<?php
    setcookie('user', 'value', time() - 1, '/');
    setcookie('admin', 'value', time() - 1, '/');
    header('Location: ../main-page.php');
?>
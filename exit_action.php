<?php
    require_once './config.php';
    $_SESSION['login'] = '';
    header('location: '.$base);
    exit;

?>
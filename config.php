<?php

    session_start();

    $base = 'http://localhost/gomoney';

    date_default_timezone_set('America/Sao_Paulo');

    $pdo = new PDO('mysql:host=localhost;dbname=gomoney', 'root', '');

?>
<?php

    require_once './config.php';

    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
    $data = date('Y-m-d', strtotime(filter_input(INPUT_POST, 'data')));
    $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_SPECIAL_CHARS);
    $date = [];

    if($titulo && $tipo && $data && $valor){
        $sql = $pdo->prepare("INSERT INTO item
        (id_user, titulo, tipo, data, valor) VALUES
        (:id_user, :titulo, :tipo, :data, :valor)");
        $sql->bindValue(":id_user", $_SESSION['login']['id']);
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":data", $data);
        $sql->bindValue(":valor", $valor);
        $sql->execute();
        $date = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    header('location: '.$base);
    exit;

?>
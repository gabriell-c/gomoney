<?php

    require_once './config.php';

    $titulo = filter_input(INPUT_POST, 'novo_titulo', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo = filter_input(INPUT_POST, 'novo_tipo', FILTER_SANITIZE_SPECIAL_CHARS);
    $data = date('Y-m-d', strtotime(filter_input(INPUT_POST, 'newDate')));
    $valor = filter_input(INPUT_POST, 'newValor', FILTER_SANITIZE_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $date = [];

    if($titulo && $tipo && $data && $valor && $id){
        $sql = $pdo->prepare("UPDATE item SET titulo = :titulo, tipo = :tipo, data = :data, valor = :valor WHERE id = :id AND id_user = :id_user");
        $sql->bindValue(":id_user", $_SESSION['login']['id']);
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":data", $data);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    header('location: '.$base);
    exit;

?>
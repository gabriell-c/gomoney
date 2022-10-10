<?php

    require_once './config.php';

    $id = filter_input(INPUT_GET, 'id');

    if(!$id){
        header('location: '.$base);
        exit;
    }

    if($id){
        $sql = $pdo->prepare("SELECT * FROM item WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $pdo->prepare("DELETE FROM item WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
        }
    }
    
    header('location: '.$base);
    exit;
?>
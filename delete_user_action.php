<?php

    require_once './config.php';

    $id = $_SESSION['login']['id'];
    $senha = filter_input(INPUT_POST, 'senhaDelete');

    if(!$id){
        header('location: '.$base);
        exit;
    }

    if(password_verify($senha, $_SESSION['login']['senha'])){
        if($id){
            $sql = $pdo->prepare("SELECT * FROM users WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $sqlItems = $pdo->prepare("DELETE FROM item WHERE id_user = :id_user");
                $sqlItems->bindValue(":id_user", $id);
                $sqlItems->execute();
    
                $sqlUser = $pdo->prepare("DELETE FROM users WHERE id = :id");
                $sqlUser->bindValue(":id", $id);
                $sqlUser->execute();
    
                $_SESSION['login'] = '';
                $_SESSION['warning'] = '';
                header('location: '.$base);
                exit;
            }
        }
    }else{
        $_SESSION['warning'] = 'Senhas incorreta!';
        header('location: '.$base.'/configuracoes.php');
        exit;
    }
    
    
?>
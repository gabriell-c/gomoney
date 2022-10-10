<?php

    require_once './config.php';

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
    $nascimento = date('Y-m-d', strtotime(filter_input(INPUT_POST, 'nascimento')));
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmar_senha = filter_input(INPUT_POST, 'confirmar_senha', FILTER_SANITIZE_SPECIAL_CHARS);

    if($nome && $email && $nascimento && $senha && $confirmar_senha){

        if($senha === $confirmar_senha){
            $hash = password_hash($senha, PASSWORD_BCRYPT);
            $sql = $pdo->prepare("UPDATE users SET senha = :senha WHERE nome = :nome AND email = :email AND nascimento = :nascimento");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":nascimento", $nascimento);
            $sql->bindValue(":senha", $hash);
            $sql->execute();
            $_SESSION['warning'] = '';
            header('location: '.$base.'/login.php');
            exit;
        }else{
            $_SESSION['warning'] = 'Senhas não conferem!';
            header('location: '.$base.'/forgot_password.php');
            exit;
        }
        
    }else{
        $_SESSION['warning'] = 'Preencha todos os campos corretamente!';
        header('location: '.$base.'/forgot_password.php');
        exit;
    }

?>
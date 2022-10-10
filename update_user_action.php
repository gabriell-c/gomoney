<?php

    require_once './config.php';

    $nome = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
    $nascimento = date('Y-m-d', strtotime(filter_input(INPUT_POST, 'nascimento')));
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmar_senha = filter_input(INPUT_POST, 'confirmar_senha', FILTER_SANITIZE_SPECIAL_CHARS);

    if($nome && $email && $nascimento){

        $sql = $pdo->prepare("UPDATE users SET nome = :nome, email = :email, nascimento = :nascimento WHERE id = :id");
        $sql->bindValue(":id", $_SESSION['login']['id']);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":nascimento", $nascimento);
        $sql->execute();
        $_SESSION['warning'] = '';

        if($senha && $confirmar_senha){
            $hash = password_hash($senha, PASSWORD_BCRYPT);

            if($senha === $confirmar_senha){
                $dataUSer = $pdo->prepare("UPDATE users SET senha = :senha WHERE id = :id");
                $dataUSer->bindValue(":id", $_SESSION['login']['id']);
                $dataUSer->bindValue(":senha", $hash);
                $dataUSer->execute();

                $_SESSION['warning'] = '';
                header('location: '.$base);
                exit;
            }else{
                $_SESSION['warning'] = 'Senhas não conferem!';
                header('location: '.$base.'/configuracoes.php');
                exit;
            }
        }

        ;
        header('location: '.$base);
        exit;
        
    }else{
        $_SESSION['warning'] = 'Preencha todos os campos corretamente!';
        header('location: '.$base.'/configuracoes.php');
        exit;
    }

?>
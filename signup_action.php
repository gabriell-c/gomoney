<?php

    require_once './config.php';

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
    $nascimento = date('Y-m-d', strtotime(filter_input(INPUT_POST, 'nascimento')));
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $confirma_senha = filter_input(INPUT_POST, 'confirma_senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $date = [];

    if($nome && $email && $nascimento && $senha && $confirma_senha){

        if($senha === $confirma_senha){

            $findByEmail = $pdo->prepare("SELECT * FROM users WHERE email = :email ");
            $findByEmail->bindValue(":email", $email);
            $findByEmail->execute();

            if($findByEmail->rowCount() > 0){
                $_SESSION['login'] = '';
                $_SESSION['warning'] = 'Conta com email já existente!';
                header('location: '.$base.'/signup.php');
                exit;
            }

            $hash = password_hash($senha, PASSWORD_BCRYPT);
            $sql = $pdo->prepare("INSERT INTO users
            (nome, email, senha, nascimento) VALUES
            (:nome, :email, :senha, :nascimento)");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", $hash);
            $sql->bindValue(":nascimento", $nascimento);
            $sql->execute();
            
            $sqlUser = $pdo->prepare("SELECT * FROM users WHERE email = :email AND senha = :senha");
            $sqlUser->bindValue(":email", $email);
            $sqlUser->bindValue(":senha", $hash);
            $sqlUser->execute();
            $dataUser = $sqlUser->fetch(PDO::FETCH_ASSOC);

            $_SESSION['warning'] = '';
            $_SESSION['login'] = $dataUser;
            header('location: '.$base);
            exit;
        }else{
            $_SESSION['warning'] = 'Senhas não conferem!';
            header('location: '.$base.'/signup.php');
            exit;
        }
    }else{
        $_SESSION['warning'] = 'Preencha todos os campos corretamente!';
        header('location: '.$base);
        exit;
    }

?>
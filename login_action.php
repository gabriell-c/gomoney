<?php

    require_once './config.php';

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

    if($email && $senha){
        $sql = $pdo->query("SELECT * FROM users");
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        $findByEmail = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $findByEmail->bindValue(":email", $email);
        $findByEmail->execute();

        if(password_verify($senha, $data[0]['senha']) && $findByEmail->rowCount() > 0){
            $_SESSION['login'] = $data[0];
            header('location: '.$base);
            $_SESSION['warning'] = '';
            exit;
        }else{
            $_SESSION['warning'] = 'Email e/ou senha incorretas!';
            $_SESSION['login'] = '';
            header('location: '.$base.'/login.php');
            exit;
        }
    }

    
    header('location: '.$base.'/login.php');
    $_SESSION['warning'] = 'Preencha todos os campos corretamente!';
    exit;
?>
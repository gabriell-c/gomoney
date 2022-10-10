<?php

    require_once './config.php';
?>

<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./public/css/style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/b5afd26a30.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="./public/imgs/logo_icon.png" />
        <title>GoMoney</title>
    </head>
    <body class="bg-light" >
    <header class="header">
        <button type="button" class="openModal btn btn-light">Adicionar+</button>
        <a class="logo" href="<?=$base?>"><img src="./public/imgs/logo2.png" alt="logo" /></a>
        <div class="menuArea">
            <ul class="ul">
                <li class="menuItemPrimary"><?=explode(' ', $_SESSION['login']['nome'])[0]?><i class="fa-solid fa-bars"></i></li>
                <ul id="ul2" class="ul2">
                    <a href="<?=$base?>/configuracoes.php"><li id="item" class="menuItem">Configurações</li></a>
                    <a href="<?=$base?>/exit_action.php"><li id="item" style="border-radius: 0 0 5px 5px;" class="menuItem">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></li></a>
                </ul>
            </ul>     
        </div>
    </header>
    <script>
        let buttonMenu = document.querySelector(".fa-bars");

        buttonMenu.addEventListener("click", ()=>{
            document.getElementById("ul2").classList.toggle("show");
        })
    </script>
    

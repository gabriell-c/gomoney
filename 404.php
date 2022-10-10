<?php require_once './config.php' ?>;


<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="./public/css/error.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página não encontrada!</title>
    </head>
    <body>
        <section class="sectionError">
            <img src="./public/imgs/error.png" alt="404" />
            <a href="<?=$base?>"><button>Voltar ao início</button></a>
        </section>
    </body>
</html>
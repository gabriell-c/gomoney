<?php

    require_once './config.php';
    require_once './partials/headerLogin.php';

?>

<section class="loginSection">
    <div class="loginArea">
        <form method="POST" action="./signup_action.php">
            <h1>Cadastrar <i class='bx bxs-lock'></i></h1>
            <p class="warning"><?=$_SESSION['warning']?></p>
            <div class="label-float-login">
                <input type="text" autofocus name="nome" required placeholder=" "/>
                <label>Nome</label>
            </div>
            <div class="label-float-login">
                <input type="email" autofocus name="email" required placeholder=" "/>
                <label>Email</label>
            </div>

            <div class="label-float-login">
                <input type="text" id="nascimento" name="nascimento" required placeholder=" "/>
                <label>Data de nascimento</label>
            </div>

            <div class="label-float-login">
                <input type="password" name="senha" required placeholder=" "/>
                <label>Senha</label>
            </div>

            <div class="label-float-login">
                <input type="password" name="confirma_senha" required placeholder=" "/>
                <label>Confirmar senha</label>
            </div>            

            <button type="submit" class="buttonLogin">Cadastrar</button>

            <p class="signup">Já tem uma conta? <a href="<?=$base?>/login.php">Entre</a></p>

        </form>
    </div>
</section>

<script src="https://unpkg.com/imask"></script>
<script>
    IMask(
        document.getElementById("nascimento"),
        {mask:'00/00/0000'}
    );

    document.title = "GoMoney - Cadastro";
</script>

<?php require_once './partials/footer.php'; ?>
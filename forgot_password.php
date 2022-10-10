<?php
    require_once './config.php';
    require_once './partials/headerLogin.php';

?>

<section class="loginSection">
    <div class="loginArea">
        <form method="POST" action="./refresh_password_action.php">
            <h1>Trocar senha</h1>
            <p class="warning">
                <?php if($_SESSION['warning']){
                    echo $_SESSION['warning'];
                    $_SESSION['warning'] = '';
                }
                ?>
            </p>
            
            <div class="label-float-login">
                <input type="text" autofocus name="nome" required placeholder=" "/>
                <label>Nome</label>
            </div>

            <div class="label-float-login">
                <input type="email" name="email" required placeholder=" "/>
                <label>Email</label>
            </div>

            <div class="label-float-login">
                <input id="confirm_nascimento" type="text" name="nascimento" required placeholder=" "/>
                <label>Data de nascimento</label>
            </div>


            <hr>

            <div class="label-float-login">
                <input type="password" name="senha" required placeholder=" "/>
                <label>Nova senha</label>
            </div>


            <div class="label-float-login">
                <input type="password" name="confirmar_senha" required placeholder=" "/>
                <label>confirmar nova senha</label>
            </div>


            <button type="submit" class="buttonLogin">Atualizar</button>

            <p class="signup">Lembrou da senha? <a href="<?=$base?>/login.php">Entrar</a></p>

        </form>
    </div>
</section>

<script src="https://unpkg.com/imask"></script>
<script>
    IMask(
        document.getElementById("confirm_nascimento"),
        {mask:'00/00/0000'}
    );

    document.title = "GoMoney - Recuperar senha";
</script>

<?php require_once './partials/footer.php'; ?>
<?php
    require_once './config.php';
    require_once './partials/headerLogin.php';

?>

<section class="loginSection">
    <div class="loginArea">
        <form method="POST" action="./login_action.php">
            <h1>Entrar <i class='bx bxs-lock'></i></h1>
            <p class="warning">
                <?php if($_SESSION['warning']){
                    echo $_SESSION['warning'];
                    $_SESSION['warning'] = '';
                }
                ?>
            </p>
            
            <div class="label-float-login">
                <input type="email" autofocus name="email" required placeholder=" "/>
                <label>Email</label>
            </div>

            <div class="label-float-login">
                <input type="password" name="senha" required placeholder=" "/>
                <label>Senha</label>
            </div>

            <p class="forgotPsw"><a href="<?=$base?>/forgot_password.php"> Esqecui minha senha</a></p>


            <button type="submit" class="buttonLogin">Entrar</button>

            <p class="signup">Não tem uma conta ainda? <a href="<?=$base?>/signup.php">Cadastre-se</a></p>

        </form>
    </div>
</section>

<script>document.title = "GoMoney - Login";</script>

<?php require_once './partials/footer.php'; ?>
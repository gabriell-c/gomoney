<?php
    require_once './config.php';
    require_once './partials/header.php';

?>

<section class="loginSection">
    <div class="loginArea">
        <form method="POST" action="<?=$base?>/update_user_action.php">
            <h1>Configurações</h1>
            <p class="warning">
                <?php if($_SESSION['warning']){
                    echo $_SESSION['warning'];
                    $_SESSION['warning'] = '';
                }
                ?>
            </p>

            <input type="hidden" value="<?=$_SESSION['login']['id']?>" name="id" />
            
            <div class="label-float-login">
                <input type="text" value="<?=$_SESSION['login']['nome']?>" autofocus name="nome" required placeholder=" "/>
                <label>Nome</label>
            </div>

            <div class="label-float-login">
                <input type="email" value="<?=$_SESSION['login']['email']?>" name="email" required placeholder=" "/>
                <label>Email</label>
            </div>

            <div class="label-float-login">
                <input id="confirm_nascimento" value="<?=$_SESSION['login']['nascimento']?>" type="text" name="nascimento" required placeholder=" "/>
                <label>Data de nascimento</label>
            </div>


            <hr>

            <div class="label-float-login">
                <input type="password" name="senha" placeholder=" "/>
                <label>Nova senha</label>
            </div>


            <div class="label-float-login">
                <input type="password" name="confirmar_senha" placeholder=" "/>
                <label>confirmar nova senha</label>
            </div>


            <button type="submit" class="buttonLogin">Atualizar</button>
        </form>
        <button type="submit" class="deleteButton">deletear conta</button>
        <div id="ModalAreaDelete" class="ModalAreaDelete">
            <div class="ModalBackDelete"></div>
            <form class="ModalFrontDelete" action="<?=$base?>/delete_user_action.php" method="POST" >
                <h2>Digite sua senha para confirmar</h2>
                <div class="label-float-login" style="width: 80%;">
                    <input required style="color: var(--Dark);" type="password" name="senhaDelete" placeholder=" "/>
                    <label>Senha</label>
                </div>
                <div class="buttonsModalDelete">
                    <button type="button" class="cancelDelete btn btn-dark mr-2">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="https://unpkg.com/imask"></script>
<script>
    IMask(
        document.getElementById("confirm_nascimento"),
        {mask:'00/00/0000'}
    );

    let openModalDelete = document.querySelector(".deleteButton");
    let buttonCancelDelete = document.querySelector(".cancelDelete")
    let backDelete = document.querySelector(".ModalBackDelete");

    openModalDelete.addEventListener("click", ()=>{
        document.getElementById("ModalAreaDelete").classList.toggle("show");
    });
    buttonCancelDelete.addEventListener("click", ()=>{
        document.getElementById("ModalAreaDelete").classList.toggle("show");
    });
    backDelete.addEventListener("click", ()=>{
        document.getElementById("ModalAreaDelete").classList.toggle("show");
    });

    document.title = 'GoMoney - configurações';

</script>

<?php require_once './partials/footer.php'; ?>
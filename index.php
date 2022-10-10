<?php
    require_once './config.php';

    if(!$_SESSION['login']){
        $_SESSION['warning'] = '';
        header('location: '.$base.'/login.php');
        exit;
    }

    require_once './partials/header.php';

    $id = filter_input(INPUT_GET, 'id');

    $dataID = [];

    if($id){
        $sqlID = $pdo->prepare("SELECT * FROM item WHERE id = :id");
        $sqlID->bindValue(":id", $id);
        $sqlID->execute();
        $dataID = $sqlID->fetch(PDO::FETCH_ASSOC);
    }

    $sql = $pdo->prepare("SELECT * FROM item WHERE id_user = :id_user");
    $sql->bindValue(":id_user", $_SESSION['login']['id']);
    $sql->execute();
    $date = $sql->fetchAll(PDO::FETCH_ASSOC);

    $sqlEntrada = $pdo->prepare("SELECT * FROM item WHERE tipo = :tipo AND id_user = :id_user");
    $sqlEntrada->bindValue(":tipo", 'Entrada');
    $sqlEntrada->bindValue(":id_user", $_SESSION['login']['id']);
    $sqlEntrada->execute();
    $dateEntrada = $sqlEntrada->fetchAll(PDO::FETCH_ASSOC);

    $sqlSDaida = $pdo->prepare("SELECT * FROM item WHERE tipo = :tipo AND id_user = :id_user");
    $sqlSDaida->bindValue(":tipo", 'Saída');
    $sqlSDaida->bindValue(":id_user", $_SESSION['login']['id']);
    $sqlSDaida->execute();
    $dateSaida = $sqlSDaida->fetchAll(PDO::FETCH_ASSOC);

    $entrada = 0.00;
    $saida = 0;
    $total = 0;

    for($d = 0; $d < count($dateEntrada); $d++){
        $entrada += str_replace(',', '',$dateEntrada[$d]['valor']);
    }

    for($s = 0; $s < count($dateSaida); $s++){
        $saida -= str_replace(',', '',$dateSaida[$s]['valor']);
    }
    for($d = 0; $d < count($date); $d++){
        $total = $entrada + $saida;
    }
?>

<main class="main">
    <div class="headerMain">
        <div class="box1">
            <div class="headerBox">
                Entrada <i class='bx bx-up-arrow-circle bx-sm' style="color: var(--Green);"></i>
            </div>
            
            <p>R$ <?=number_format($entrada, 2, ',', '.')?></p>
        </div>
        <div class="box1">
            <div class="headerBox">
                Saída <i class='bx bx-down-arrow-circle bx-sm'  style="color: var(--Red);"></i>
            </div>
            <p>R$ <?=number_format($saida, 2, ',', '.')?></p>
        </div>
        <div class="box2" style="background: <?=$total >= 0 ? 'var(--Green)' : 'var(--Red)'?>;">
            <div class="headerBox">
                Total <i class='bx bx-money-withdraw bx-sm'></i>
            </div>
            <p>R$ <?=number_format($total, 2, ',', '.')?></p>
        </div>
    </div>

    <div class="bodyArea">
        <div class="headerBody">
            <div class="headerTitle">Titulo</div>
            <div class="headerTitle">Categoria</div>
            <div class="headerTitle">Data</div>
            <div class="headerTitle">Valor</div>
            <div class="headerTitle">Editar/Excluir</div>
        </div>
        <?php for($d = 0; $d < count($date); $d++) : ?>
            <div class="ItemBody">
                <div class="bodyTitle"><?=$date[$d]['titulo']?></div>
                <div class="bodyTitle"><?=$date[$d]['tipo']?></div>
                <div class="bodyTitle"><?=date('d/m/Y', strtotime($date[$d]['data']))?></div>
                <div class="bodyTitle"><?=number_format(str_replace(',', '',$date[$d]['valor']), 2, ',', '.')?></div>
                <div class="bodyTitle"><a href="<?=$base?>?id=<?=$date[$d]['id']?>"><i class=" fa-solid fa-pen-to-square"></i></a><a href="./delete_item_action.php?id=<?=$date[$d]['id']?>"><i class="fa-solid fa-trash"></i></a></div>
            </div>
            <hr>
        <?php endfor ?>
        
    </div>

    <div id="ModalArea" class="ModalArea">
        <div class="closeModal">x</div>
        <div class="ModalBack"></div>
        <form class="ModalFront" method="post" action="./add_item_action.php" >
            
            <div class="label-float">
                <input type="text" autofocus name="titulo" required placeholder=" "/>
                <label>Titulo</label>
            </div>
            <div class="rowInput">
                <div class="label-float-select">
                    <select name="tipo">
                        <option value="Entrada">Entrada</option>
                        <option value="Saída">Saída</option>
                    </select>
                </div>
                <div class="label-float">
                    <input id="date" type="text" name="data" required placeholder=" "/>
                    <label>Data</label>
                </div>
            </div>
            <div class="label-float">
                <input inputmode="numeric" class="<?=$dataID ? '' : 'number' ?>" value="0,00" name="valor" required placeholder=" "/>
                <label>Valor</label>
            </div>

            <button class="addButton" type="submit">Adicionar+</button>
        </form>
    </div>


    <div id="ModalAreaEdit" class="ModalAreaEdit" style="display: <?=count($dataID) > 0 ? 'flex' : 'none' ?>;">
        <a href="<?=$base?>"><div class="closeModalEdit">x</div></a>
        <a class="modalBackArea" href="<?=$base?>"><div class="ModalBackEdit"></div></a>
        <form class="ModalFrontEdit" method="post" action="./edit_item_action.php" >
            
            <input type="hidden" name="id" value="<?=$id?>" >
            <div class="label-float">
                <input value="<?=$dataID['titulo']?>" type="text" autofocus name="novo_titulo" required placeholder=" "/>
                <label>Novo título</label>
            </div>
            <div class="rowInput">
                <div class="label-float-select">
                    <select name="novo_tipo">
                        <option value="Entrada">Entrada</option>
                        <option value="Saída">Saída</option>
                    </select>
                </div>
                <div class="label-float">
                    <input value="<?=date('d/m/Y', strtotime($dataID['data']))?>" id="newDate" type="text" name="newData" required placeholder=" "/>
                    <label>Nova data</label>
                </div>
            </div>
            <div class="label-float">
                <input inputmode="numeric" class="<?=$dataID > 0 ? 'number' : '' ?>" value="<?=str_replace(',', '',$dataID['valor'])?>" name="newValor" required placeholder=" "/>
                <label>Novo valor</label>
            </div>

            <button class="addButton" type="submit">Salvar <i class="fa-solid fa-floppy-disk"></i></button>
        </form>
    </div>
</main>

<script src="./simple-mask-money.js"></script>
<script src="https://unpkg.com/imask"></script>
<script>
    IMask(
        document.getElementById("date"),
        {mask:'00/00/0000'}
    );

    let input = SimpleMaskMoney.setMask('.number',{
        prefix: '',
        suffix: '',
        fixed: true,
        fractionDigits: 2,
        decimalSeparator: '.',
        thousandsSeparator: ',',
        emptyOrInvalid: () => {
        return this.SimpleMaskMoney.args.fixed
            ? `0${this.SimpleMaskMoney.args.decimalSeparator}00`
            : `_${this.SimpleMaskMoney.args.decimalSeparator}__`;
        }
    });

    let Modal = document.getElementById("ModalArea");
    let Back = document.querySelector(".ModalBack");
    let closeButton = document.querySelector(".closeModal")
    let openModal = document.querySelector(".openModal");

    Back.addEventListener("click", ()=>{
        Modal.style.display = 'none';
    });
    closeButton.addEventListener("click", ()=>{
        Modal.style.display = 'none';
    });
    openModal.addEventListener("click", ()=>{
        Modal.style.display = 'flex';
    });


</script>

<?php

    require_once './partials/footer.php';

?>
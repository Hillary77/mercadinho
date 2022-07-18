<?php
include "../../_app/config.php";
include "../../header.inc.php";

//Selecionar o id do usuario para puxar informações

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$sth = $pdo->query("SELECT * FROM usuario WHERE id=$id");
$row = $sth->fetch();
?>

<!--Formulario para editar-->

<form method="POST" action="../update.php ">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Nome</label>
            <input type="text" class="form-control" value="<?= $row['nome'] ?>" name="nome">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Último nome</label>
            <input type="text" class="form-control"  value="<?= $row['ultimonome'] ?>"name="ultimonome">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" value="<?= $row['email'] ?>" name="email">
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress">Endereço</label>
            <input type="text" class="form-control" value="<?= $row['endereco'] ?>" name="endereco">
        </div>  

        <div class="form-group col-md-4">
            <label for="inputCity">Cidade</label>
            <input type="text" class="form-control" value="<?= $row['cidade'] ?>" name="cidade">
        </div>

        <div class="form-group col-md-4">
            <label for="inputEstado">Data de nascimento</label>
            <input  type="date" class="form-control" value="<?= $row['data'] ?>" name="data">
        </div>

        <div class="form-group col-md-4">
            <label for="inputCEP">CEP</label>
            <input type="text" class="form-control" value="<?= $row['cep'] ?>" name="cep">
        </div>


    </div>
    <button type="submit" class="btn btn-primary mb-5" >Editar</button>
</form>


<?php
include "../../footer.inc.php";
?>










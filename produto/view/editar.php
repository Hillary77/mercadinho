<?php
include "../../_app/config.php";
include "../../header.inc.php";

//Selecionar o id do usuario para puxar informações

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$sth = $pdo->query("SELECT * FROM produto WHERE id=$id");
$row = $sth->fetch();
?>

<!--Formulario para editar-->

<form method="POST" action="../update.php">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Nome</label>
            <input type="text" class="form-control" value="<?= $row['nome_produto'] ?>"name="nome_produto">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Descrição do Produto</label>
            <input type="text" class="form-control"  value="<?= $row['descricao'] ?>"name="descricao">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Valor(R$)</label>
            <input type="text" class="form-control" value="<?= $row['valor'] ?>"name="valor">
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress">Estoque</label>
            <input type="text" class="form-control" value="<?= $row['estoque'] ?>"name="estoque">
        </div>  

        <div class="form-group col-md-6">
            <label for="imagem">Imagem</label>
            <input type="file" class="form-control" value="<?= $row['imagem'] ?>"name="imagem">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mb-5" >Editar</button>
</form>




<?php
include "../../footer.inc.php";
?>










<?php
include "../../_app/config.php";
include "../../header.inc.php";

//Traz o id do produto no botão editar em método GET 
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
//Selecionar o id do cliente para puxar informações do banco de dados 
$sth = $pdo->query("SELECT * FROM produto WHERE id=$id");
$row = $sth->fetch();
?>

<!--Formulario para editar-->

<form method="POST" action="../update.php">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Nome</label>
            <input type="text" class="form-control" value="<?= $row['nome_produto'] ?>"name="nome_produto"><!--VALUE CHAMA CADA DADOS DO DB-->
        </div>
        <div class="form-group col-md-6">
            <label>Descrição do Produto</label>
            <input type="text" class="form-control"  value="<?= $row['descricao'] ?>"name="descricao">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Valor(R$)</label>
            <input type="text" class="form-control" value="<?= $row['valor'] ?>"name="valor">
        </div>
        <div class="form-group col-md-6">
            <label>Estoque</label>
            <input type="text" class="form-control" value="<?= $row['estoque'] ?>"name="estoque">
        </div>  

        <div class="form-group col-md-6">
            <label for="imagem">Imagem</label>
            <input type="file" class="form-control" value="<?= $row['imagem'] ?>"name="imagem">
        </div>
    </div>
      <div class="text-center" colspan="6">
    <button type="submit" class="btn btn-primary mb-2">Editar</button>
    </div>
</form>




<?php
include "../../footer.inc.php";
?>










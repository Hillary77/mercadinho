<?php
//REPONSÁVEL POR TRAZER O NAVEBAR PARA TODAS AS ATAS VIEW.
include "../../header.inc.php";
//RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO BANCO DE DADOS
include "../../_app/config.php";
?>

<!--Ini form-->
<form method="POST" action="../insert.php" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Nome</label>
            <input type="text" class="form-control" placeholder="Nome do produto" name="nome_produto">
        </div>
        <div class="form-group col-md-6">
            <label>Descrição do Produto</label>
            <input type="text" class="form-control" placeholder="Descrição do Produto" name="descricao">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Valor(R$)</label>
            <input type="text"  class="form-control" placeholder="00,00" name="valor">
        </div>
        <div class="form-group col-md-6">
            <label>Estoque</label>
            <input type="text" class="form-control" placeholder="Número em estoque" name="estoque">
        </div>  

        <div class="form-group col-md-6">
            <label for="imagem">Imagem</label>
            <input type="file" class="form-control" name="imagem">
        </div>  
    </div>
    <button type="submit" class="btn btn-primary mb-2">Salvar</button>
</form>
<!--Fim form-->

<?php
//TRAZ A BASE DO NAVBAR
include "../../footer.inc.php";
?>


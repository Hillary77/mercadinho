<?php
include "../../header.inc.php";
include "../../_app/config.php";
?>
<!--View para usuario-->
 <!--Ini form-->
<form method="POST" action="../insert.php" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Nome</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Nome do produto" name="nome_produto">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Descrição do Produto</label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="Descrição do Produto" name="descricao">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Valor(R$)</label>
            <input type="text"  class="form-control" id="inputEmail4" placeholder="00,00" name="valor">
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress">Estoque</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Número em estoque" name="estoque">
        </div>  

        <div class="form-group col-md-6">
            <label for="imagem">Imagem</label>
            <input type="file" class="form-control" id="inputAddress" placeholder="Imagem" name="imagem">
        </div>  


    </div>
    <button type="submit" class="btn btn-primary mb-2">Entrar</button>
</form>
<!--Fim form-->

<?php
include "../../footer.inc.php";
?>


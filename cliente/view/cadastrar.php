<?php
include "../../header.inc.php";
include "../../_app/config.php";

?>
 <!--Ini form-->
<form method="POST" action="../insert.php">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Nome</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Nome" name="nome">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Último nome</label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="Último nome" name="ultimonome">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress">Endereço</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Rua dos Bobos, nº 0" name="endereco">
        </div>  

        <div class="form-group col-md-4">
            <label for="inputCity">Cidade</label>
            <input type="text" class="form-control" id="inputCity"  placeholder="Cidade" name="cidade">
        </div>

        <div class="form-group col-md-4">
            <label for="inputEstado">Data de nascimento</label>
            <input  type="date" class="form-control"  name="data" >
        </div>

        <div class="form-group col-md-4">
            <label for="inputCEP">CEP</label>
            <input type="text" class="form-control" id="inputCEP"  placeholder="CEP" name="cep">
        </div>

    </div>
    <button type="submit" class="btn btn-primary mb-2">Entrar</button>
</form>
<!--Fim form-->

<?php
include "../../footer.inc.php";
?>

<?php
//REPONSÁVEL POR TRAZER O NAVEBAR PARA TODAS AS ATAS VIEW.
include "../../header.inc.php";
//RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO BANCO DE DADOS
include "../../_app/config.php";
//
?>
 <!--INI FORM "sempre lembrar de colocar método e o direcionamento da página"-->
<form method="POST" action="../insert.php">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Nome:</label>
            <input type="text" class="form-control" placeholder="Nome" name="nome">
        </div>
        <div class="form-group col-md-6">
            <label>Último nome:</label>
            <input type="text" class="form-control" placeholder="Último nome" name="ultimonome">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Email:</label>
            <input type="email" class="form-control" placeholder="Email" name="email">
        </div>
        <div class="form-group col-md-6">
            <label>Endereço:</label>
            <input type="text" class="form-control" placeholder="Rua dos Bobos, nº 0" name="endereco">
        </div>  

        <div class="form-group col-md-4">
            <label>Cidade:</label>
            <input type="text" class="form-control" placeholder="Cidade" name="cidade">
        </div>

        <div class="form-group col-md-4">
            <label>Data de nascimento:</label>
            <input type="date" class="form-control" name="data" >
        </div>

        <div class="form-group col-md-4">
            <label>CEP:</label>
            <input type="text" class="form-control" placeholder="CEP" name="cep">
        </div>

    </div>
    <div class="text-center" colspan="6">
    <button type="submit" class="btn btn-primary mb-2">Salvar</button>
    </div>
</form>
<!--Fim form-->

<?php
//TRAZ A BASE DO NAVBAR
include "../../footer.inc.php";
?>

<?php
//RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO BANCO DE DADOS
//Sempre no início da página
include "../../_app/config.php";
include "../../header.inc.php";

//Traz o id do cliente no botão editar em método GET 
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
//Selecionar o id do cliente para puxar informações do banco de dados 
$sth = $pdo->query("SELECT * FROM usuario WHERE id=$id");
$row = $sth->fetch();
?>

<!--Formulario para editar-->

<form method="POST" action="../update.php ">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Nome</label>
            <input type="text" class="form-control" value="<?= $row['nome'] ?>" name="nome"> <!--VALUE CHAMA CADA DADOS DO DB-->
        </div>
        <div class="form-group col-md-6">
            <label>Último nome</label>
            <input type="text" class="form-control"  value="<?= $row['ultimonome'] ?>"name="ultimonome">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" class="form-control" value="<?= $row['email'] ?>" name="email">
        </div>
        <div class="form-group col-md-6">
            <label>Endereço</label>
            <input type="text" class="form-control" value="<?= $row['endereco'] ?>" name="endereco">
        </div>  

        <div class="form-group col-md-4">
            <label>Cidade</label>
            <input type="text" class="form-control" value="<?= $row['cidade'] ?>" name="cidade">
        </div>

        <div class="form-group col-md-4">
            <label>Data de nascimento</label>
            <input  type="date" class="form-control" value="<?= $row['data'] ?>" name="data">
        </div>

        <div class="form-group col-md-4">
            <label>CEP</label>
            <input type="text" class="form-control" value="<?= $row['cep'] ?>" name="cep">
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-primary mb-5" >Editar</button>
    </div>
</form>


<?php
include "../../footer.inc.php";
?>










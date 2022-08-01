<?php

/*
 * RESPONSÁVEL POR EDITAR AS INFORMAÇÕES DO DB
 */
include '../_app/config.php';

//Recupera as informações preenchidas no formulário que foi trago pelo metódo POST.
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//Faz update de cada id das informações no Banco de dados
$sql = "UPDATE usuario SET nome=:nome,ultimonome=:ultimonome,email=:email,endereco=:endereco,cidade=:cidade,data=:data,cep=:cep WHERE id=:id";
$update = $pdo->prepare($sql);

if ($update->execute($dados)) {
    header("Location: view/index.php");
    echo'<p>Editado com sucesso</p>';
} else {
    echo'<p>Não foi possível EDITAR!</p>';
}
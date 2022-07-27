<?php
/*
 * RESPONSÁVEL POR EDITAR AS INFORMAÇÕES DO DB
 */
include '../_app/config.php';

//recupera as informações do formulario
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


//Gravo as inforações no DB
$sql = "UPDATE usuario SET nome=:nome,ultimonome=:ultimonome,email=:email,endereco=:endereco,cidade=:cidade,data=:data,cep=:cep WHERE id=:id";
$update = $pdo->prepare($sql);
$update->execute($dados);

if (!$update->execute($dados)) {
    echo'<p>Não foi possível EDITAR!</p>';
} else {
    header("Location: view/index.php");
    echo'<p>Editado com sucesso</p>';
}
<?php
/*
 * RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO DB
 */
include "../_app/config.php";

//Recupera as informações do formulario
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//Guardar as informções no Db
$sql = "INSERT INTO usuario (nome, ultimonome, email, endereco, cidade, data, cep) VALUES (:nome, :ultimonome, :email, :endereco, :cidade, :data, :cep)";
$insert = $pdo->prepare($sql);
$insert->execute($dados);

if (!$dados) {
    echo'<p>Não foi possível cadastrar</p>';
} else {
    header("Location: view/index.php");
    echo'<p>Cadastrado com sucesso</p>';
}


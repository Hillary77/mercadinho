<?php
/*
 * RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO BANCO DE DADOS
 */
include "../_app/config.php";

//Recupera as informações preenchidas no formulário que foi trago pelo metódo POST.
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//Guardar/Insere as informções do formulário no Banco de dados.
$sql = "INSERT INTO usuario (nome, ultimonome, email, endereco, cidade, data, cep) VALUES (:nome, :ultimonome, :email, :endereco, :cidade, :data, :cep)";
$insert = $pdo->prepare($sql);
$insert->execute($dados);

//Depois de executar corretamente, direciona os dados a tabela.
if ($insert) {
    header("Location: view/index.php");
    echo'<p>Cadastrado com sucesso</p>';
} else {
    echo'<p>Não foi possível cadastrar</p>';
}

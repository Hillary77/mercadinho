<?php

/*
 * RESPONSÁVEL POR EDITAR AS INFORMAÇÕES DO DB
 */
include "../_app/config.php";

//recupera as informçações do formulario
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$dados['public'] = date('Y-m-d H:m:i');
$dados['valor'] = str_replace(',', '.', $dados['valor']);

if (empty($dados['imagem'])) {
    echo "<script <img src='../_img/'" . $dados['imagem'] . "'' style='width: 90px; height: 100px;' alt='...' class='img-thumbnail'></script>";
    $file = getimagesize($dados['imagem']);
    $tamanho = filesize($dados['imagem']);

    $novoDestino = "../_img" . uniqid('', true) . '.';
    move_uploaded_file($dados['imagem'], $novoDestino);
}

//gravo as inforações no DB
$update = $pdo->prepare("UPDATE produto SET nome_produto=:nome_produto,descricao=:descricao,valor=:valor,estoque=:estoque,imagem=:imagem,public=:public WHERE id= '" . $dados['id'] . "'");
$update->bindValue('nome_produto', $dados['nome_produto'], PDO::PARAM_STR);
$update->bindValue('descricao', $dados['descricao'], PDO::PARAM_STR);
$update->bindValue('valor', $dados['valor'], PDO::ATTR_FETCH_TABLE_NAMES);
$update->bindValue('estoque', $dados['estoque'], PDO::PARAM_STR);
$update->bindValue('public', $dados['public'], PDO::PARAM_STR);
$update->bindValue('imagem', $dados['imagem'], PDO::PARAM_STR);
$update->execute();

if (!$update) {
    echo'<p>Não foi possível cadastrar</p>';
} else {
    header("Location: view/index.php");
    echo'<p>Cadastrado com sucesso</p>';
}

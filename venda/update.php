<?php

// RESPONSÁVEL POR EDITAR AS INFORMAÇÕES DO DB

include "../_app/config.php";

//Recupera as informações do formulario
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$codigo = $dados['codigo'];

//Deleta todos os produtos checados, só deixando o codigo da venda
$sql = "DELETE FROM vendas WHERE codigo = :codigo";
$delete = $pdo->prepare($sql);
$delete->bindParam(':codigo', $codigo, PDO::PARAM_INT);
$delete->execute();

//filtra o array e deixa somente o que tem 1
$check = array_filter($dados['check']);

//Insere todos os produtos que tem 1 na mesma venda
foreach ($check as $key => $value) {
    $insert = $pdo->prepare("INSERT INTO vendas (codigo, cliente_id, produto_id, valor, quantidade, public) VALUES (:codigo, :cliente_id, :produto_id, :valor, :quantidade, :public)");
    $insert->bindValue('codigo', $codigo, PDO::PARAM_INT);
    $insert->bindValue('cliente_id', $dados['cliente_id'], PDO::PARAM_INT);
    $insert->bindValue('produto_id', $dados['produto_id'][$key], PDO::PARAM_INT);
    $insert->bindValue('valor', $dados['valor'][$key], PDO::ATTR_FETCH_TABLE_NAMES);
    $insert->bindValue('quantidade', $dados['quantidade'][$key], PDO::PARAM_INT);
    $insert->bindValue('public', date('Y-m-d H:m:i'), PDO::PARAM_STR);
    $insert->execute();
}

if ($insert) {
    header("Location: view/index.php");
} else {
    echo'<p>Não foi possível Editar</p>';
}















    
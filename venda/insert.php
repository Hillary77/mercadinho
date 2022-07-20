<?php

/*
 * RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO DB
 */
include "../_app/config.php";

//Recupera as informações do formulario
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$dados['public'] = date('Y-m-d H:i:m');
unset($dados['salvar']);

$i = 3;
$i++;
$cliente = $dados['cliente_id'];
$produtos = $dados['produto_id'];
$public = $dados['public'];
  
  
foreach ($produtos as $key => $value) {
    $sql = $pdo->query("SELECT id, valor FROM produto WHERE id=$value");

    foreach ($sql->fetchAll() as $v) {
        $codigo = $i;
        $insert = $pdo->prepare("INSERT INTO vendas (codigo, checks, cliente_id, produto_id, valor, quantidade, public) VALUES (:codigo, :checks, :cliente_id, :produto_id, :valor, :quantidade, :public)");
        $insert->bindValue('codigo', $codigo, PDO::PARAM_INT);
        $insert->bindValue('checks', $v['id'], PDO::PARAM_INT);
        $insert->bindValue('cliente_id', $cliente, PDO::PARAM_INT);
        $insert->bindValue('produto_id', $v['id'], PDO::PARAM_INT);
        $insert->bindValue('valor', $v['valor'], PDO::ATTR_FETCH_TABLE_NAMES);
        $insert->bindValue('quantidade',array_shift($dados['quantidade']), PDO::PARAM_INT);
        $insert->bindValue('public', $public, PDO::PARAM_STR);
        $insert->execute();
    }
}

if (!$dados) {
    echo'<p>Não foi possível cadastrar</p>';
} else {
    header("Location: view/index.php");
    echo'<p>Cadastrado com sucesso</p>';
}







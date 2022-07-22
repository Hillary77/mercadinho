<?php

/*
 * RESPONSÁVEL POR EDITAR AS INFORMAÇÕES DO DB
 */
include "../_app/config.php";

//Recupera as informações do formulario
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$dados['public'] = date('Y-m-d H:m:i');
$checks = $dados['produto_id'];


foreach ($dados['id'] as $key => $value) {
    if (!empty($value)) {
        $update = $pdo->prepare("UPDATE vendas SET cliente_id=:cliente_id,quantidade=:quantidade WHERE id = '$value'");
        $update->bindValue('cliente_id', $dados['cliente_id'], PDO::PARAM_INT);
        $update->bindValue('quantidade', array_shift($dados['quantidade']), PDO::PARAM_INT);
        //$update->execute();
        echo"<pre>";
        var_dump($update);
    }else{
        $insert = $pdo->prepare("INSERT INTO vendas (codigo, checks, cliente_id, produto_id, valor, quantidade, public) VALUES (:codigo, :checks, :cliente_id, :produto_id, :valor, :quantidade, :public)");
        $insert->bindValue('codigo', implode(",",$dados['codigo']), PDO::PARAM_STR);
        $insert->bindValue('checks', array_pop($checks), PDO::PARAM_INT);
        $insert->bindValue('cliente_id', $dados['cliente_id'], PDO::PARAM_STR);
        $insert->bindValue('produto_id', array_pop($dados['produto_id']), PDO::PARAM_INT);
        $insert->bindValue('valor', array_pop($dados['valor']), PDO::ATTR_FETCH_TABLE_NAMES);
        $insert->bindValue('quantidade', array_pop($dados['quantidade']), PDO::PARAM_INT);
        $insert->bindValue('public', $dados['public'], PDO::PARAM_STR);
        //$insert->execute();
        echo"<pre>";
        var_dump($insert);
    }
}


//if (!$dados) {
//    echo'<p>Não foi possível Editar</p>';
//} else {
//    header("Location: view/index.php");
//}





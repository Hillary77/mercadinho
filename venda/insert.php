<?php

/*
 * RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO DB
 */
include "../_app/config.php";

//Recupera as informações preenchidas no formulário que foi trago pelo metódo POST.
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$dados['public'] = date('Y-m-d H:i:m');
unset($dados['salvar']);

 
//Gera codigo da venda
$i = 2;
$i++;

//$dados['produto_id'], se torna condição pelo select da tabela produto. 
foreach ($dados['produto_id'] as $key => $value) {
    //Traz/Gera dados da tabela produto com a condição $dados['produto_id']
    $sql = $pdo->query("SELECT id, valor FROM produto WHERE id=$value");

    foreach ($sql->fetchAll() as $v) {
        $codigo = $i;
        //Guardar/Insere as informações no Banco de dados.
        $insert = $pdo->prepare("INSERT INTO vendas (codigo, cliente_id, produto_id, valor, quantidade, public) VALUES (:codigo, :cliente_id, :produto_id, :valor, :quantidade, :public)");
        $insert->bindValue('codigo', $codigo, PDO::PARAM_INT);
        $insert->bindValue('cliente_id', $dados['cliente_id'], PDO::PARAM_INT);
        $insert->bindValue('produto_id', $v['id'], PDO::PARAM_INT);
        $insert->bindValue('valor', $v['valor'], PDO::ATTR_FETCH_TABLE_NAMES);
        $insert->bindValue('quantidade', array_shift($dados['quantidade']), PDO::PARAM_INT);
        $insert->bindValue('public', $dados['public'], PDO::PARAM_STR);
        $insert->execute();
    }
}
//Depois de executar corretamente, direciona os dados a tabela.
if ($insert) {
    header("Location: view/index.php");
    echo'<p>Cadastrado com sucesso</p>';
} else {
    echo'<p>Não foi possível cadastrar</p>';
}







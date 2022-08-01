<?php

/*
 * RESPONSÁVEL POR EDITAR AS INFORMAÇÕES DO DB
 */
include "../_app/config.php";

//recupera as informçações do formulario
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
//Iserir dados de fora dentro do array
$dados['public'] = date('Y-m-d H:m:i');
$dados['valor'] = str_replace(',', '.', $dados['valor']);

if (empty($dados['imagem'])) {
    echo "<script <img src='../_img/'" . $dados['imagem'] . "'' style='width: 90px; height: 100px;' alt='...' class='img-thumbnail'></script>";
    //getimagesize - Obtém o tamanho de uma imagem
    $file = getimagesize($dados['imagem']);
    //filesize - Obtém o tamanho do arquivo
    $tamanho = filesize($dados['imagem']);
    //fopen - Abre um arquivo ou URL
    //fread - Lê arquivo
    $imagem = addslashes(fread(fopen($dados['imagem']), $tamanho));

    //MONTA O CAMINHO DO NOVO DESTINO DA IMAGEM
    $novoDestino = "../_img";
    //move_uploaded_file — Move um arquivo enviado para uma nova localização
    move_uploaded_file($dados['imagem']['tmp_name'], $novoDestino, $imagem);
}

//Faz update de cada id das informações no Banco de dados
$update = $pdo->prepare("UPDATE produto SET nome_produto=:nome_produto,descricao=:descricao,valor=:valor,estoque=:estoque,imagem=:imagem,public=:public WHERE id= '" . $dados['id'] . "'");
$update->bindValue('nome_produto', $dados['nome_produto'], PDO::PARAM_STR);
$update->bindValue('descricao', $dados['descricao'], PDO::PARAM_STR);
$update->bindValue('valor', $dados['valor'], PDO::ATTR_FETCH_TABLE_NAMES);
$update->bindValue('estoque', $dados['estoque'], PDO::PARAM_STR);
$update->bindValue('public', $dados['public'], PDO::PARAM_STR);
$update->bindValue('imagem', $dados['imagem'], PDO::PARAM_STR);
$update->execute();

//Depois de executar corretamente, direciona os dados a tabela.
if ($update) {
    header("Location: view/index.php");
    echo'<p>Cadastrado com sucesso</p>';
} else {
    echo'<p>Não foi possível cadastrar</p>';
}

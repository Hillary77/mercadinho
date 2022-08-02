<?php
/*
 * RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO DB
 */
include "../_app/config.php";
//Recupera as informações preenchidas no formulário que foi trago pelo metódo POST.
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
//Iserir dados de fora dentro do array
$dados['imagem'] = $_FILES['imagem']['name']; //$_FILES — Variáveis ​​de Upload de Arquivos HTTP
$dados['public'] = date('Y-m-d H:m:i');
$dados['valor'] = str_replace(',', '.', $dados['valor']);

if (empty($dados['imagem'])) {
    //getimagesize - Obtém o tamanho de uma imagem
    $file = getimagesize($dados['imagem']);
    //filesize - Obtém o tamanho do arquivo
    $tamanho = filesize($dados['imagem']);
    //fopen - Abre um arquivo ou URL
    //fread - Lê arquivo
    $imagem = addslashes(fread(fopen($dados['imagem'], 'r'), $tamanho));

    //MONTA O CAMINHO DO NOVO DESTINO DA IMAGEM
    $novoDestino = "../_img";
    move_uploaded_file($dados['imagem'], $novoDestino, $imagem);
}

//Guardar/Insere as informções do formulário no Banco de dados.
$sql = "INSERT INTO produto (nome_produto, descricao, valor, estoque, imagem, public) VALUES (:nome_produto, :descricao, :valor, :estoque, :imagem, :public)";
$insert = $pdo->prepare($sql);
$insert->execute($dados);

//Depois de executar corretamente, direciona os dados a tabela.
if ($insert) {
    header("Location: view/index.php");
    echo'<p>Cadastrado com sucesso</p>';
} else {
    echo'<p>Não foi possível cadastrar</p>';
}
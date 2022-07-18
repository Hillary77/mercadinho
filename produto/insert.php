<?php

/*
 * RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO DB
 */
include "../_app/config.php";

//Recupera as informações do formulario
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//Iserir dados a fora no array
$dados['imagem'] = $_FILES['imagem']['name'];
$dados['public'] = date('Y-m-d H:m:i');
$dados['valor'] = str_replace(',', '.', $dados['valor']);

if (empty($dados['imagem'])) {
    echo "<script <img src='../_img/'" . $dados['imagem'] . "'' style='width: 90px; height: 100px;' alt='...' class='img-thumbnail'></script>";
    $file = getimagesize($dados['imagem']);
    $tamanho = filesize($dados['imagem']);
    $imagem = addslashes(fread(fopen($dados['imagem']), $tamanho));

    //MONTA O CAMINHO DO NOVO DESTINO
    $novoDestino = "../_img" . uniqid('', true) . '.';
    move_uploaded_file($dados['imagem']["tmp_name"], $novoDestino, $imagem);
}

//Guardar as informções no Db
$sql = "INSERT INTO produto (nome_produto, descricao, valor, estoque, imagem, public) VALUES (:nome_produto, :descricao, :valor, :estoque, :imagem, :public)";
$stmt = $pdo->prepare($sql);
$stmt->execute($dados);

if (!$dados) {
    echo'<p>Não foi possível cadastrar</p>';
} else {
    header("Location: view/index.php");
    echo'<p>Cadastrado com sucesso</p>';
}
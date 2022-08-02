<?php
include "../../header.inc.php";
include '../../_app/config.php';

$nomes = filter_input(INPUT_POST, 'pesquisa', FILTER_DEFAULT);
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($nomes) {
   //Traz dados e indica quais dados devem ser pesquisados
    $sql = "SELECT id, nome_produto, descricao, valor, estoque, public, imagem FROM produto WHERE nome_produto LIKE '%$nomes%'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!--ini listagem-->
    <div class="container">
        <table class="table table-bordered table-striped ">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>#</th>
                    <th>Nome</th>
                    <th>Ultimo nome</th>
                    <th>Descrição do produto</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
    <?php
    $i = 0;
    foreach ($rows as $row) {
        extract($row);
        $i++;

        echo"<tr>";
        echo"<td>$i</td>";
        echo"<td>$nome_produto</td>";
        echo"<td>$descricao</td>";
        echo"<td>$valor</td>";
        echo"<td>$estoque</td>";
        echo"<td><img src='../_img/$imagem'  style='width: 100px; height: 100px;'alt='...' class='img-thumbnail'></td>";
        echo"<td><a type='button' href='editar.php?id=$id'class='btn btn-outline-success  btn-sn'><i class='bi bi-pencil-square'></i></a><br>"; //editar
        echo"<a class='btn btn-outline-danger  btn-sn' href=?id=$id><i class='bi bi-trash3-fill'></i></a></td>"; //excluir
        echo"</tr>";
    }
}
?>

    </table>
</div>

<?php
include "../../footer.inc.php";
?>
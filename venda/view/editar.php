<?php
include "../../_app/config.php";
include "../../header.inc.php";

//padrão para facilidade entendimento
$codigo = filter_input(INPUT_GET, 'venda', FILTER_VALIDATE_INT);
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $sql = "DELETE FROM vendas WHERE id=:id";
    $delete = $pdo->prepare($sql);
    $delete->bindParam(':id', $id, PDO::PARAM_INT);

    if ($delete->execute()) {
        header("Location: index.php");
        echo 'id' . $id . ' EXCLUIDO com sucesso!';
    } else {
        echo'<p>Não foi possível EXCLUIR!</p>';
    }
}
?>

<div class="container">
    <!--ini select cliente-->
    <form class="text-center" method="POST" action="../update.php">
        <p><select class="custom-select" id="inputGroupSelect02" name="cliente_id" >
                <?php
                $dados_c = $pdo->query("SELECT u.id, u.nome, u.ultimonome, v.cliente_id "
                        . "FROM usuario as u LEFT JOIN vendas as v ON u.id = v.cliente_id AND codigo = $codigo");
                $dados = $dados_c->fetchAll();
                foreach ($dados as $row) {
                    extract($row);
                    echo"<option value='$id'>$id - $nome $ultimonome</option>";
                }
                ?>
            </select>
        </p>
        <!--fim select cliente-->

        <!--ini tabela produto-->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>#</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade à ser retirada</th>
                </tr>
            </thead>

            <?php
            $dados_p = $pdo->query("SELECT p.id, p.nome_produto, v.id as id_venda, v.codigo, v.checks, p.valor, v.produto_id, v.quantidade "
                    . "FROM produto as p LEFT JOIN vendas as v ON p.id = v.produto_id AND codigo = $codigo");
            $rows = $dados_p->fetchAll();

            foreach ($rows as $row) {
                extract($row);
                echo"<input type='hidden' name='codigo[]' value='" . $codigo . "'>";
                echo"<input type='hidden' name='valor[]' value='" . $valor . "'>";
                echo"<input type='hidden' name='id[]' value='" . $id_venda . "'>";
                echo"<tr>";
                if ($checks == $id) {
                    echo"<td><input type='checkbox' name='produto_id[]' value='" . $id . "' checked></td>";
                } else {
                    echo"<td><input type='checkbox' name='produto_id[]' value='" . $id . "'></td>";
                }
                echo"<td>$nome_produto</td>";
                echo"<td>" . number_format($valor, 2, ',', '.') . "</td>";
                echo"<td><input type='number' name='quantidade[]' value='" . $quantidade . "'></td>";
                echo"</tr>";
            }
            ?>

            <tr>
                <td class="text-center" colspan="6">
                    <button type="submit" class="btn btn-primary mb-1" >Editar</button>
                </td>
            </tr>
        </table>
        <!--fim tabela produto-->
    </form>
</div>

<?php
include "../../footer.inc.php";


<?php
include "../../_app/config.php";
include "../../header.inc.php";
//
//padrão para facilidade entendimento
$codigo = filter_input(INPUT_GET, 'venda', FILTER_VALIDATE_INT);

//select da tabela vendas, para editar venda 
$vendas = $pdo->query("SELECT * FROM vendas WHERE codigo = $codigo");
$venda = $vendas->fetchAll()[0];
?>

<div class="container">
    <!--ini select cliente-->
    <form class="text-center" method="POST" action="../update.php">
        <p>
            <select class="custom-select" name="cliente_id" >
                <?php
                //select da tabela usuario, para usuario editar cliente
                $cliente = $pdo->query("SELECT * FROM usuario");
                foreach ($cliente->fetchAll() as $row) {
                    extract($row);
                    //if else de uma linha para selecionar cliente listados na venda 
                    $selected = $venda['cliente_id'] == $id ? 'selected' : null;
                    echo"<option value='$id' $selected>$id - $nome $ultimonome</option>";
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
            //Gera dados da tabela produto para editar os produtos
            $dados_vendas = $pdo->query("SELECT v.id as id_venda, v.codigo, v.produto_id, v.quantidade, p.id, p.nome_produto, p.valor FROM vendas as v RIGHT JOIN produto as p ON v.produto_id = p.id  AND codigo = $codigo");
            $rows = $dados_vendas->fetchAll();

            foreach ($rows as $row) {
                extract($row);
                //if else de uma linha para checar o produto listados na venda  
                $checked = $id == $produto_id ? 'checked' : 'null';

                //Dados da view editar
                echo"<tr>";
                echo"<input type='hidden' name='check[$id]' value='0'>";
                echo"<td><input type='checkbox' name='check[$id]' value='1' $checked></td>";
                echo"<td> $nome_produto</td>";
                echo"<td>" . number_format($valor, 2, ',', '.') . "</td>";
                echo"<td><input type='number' name='quantidade[$id]' value='" . $quantidade . "'></td>";
                echo"</tr>";
                //Dados da tabela produto ocultos
                echo"<input type='hidden' name='codigo[$id]' value='" . $codigo . "'>";
                echo"<input type='hidden' name='produto_id[$id]' value='" . $id . "'>";
                echo"<input type='hidden' name='valor[$id]' value='" . $valor . "'>";
            }
            ?>
             <tr>
                <td class="text-center" colspan="6">
                    <button type="submit"  class="btn btn-primary mb-1" >Editar</button>
                </td>
            </tr>
        </table>
        <!--fim tabela produto-->
    </form>
</div>

<?php
include "../../footer.inc.php";


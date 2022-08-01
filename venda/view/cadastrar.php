<?php
//REPONSÁVEL POR TRAZER O NAVEBAR PARA TODAS AS ATAS VIEW.
include "../../header.inc.php";
//RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO BANCO DE DADOS
include "../../_app/config.php";
?>

<div class="container">
    <!--Selecionar o cliente-->
    <form class="text-center" method="POST" action="../insert.php">
        <p>
            <select class="custom-select" name="cliente_id" >
                <?php
                //Gera/traz dados da tabela usuario.
                $cliente = $pdo->query('SELECT * FROM usuario ORDER BY id, nome, ultimonome');
                $rows = $cliente->fetchAll();

                //Faz o loop buscando clientes no listar, e trazendo devolta pra cá
                foreach ($rows as $row) {
                    extract($row);
                    echo"<option value='$id'>$id - $nome $ultimonome</option>";
                }
                ?>
            </select>
        </p>

        <!--ini tabela produto-->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Quantidade à ser retirada</th>
                </tr>
            </thead>            
            <tbody>
                <?php
                //Gera/traz dados dos produtos
                $produto = $pdo->query('SELECT * FROM produto ORDER BY nome_produto');
                $dados = $produto->fetchAll();

                foreach ($dados as $row) {
                    extract($row);
                    echo"<tr>";
                    echo"<td><input type='checkbox' name='produto_id[]' id='$id' value='$id'></td>";
                    echo"<td>$nome_produto</td>";
                    echo"<td class='text-right'>" . number_format($valor, 2, ',', '.') . "</td>";
                    echo"<td>$estoque</td>";
                    echo"<td><input type='number' name='quantidade[]'></td>";
                    echo"</tr>";
                }
                ?>
                <tr>
                    <td class="text-center" colspan="6">
                        <button type="submit" class="btn btn-primary mb-2">Salvar</button> <!--Botão Salvar-->
                    </td>
                </tr>    
            </tbody>
        </table>
        <!--Fim tabela produto-->
    </form>
</div>
<!-- Fim do selecionar o cliente->
<?php
include "../../footer.inc.php";

<?php
include "../../header.inc.php";
include "../../_app/config.php";
?>


<div class="container">
    <!--Selecionar o cliente no html-->
    <form class="text-center" method="POST" action="../insert.php">
        <p>
            <select class="custom-select" id="inputGroupSelect02" name="cliente_id" >

                <?php
                //Chama os dados da tabela cliente para o selecionar.
                $dados_c = $pdo->query('SELECT id, nome, ultimonome FROM usuario ORDER BY id, nome, ultimonome');
                $rows = $dados_c->fetchAll();

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
                //padrão para facilidade entendimento
                $dados_p = $pdo->query('SELECT id, nome_produto, valor, estoque FROM produto ORDER BY nome_produto');
                $dados = $dados_p->fetchAll();

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
                        <input type="submit"  name="salvar" class="btn btn-primary mb-2" value="Salvar"> <!--Botão Salvar-->
                    </td>
                </tr>    
            </tbody>
        </table>
        <!--Fim tabela produto-->
</div>
</form>
<!-- Fim do selecionar o cliente->
<?php
include "../../footer.inc.php";

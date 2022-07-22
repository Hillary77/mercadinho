<?php
include "../../_app/config.php";
include "../../header.inc.php";

$codigo = filter_input(INPUT_GET, 'venda', FILTER_VALIDATE_INT);

if ($codigo) {
    $delete = $pdo->prepare("DELETE FROM vendas WHERE codigo=:codigo");
    $delete->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    if ($delete->execute()) {

        header("Location: index.php");
        echo 'codigo' . $codigo . ' EXCLUIDO com sucesso!';
    } else {
        echo'<p>Não foi possível EXCLUIR!</p>';
    }
}
?>

<!--INI CONTAINER-->
<!--Ini listagem-->
<div class="container">
    <table class="table table-bordered table-striped ">  
        <thead class="thead-dark">
            <tr class="text-center">
                <th>#</th>
                <th>Cliente</th>
                <th>Produtos</th>
                <th>Preço Total</th>
                <th>Retirada do estoque</th>
                <th>Ação</th>
            </tr>

            <?php
            $dados_c = $pdo->query("SELECT COUNT(*) as conta, SUM(v.valor) as soma, SUM(v.quantidade) as qntd, v.id, v.codigo, u.nome, u.ultimonome, p.nome_produto, v.valor FROM vendas as v "
                    . "INNER JOIN usuario as u ON v.cliente_id = u.id "
                    . "INNER JOIN produto as p ON v.produto_id = p.id "
                    . "GROUP BY v.codigo ");
            $rows = $dados_c->fetchAll();
            foreach ($rows as $row) {
                extract($row);
                echo"<tr class = text-center>";
                echo"<td>$codigo</td>";
                echo"<td>$nome $ultimonome</td>";
                echo"<td>$conta</td>";
                echo"<td>" . number_format($soma, 2, ',', '.') . "</td>";
                echo"<td>" . $qntd . "</td>";
                echo"<td><button type='button' class='btn btn-outline-success rounded-circle' data-toggle='modal' data-target='#exampleModal' data-whatever='$codigo'><i class='bi bi-filter-square'></i></button><br>"
                . "<a type='button' href='editar.php?venda=$codigo' class='btn btn-outline-info btn-sn rounded-circle'><i class='bi bi-pencil-square'></i></a><br>"
                . "<a class='btn btn-outline-danger btn-sn rounded-circle' href=?venda=$codigo><i class='bi bi-trash3'></i></a></td>"; //excluir
                echo"</tr>";
            }
            ?>
        </thead>
    </table>
</div>
<!--FIM CONTAINER-->

<!--INICIO MODAL-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Venda: </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>                

            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div> 
<!--FIM MODAL-->

<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botão que acionou o modal
        var recipient = button.data('whatever');//id da venda
        var modal = $(this);

        modal.find('.modal-title').text('Venda: ' + recipient);
        modal.find('.modal-body').load('../list.php?id=' + recipient);
    });
</script>





<?php
include "../../header.inc.php";
include '../../_app/config.php';
//Gera dados ao apertar o pesquisa
$nomes = filter_input(INPUT_POST, 'pesquisa', FILTER_DEFAULT);
$codigo = filter_input(INPUT_GET, 'codigo', FILTER_VALIDATE_INT);

//Gera dados do select e quais são as opções possíveis da pesquisa
if ($nomes) {
    $select = $pdo->prepare("SELECT codigo, cliente_id, produto_id, valor, quantidade FROM vendas WHERE codigo LIKE '%$nomes%' or produto_id LIKE '%$nomes%'");
    $select->execute();
    $resultados = $select->fetchAll(PDO::FETCH_ASSOC);
?>

<!--ini listagem-->
<div class="container">
    <table class="table table-bordered table-striped ">
        <thead class="thead-dark">
            <tr class="text-center">
                    <th>#</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Quantidade à ser retirada</th>
            </tr>
            <?php
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
}
            ?>

    </table>
</div>
<!--INICIO MODAL-->
<!--Modal serve para abrir uma janela separada/sobre a janela principal-->
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
    //O javascript serve para criar tipo um diálogo com o que cada coisa vai executar ao apertar no botão do modal
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botão que acionou o modal
        var recipient = button.data('whatever');//id da venda
        var modal = $(this);

        modal.find('.modal-title').text('Venda: ' + recipient);
        modal.find('.modal-body').load('../list.php?id=' + recipient);
    });
</script>



<?php
include "../../footer.inc.php";
?>
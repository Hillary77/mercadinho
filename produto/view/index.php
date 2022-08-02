<?php
//REPONSÁVEL POR TRAZER O NAVEBAR PARA TODAS AS ATAS VIEW.
include "../../header.inc.php";
//RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO BANCO DE DADOS
include "../../_app/config.php";

//Botão de exluir da tabela
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

//Traz para deletar do Banco de dados as informações de cada produto e seu id.
if ($id) {
    $sql = "DELETE FROM produto WHERE id=:id";
    $delete = $pdo->prepare($sql);
    $delete->bindParam(':id', $id, PDO::PARAM_INT);

    //Verifica se executou corretamente, direciona novamente á tabela.
    if ($delete->execute()) {
        header("Location: index.php");
        echo 'id' . $id . ' EXCLUIDO com sucesso!';
    } else {
        echo'<p>Não foi possível EXCLUIR!</p>';
    }
}
?>


<!--ini tabela listagem-->
<div class="container">
    <table class="table table-bordered table-striped ">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>#</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Imagem</th>
                <th>Ação</th>
            </tr>

            <?php
//Select é utilizado para extrair/trazer os dados das tabelas de um banco de dados.
            $select = $pdo->query('SELECT * FROM produto ORDER BY nome_produto');
            $rows = $select->fetchAll();

            $i = 0;
//Faz o loop dos dados que entra no Banco de dados para a tabela
            foreach ($rows as $row) {
                extract($row);
                $i++;

                echo"<tr class='text-center'>";
                echo"<td>$i</td>";
                echo"<td>$nome_produto</td>";
                echo"<td>" . number_format($valor, 2, ',', '.') . "</td>";
                echo"<td>$estoque</td>";
                echo"<td class='text-center'><img src=../../_img/$imagem  style='width: 100px; height: 100px;'alt='...' class='img-thumbnail'></td>";
                echo"<td class='text-center'><button type='button' class='btn btn-outline-secundary  btn-sn rounded-circle' data-toggle='modal' data-target='#exampleModal' data-whatever='$nome_produto' data-text='$descricao' data-img='$imagem'><i class='bi bi-filter-square'></i></button><br>"; //visualizar
                echo"<a type='button' href='editar.php?id=$id' class='btn btn-outline-success  btn-sn rounded-circle'><i class='bi bi-pencil-square'></i></a><br>"; //editar
                echo"<a class='btn btn-outline-danger  btn-sn rounded-circle' href=?id=$id><i class='bi bi-trash3'></i></a></td>"; //excluir
                echo"</tr>";
            }
            ?>
        </thead>
    </table>
</div>
<!--Fim tabela listagem-->



<!--INI MODAL-->
<!--Modal ao clicar o botão do visualizar traz outra pagina sobre a pagina principal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Produto</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"> 
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body"></div>

            <img class="modal-img" style=" width: 400px; height: 400px;">         
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!--Fim modal-->

<!--Ini Javascript-->

<script>
    //executa junto ao modal os dados
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botão que acionou o modal
        var text = button.data('text');// Extrai informação dos atributos data-*
        var recipient = button.data('whatever'); // Extrai informação dos atributos data-*
        var modalimg = button.data('img');// Extrai informação dos atributos data-*

        var modal = $(this);

        modal.find('.modal-title').text(recipient);
        modal.find('.modal-img').attr('src', '../../_img/' + modalimg);
        modal.find('.modal-body').text(text);



    });
</script>

<!--Fim Javascript-->

<?php
//TRAZ DADOS DO NAVBAR
include "../../footer.inc.php";
?>


<?php
//REPONSÁVEL POR TRAZER O NAVEBAR PARA TODAS AS ATAS VIEW.
include "../../header.inc.php";
//RESPONSAVEL PELA INSERÇÃO DAS INFORMAÇOES NO BANCO DE DADOS
include "../../_app/config.php";

//Traz o id do cliente no botão editar e exluir em método get 
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

//Traz para deletar do Banco de dados as informações de cada cliente e seu id.
if ($id) {
    $sql = "DELETE FROM usuario WHERE id=:id";
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

<!--Ini listagem-->
<!--o container garante que o seu layout vai ficar alinhado corretamente na página-->
<div class="container">
    <table class="table table-bordered table-striped ">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>#</th>
                <th>Nome</th>
                <th>Ultimo nome</th>
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Data de Nascimento</th>
                <th>CEP</th>
                <th>Ações</th>
            </tr>
            <?php
            //Select é utilizado para extrair/trazer os dados das tabelas de um banco de dados.
            $select = $pdo->query('SELECT * FROM usuario ORDER BY nome');
            $rows = $select->fetchAll();

            //lista números em ordem crencente na tabela
            $i = 0;
            foreach ($rows as $row) {
                //O extract faz conversão de array para variável, pode chamar os dados sem o row, na listagem de dados. 
                extract($row);

                // Editar para formato BR correto
                $date_br = date('d/m/Y', strtotime($data));
                $um = substr($cep, 0, 5);
                $dois = substr($cep, -3);
                $cep_br = $um . '-' . $dois;
                $i++;
                //dados a serem listados
                echo"<tr class='text-center'>";
                echo"<td>$i</td>";
                echo"<td>$nome</td>";
                echo"<td>$ultimonome</td>";
                echo"<td>$email</td>";
                echo"<td>$endereco</td>";
                echo"<td>$cidade</td>";
                echo"<td>$date_br</td>";
                echo"<td>$cep_br</td>";
                echo"<td><a href='editar.php?id=$id'class='btn btn-outline-success  btn-sn rounded-circle'><i class='bi bi-pencil-square'></i></a>"; //Editar
                echo"<br><a class='btn btn-outline-danger  btn-sn rounded-circle' href=?id=$id><i class='bi bi-trash3'></i></a></td>"; //Excluir
                echo"</tr>";
            }
            ?>
    </table>
</div>

<?php
//TRAZ A BASE DO NAVBAR
include "../../footer.inc.php";

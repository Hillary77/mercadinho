<?php
include "../../header.inc.php";
include '../../_app/config.php';


$nomes = filter_input(INPUT_POST, 'pesquisa', FILTER_DEFAULT);
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($nomes) {

    $sql = "SELECT nome, ultimonome, email, endereco, cidade, data, cep FROM usuario WHERE nome LIKE '%$nomes%' or ultimonome LIKE '%$nomes%' or data LIKE '%$nomes%'";
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
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Data de Nascimento</th>
                <th>CEP</th>
                <th>Ações</th>
            </tr>
            <?php
            $i = 0;
            foreach ($rows as $row) {
                extract($row);
                // Editar para formato BR correto
                $date_br = date('d/m/Y', strtotime($data));
                $um = substr($cep, 0, 5);
                $dois = substr($cep, -3);
                $cep_br = $um . '-' . $dois;
                $i++;

                echo"<tr>";
                echo"<td>$i</td>";
                echo"<td>$nome</td>";
                echo"<td>$ultimonome</td>";
                echo"<td>$email</td>";
                echo"<td>$endereco</td>";
                echo"<td>$cidade</td>";
                echo"<td>$date_br</td>";
                echo"<td>$cep_br</td>";
                echo"<td><a href='editar.php?id=$id'class='btn btn-success'>Editar</a></td>";
                echo"<td><a class='btn btn-danger' href=?id=$id>Excluir</a></td>";
                echo"</tr>";
            }
}
            ?>

    </table>
</div>

<?php
include "../../footer.inc.php";
?>
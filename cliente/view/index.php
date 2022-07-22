<?php
include "../../header.inc.php";
include "../../_app/config.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $sql = "DELETE FROM usuario WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: index.php");
        echo 'id' . $id . ' EXCLUIDO com sucesso!';
    } else {
        echo'<p>Não foi possível EXCLUIR!</p>';
    }
}
?>

<!--Ini listagem-->
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
$sth = $pdo->query('SELECT * FROM usuario ORDER BY nome');
$rows = $sth->fetchAll();

$i = 0;
foreach ($rows as $row) {
    extract($row);
    // Editar para formato BR correto
    $date_br = date('d/m/Y', strtotime($data));
    $um = substr($cep, 0, 5);
    $dois = substr($cep, -3);
    $cep_br = $um . '-' . $dois;
    $i++;

    echo"<tr class='text-center'>";
    echo"<td>$i</td>";
    echo"<td>$nome</td>";
    echo"<td>$ultimonome</td>";
    echo"<td>$email</td>";
    echo"<td>$endereco</td>";
    echo"<td>$cidade</td>";
    echo"<td>$date_br</td>";
    echo"<td>$cep_br</td>";
    echo"<td><a href='editar.php?id=$id'class='btn btn-outline-success  btn-sn rounded-circle'><i class='bi bi-pencil-square'></i></a>";
    echo"<br><a class='btn btn-outline-danger  btn-sn rounded-circle' href=?id=$id><i class='bi bi-trash3'></i></a></td>";
    echo"</tr>";
}
?>

    </table>
</div>

<?php
include "../../footer.inc.php";

<?php
include '../_app/config.php';
//
$i=0;
$total = 0;
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$query = $pdo->query("SELECT p.nome_produto, v.produto_id, v.valor, v.quantidade FROM vendas as v INNER JOIN produto as p ON v.produto_id=p.id WHERE codigo = $id");
?>

<div class="container">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr class="text-center">
                <th>#</th>
                <th>Produto</th>
                <th>Valor un</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>

            <?php
            foreach ($query->fetchAll() as $row) {
                $subtotal = $row['valor'] * $row['quantidade'];
                $total += $subtotal;
                $i++;
                ?>

                <tr class="text-center">
                    <td><?= $i?></td>
                    <td><?= $row['nome_produto'] ?></td>
                    <td class="text-right"><?= number_format($row['valor'], 2, ',', '.') ?></td>
                    <td><?= $row['quantidade'] ?></td>
                    <td class="text-right"><?= number_format($subtotal, 2, ',', '.') ?></td>
                </tr>
            <?php } ?>

            <tr>
                <td class="text-right" colspan="6">
                    Total: <?= number_format($total,2,',','.'); ?>
                </td>
            </tr>
        </table>
    </div>
</div>
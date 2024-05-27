<?php
include 'init.php';
include('config/conn.php');

$problemaSelecionado = $_GET['problema'];

$query = "SELECT COUNT(id) as qtd, problem, department FROM `hd_tickets`";
if ($problemaSelecionado !== 'todos') {
    $query .= " WHERE problem = $problemaSelecionado";
}
$query .= " GROUP BY problem, department ORDER BY problem DESC";

$recorrencias = $link->query($query);

while ($recorrenciaPorSetor = mysqli_fetch_object($recorrencias)) {
    ?>
    <tr>
        <td>
            <?php
            $recorrencia = $recorrenciaPorSetor->problem;
            $nomeRecorrencia = $link->query("SELECT * FROM `problemas` WHERE id = $recorrencia");
            while ($recorre = mysqli_fetch_object($nomeRecorrencia)) {
                echo $recorre->name;
            }
            ?>
        </td>
        <td>
            <?php
            $setorDaRecorrencia = $recorrenciaPorSetor->department;
            $setorNome = $link->query("SELECT * FROM `hd_departments` WHERE id = $setorDaRecorrencia");
            while ($setor = mysqli_fetch_object($setorNome)) {
                echo $setor->name;
            }
            ?>

        </td>

        <td><?= $recorrenciaPorSetor->qtd ?></td>
    </tr>
    <?php
}
?>

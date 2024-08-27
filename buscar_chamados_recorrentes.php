<?php
include 'init.php';
include('config/conn.php');

$problemaSelecionado = $_GET['problema'];
$setorSelecionado = $_GET['setor'];

$query = "SELECT COUNT(id) as qtd, problem, department FROM `hd_tickets`";
$conditions = [];
if ($problemaSelecionado !== 'todos') {
    $conditions[] = "problem = $problemaSelecionado";
}
if ($setorSelecionado !== 'todos') {
    $conditions[] = "department = $setorSelecionado";
}
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}
$query .= " GROUP BY problem, department ORDER BY problem DESC";

$recorrencias = $link->query($query);

while ($recorrenciaPorSetor = mysqli_fetch_object($recorrencias)) {
    ?>
    
    <tr data-id="<?= $recorrenciaPorSetor->id ?>" onclick="redirecionarParaChamado(<?= $recorrenciaPorSetor->id ?>)">
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


   <script>
    function redirecionarParaChamado(chamadoId) {
        window.location.href = 'detalhes_chamado.php?id=' + chamadoId;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const linhas = document.querySelectorAll('tr[data-id]');
        linhas.forEach(linha => {
            linha.addEventListener('click', function() {
                const chamadoId = this.getAttribute('data-id');
                redirecionarParaChamado(chamadoId);
            });
        });
    });
</script>

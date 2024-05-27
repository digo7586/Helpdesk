<?php
include 'init.php';
if (!$users->isLoggedIn()) {
    header("Location: login.php");
}
include('inc/header.php');

$user = $users->getUserInfo();
require_once('config/conn.php');

// Fetch total number of tickets
$totalChamadosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets`");
$totalchamadosResult = mysqli_fetch_object($totalChamadosQuery);
$chamadosAbertos = $totalchamadosResult->qtd;

// Fetch tickets in progress and completed tickets if there are any open tickets
if ($chamadosAbertos > 0) {
    $totalEmAndamentoQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE admin_read = 1 AND resolved = 0");
    $totalEmAndamentoResult = mysqli_fetch_object($totalEmAndamentoQuery);
    $chamadosEmAndamento = $totalEmAndamentoResult->qtd;

    $totalConcluidoQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE resolved = 1");
    $totalConcluidoResult = mysqli_fetch_object($totalConcluidoQuery);
    $chamadosFim = $totalConcluidoResult->qtd;

    $progressoEmAndamento = ($chamadosEmAndamento / $chamadosAbertos) * 100;
    $progressoConcluido = ($chamadosFim / $chamadosAbertos) * 100;
} else {
    $progressoEmAndamento = 0;
    $progressoConcluido = 0;
}

// Fetch total number of active users
$totalUsuariosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_users` WHERE status = 1");
$totalUsuariosResult = mysqli_fetch_object($totalUsuariosQuery);
$usuarios = $totalUsuariosResult->qtd;

// Fetch the total number of tickets per department
$totalSetor = $link->query("SELECT COUNT(id) as qtd, department FROM `hd_tickets` GROUP BY department ORDER BY qtd DESC");

// Fetch recurring problems by department
$recorrencias = $link->query("SELECT COUNT(id) as qtd, problem, department FROM `hd_tickets` GROUP BY problem, department ORDER BY problem DESC");

$setores = $link->query("SELECT * FROM hd_departments");

// Prepare data for chart
$dadosChamadosPorSetor = [];
while ($ocorrenciaPorSetor = mysqli_fetch_object($totalSetor)) {
    $setorNome = $link->query("SELECT * FROM `hd_departments` WHERE id = $ocorrenciaPorSetor->department");
    if ($setorNome && $setor = mysqli_fetch_object($setorNome)) {
        $dadosChamadosPorSetor[$setor->name] = $ocorrenciaPorSetor->qtd;
    } else {
        $dadosChamadosPorSetor["Setor Desconhecido"] = $ocorrenciaPorSetor->qtd;
    }
}
$labelsChamadosPorSetor = array_keys($dadosChamadosPorSetor);
$valoresChamadosPorSetor = array_values($dadosChamadosPorSetor);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Suporte | BAGCLEANER</title>
    <link rel="shortcut icon" href="icone.ico">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleHome.css">
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/general.js"></script>
    <script src="js/department.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <?php include('inc/nav.php'); ?>
    <?php include('inc/container.php'); ?>
    <div class="container-fluid">
        <?php include_once('infodash.php'); ?>
        <div class="row">
            <div class="col-lg-5 col-md-4 col-sm g-5">
                <div class="card">
                    <div class="card-bdy">
                        <div class="card-title mb-4">
                            <h3>Chamados abertos por Setor</h3>
                        </div>
                    </div>
                    <canvas id="myChart"></canvas>
                    <script>
                        const ctx = document.getElementById('myChart');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?= json_encode($labelsChamadosPorSetor) ?>,
                                datasets: [{
                                    label: 'Chamados',
                                    data: <?= json_encode($valoresChamadosPorSetor) ?>,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm g-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <h3>Recorrências</h3>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ocorrência</th>
                                <th>Setor</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody id="tabelaChamadosRecorrentes">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="filtroChamados">
                                        <label for="selecionarChamado">Selecione um chamado:</label>
                                        <select id="selecionarChamado" name="selecionarChamado">
                                            <option value="todos">Todos</option>
                                            <?php
                                            $problemasQuery = $link->query("SELECT * FROM `problemas`");
                                            while ($problema = mysqli_fetch_object($problemasQuery)) {
                                                echo "<option value='{$problema->id}'>{$problema->name}</option>";
                                            }
                                            ?>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <script>
                                function atualizarChamadosRecorrentes() {
                                    var selectValor = document.getElementById('selecionarChamado').value;
                                    $.ajax({
                                        url: 'buscar_chamados_recorrentes.php',
                                        type: 'GET',
                                        data: { problema: selectValor },
                                        success: function(data) {
                                            document.getElementById('tabelaChamadosRecorrentes').innerHTML = data;
                                        }
                                    });
                                }
                                document.getElementById('selecionarChamado').addEventListener('change', atualizarChamadosRecorrentes);
                                atualizarChamadosRecorrentes();
                            </script>
                            <?php
                            while ($recorrenciaPorSetor = mysqli_fetch_object($recorrencias)) {
                                $recorrencia = $recorrenciaPorSetor->problem;
                                $nomeRecorrencia = $link->query("SELECT * FROM `problemas` WHERE id = $recorrencia");
                                $recorreName = mysqli_fetch_object($nomeRecorrencia)->name;
                                $setorDaRecorrencia = $recorrenciaPorSetor->department;
                                $setorNome = $link->query("SELECT * FROM `hd_departments` WHERE id = $setorDaRecorrencia");
                                $setorName = mysqli_fetch_object($setorNome)->name;
                            ?>
                                <tr data-toggle="modal" data-target="#chamadoModal" data-id="<?= $recorrenciaPorSetor->id ?>">
                                    <td><?= $recorreName ?></td>
                                    <td><?= $setorName ?></td>
                                    <td><?= $recorrenciaPorSetor->qtd ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="chamadoModal" tabindex="-1" aria-labelledby="chamadoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chamadoModalLabel">Detalhes do Chamado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="detalhesChamado"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#chamadoModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var chamadoId = button.data('id');
            var modal = $(this);
            $.ajax({
                url: 'buscar_detalhes_chamado.php',
                type: 'GET',
                data: { id: chamadoId },
                success: function(data) {
                    modal.find('#detalhesChamado').html(data);
                }
            });
        });
    </script>

    <?php include('inc/footer.php'); ?>
</body>
</html>

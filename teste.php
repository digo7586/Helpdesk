<?php 
require_once('config/conn.php');

########################## Total de chamados ########################################
$totalChamados = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets`");
while ($chamadosCadastrados = mysqli_fetch_object($totalChamados)) {
    $chamadosAbertos = $chamadosCadastrados->qtd;
}

########################## Total de chamados em andamento ########################################
$totalLidos = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE admin_read = 1");
while ($chamadosLidos = mysqli_fetch_object($totalLidos)) {
    $chamadosEmAndamento = $chamadosLidos->qtd;
    $progressoEmAndamento = ($chamadosEmAndamento / $chamadosAbertos) * 100; // Calcula a porcentagem de chamados em andamento
}

############################## TOTAL DE CHAMADOS CONCLUIDOS ####################################
$totalConcluido = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE resolved = 1");
while ($chamadosfinalizados = mysqli_fetch_object($totalConcluido)) {
    $chamadosFim = $chamadosfinalizados->qtd;
    $progressoConcluido = ($chamadosFim / $chamadosAbertos) * 100; // Calcula a porcentagem de chamados concluídos
}

########################### total de usuarios #########################################
$totalUsuarios = $link->query("SELECT COUNT(id) as qtd FROM `hd_users` where status = 1");
while ($usuariosCadastrados = mysqli_fetch_object($totalUsuarios)) {
    $usuarios = $usuariosCadastrados->qtd;
}

################################## TOTAL POR SETOR #######################
$totalSetor = $link->query("SELECT COUNT(id) as qtd, department FROM `hd_tickets` GROUP BY department");

?>
<link rel="stylesheet" href="css/styleHome.css"/>

<div class="container-fluid">
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
        
        <div class="col">
            <div class="card">
                <div class="card-head">
                    <h2 class="card-title mb-4"><?= $chamadosAbertos ?></h2>
                    <span class="clipBoard"><i class="bi bi-clipboard2"></i></span>
                </div>
                <div class="card-progress">
                    <small>CHAMADOS ABERTOS</small>
                    <div class="card-indicator">
                        <div class="indicator one" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-head">
                    <h2 class="card-title mb-4"><?= $chamadosEmAndamento ?></h2>
                    <span class="clock"><i class="bi bi-clock-history"></i></span>
                </div>
                <div class="card-progress">
                    <small>EM ANDAMENTO</small>
                    <div class="card-indicator">
                        <div class="indicator two" style="width: <?= $progressoEmAndamento ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-head">
                    <h2 class="card-title mb-4"><?= $chamadosFim ?></h2>
                    <span class="check"><i class="bi bi-check-circle"></i></span>
                </div>
                <div class="card-progress">
                    <small>CONCLUÍDOS</small>
                    <div class="card-indicator">
                        <div class="indicator three" style="width: <?= $progressoConcluido ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-head">
                    <h2 class="card-title mb-4"><?= $usuarios ?></h2>
                    <span class="people"><i class="bi bi-people"></i></span>
                </div>
                <div class="card-progress">
                    <small>USÚARIOS</small>
                    <div class="card-indicator">
                        <div class="indicator four"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

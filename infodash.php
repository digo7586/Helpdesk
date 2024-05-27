<?php 
require_once('config/conn.php');

/* variaveis padrão */
$abertos = 0;
$chamadosEmAndamento = 0;
$chamadosFim = 0;

########################## Total de chamados ########################################
// consulta para obter total de chamados cadastrados
$totalChamadosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets`");
$totalchamadosResult = mysqli_fetch_object($totalChamadosQuery);
$chamadosTotal = $totalchamadosResult->qtd;

// Verifica se há chamados abertos antes de calcular a porcentagem de andamento e concluídos
    if ($chamadosTotal > 0) {
        // Consulta para obter o total de chamados abertos
        $totalAbertosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE resolved = 0");
        $totalAbertoResult = mysqli_fetch_object($totalAbertosQuery);
        $abertos = $totalAbertoResult->qtd;

        // Consulta para obter o total de chamados em andamento
        $totalEmAndamentoQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE  resolved = 1");
        $totalEmAndamentoResult = mysqli_fetch_object($totalEmAndamentoQuery);
        $chamadosEmAndamento = $totalEmAndamentoResult->qtd;

         // Consulta para obter o total de chamados concluídos
         $totalConcluidoQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE resolved = 2");
         $totalConcluidoResult = mysqli_fetch_object($totalConcluidoQuery);
         $chamadosFim = $totalConcluidoResult->qtd;

         // Calcula a porcentagem de chamados em andamento e concluídos
         $progressoAberto = ($abertos / $chamadosAbertos) * 100;
         $progressoEmAndamento = ($chamadosEmAndamento / $chamadosTotal) * 100;
         $progressoConcluido = ($chamadosFim / $chamadosTotal) * 100;
    } else{
         // Define como zero se não houver chamados abertos
         $progressoEmAndamento = 0;         
         $progressoConcluido = 0;
    }


// Consulta para obter o total de usuários cadastrados com status ativo
$totalUsuariosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_users` WHERE status = 1");
$totalUsuariosResult = mysqli_fetch_object($totalUsuariosQuery);
$usuarios = $totalUsuariosResult->qtd;

################################## consulta para obter chamados por setor #######################



// Consulta SQL para calcular a média de tempo entre a abertura e o fechamento dos tickets
// Obtém a data de hoje no formato 'Y-m-d'
$hoje = date("Y-m-d");

// Obtém a data de início e fim da semana atual
$inicioSemana = date("Y-m-d", strtotime('monday this week'));
$fimSemana = date("Y-m-d", strtotime('sunday this week'));

// Consulta para calcular a média de tempo apenas para os chamados desta semana
$mediaTempoQuery = $link->query("SELECT AVG(TIMESTAMPDIFF(MINUTE, FROM_UNIXTIME(t.date), FROM_UNIXTIME(r.date))) AS tempo_medio_minutos
FROM `hd_tickets` t
JOIN `hd_ticket_replies` r ON t.id = r.ticket_id
WHERE t.resolved = 2 AND DATE(FROM_UNIXTIME(r.date)) BETWEEN '$inicioSemana' AND '$fimSemana'");


/* tempo para dia de hoje */
/* WHERE t.resolved = 2 AND DATE(FROM_UNIXTIME(r.date)) = '$hoje'"); */
/* WHERE t.resolved = 2 AND DATE(FROM_UNIXTIME(r.date)) BETWEEN '$inicioSemana' AND '$fimSemana'"); */

// Obtém o resultado da consulta
$mediaTempoResult = mysqli_fetch_object($mediaTempoQuery);


// Verifica se há resultados
if ($mediaTempoResult) {
    // Extrai o tempo médio em minutos
    $mediaTempoMinutos = $mediaTempoResult->tempo_medio_minutos;

    // Calcula as horas e minutos
    $horas = floor($mediaTempoMinutos / 60);
    $minutos = $mediaTempoMinutos % 60;

    // Formata os minutos para dois dígitos
    $minutosFormatados = sprintf("%02d", $minutos);

    // Agora, $horas e $minutosFormatados contêm o tempo médio para os chamados de hoje.
} else {
    // Não há chamados de hoje
    $horas = 0;
    $minutosFormatados = "00";
}

?>
<link rel="stylesheet" href="css/styleHome.css"/>

<div class="container-fluid">
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4  g-3">
        
        <div class="col-md-2 col-sm-4">
            <a href="ticket.php" style="text-decoration: none;">
            <div class="card">
                <div class="card-head">
                    <h2 class="card-title mb-4"><?= $chamadosTotal ?></h2>
                    <span class="clipBoard"><i class="bi bi-clipboard"></i></span>
                </div>
                <div class="card-progress">
                    <small>CHAMADOS NO TOTAL</small>
                    <div class="card-indicator">
                        <div class="indicator zero"></div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-md-2 col-sm-4">
            <a href="abertos.php" style="text-decoration: none;">
            <div class="card">
                <div class="card-head">
                    <h2 class="card-title mb-4"><?= $abertos ?></h2>
                    <span class="clipBoard"><i class="bi bi-clipboard2"></i></span>
                </div>
                <div class="card-progress">
                    <small>CHAMADOS ABERTOS</small>
                    <div class="card-indicator">
                    <div class="indicator one" style="width: <?= $progressoAberto ?>%;"></div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-md-2 col-sm-4">
            <a href="emAndamento.php" style="text-decoration: none;">
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
            </a>
        </div>

        <div class="col-md-2 col-sm-4">
            <a href="concluidas.php" style="text-decoration: none;">
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
            </a>
        </div>

        <div class="col-md-2">
            <div class="card">
                <div class="card-head">
                    <h2 class="card-title mb-4"><?= $minutosFormatados ?><sub class="fs-6 ms-1">min</sub></h2>
                    <span class="clock"><i class="bi bi-clock"></i></span>
                </div>
                <div class="card-progress">
                    <small>TEMPO MÉDIO DE RESOLUÇÃO</small>
                    <div class="card-indicator">
                        <div class="indicator five"></div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col-md-2">
            <a href="user.php" style="text-decoration: none;">
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
            </a>
        </div>
    </div>

</div>

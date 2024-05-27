<?php 

require_once('config/conn.php');
require_once 'class/Users.php';


// Verificar se o usuário está logado
$userObj = new Users();
if(!$userObj->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

// Obter o ID do usuário logado
$userID = $_SESSION['userid'];


/* variaveis padrão */
$abertos = 0;
$chamadosEmAndamento = 0;
$chamadosFim = 0;

########################## Total de chamados ########################################
// consulta para obter total de chamados cadastrados pelo usuario

$totalChamadosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE user = $userID");
$totalchamadosResult = mysqli_fetch_object($totalChamadosQuery);
$chamadosAbertos = $totalchamadosResult->qtd;

// Verifica se há chamados abertos antes de calcular a porcentagem de andamento e concluídos
    if ($chamadosAbertos > 0) {
        // Consulta para obter chamados abertos
        $totalAbertosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE user = $userID AND resolved = 0");
        $totalAbertoResult = mysqli_fetch_object($totalAbertosQuery);
        $abertos = $totalAbertoResult->qtd;

        // Consulta para obter o total de chamados em andamento
        $totalEmAndamentoQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE user = $userID AND resolved = 1");
        $totalEmAndamentoResult = mysqli_fetch_object($totalEmAndamentoQuery);
        $chamadosEmAndamento = $totalEmAndamentoResult->qtd;

         // Consulta para obter o total de chamados concluídos
         $totalConcluidoQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE user = $userID AND resolved = 2");
         $totalConcluidoResult = mysqli_fetch_object($totalConcluidoQuery);
         $chamadosFim = $totalConcluidoResult->qtd;

         // Calcula a porcentagem de chamados aberto em andamento e concluídos
         $progressoAberto = ($abertos / $chamadosAbertos) * 100;
         $progressoEmAndamento = ($chamadosEmAndamento / $chamadosAbertos) * 100;
         $progressoConcluido = ($chamadosFim / $chamadosAbertos) * 100;
    } else{
         // Define como zero se não houver chamados abertos
         $progressoAberto = 0;
         $progressoEmAndamento = 0;         
         $progressoConcluido = 0;
    }



// Obter a data atual no formato YYYY-MM-DD
$dataAtual = date("Y-m-d");

/*  = '$dataAtual' */

// Consulta SQL para calcular a média de tempo entre a abertura e o fechamento dos tickets
$mediaTempoQuery = $link->query("SELECT AVG(TIMESTAMPDIFF(MINUTE, FROM_UNIXTIME(t.date), FROM_UNIXTIME(r.date))) AS tempo_medio_minutos
FROM `hd_tickets` t
JOIN `hd_ticket_replies` r ON t.id = r.ticket_id
WHERE t.resolved = 2 AND DATE(FROM_UNIXTIME(r.date))");

$mediaTempoResult = mysqli_fetch_object($mediaTempoQuery);
$mediaTempoMinutos = $mediaTempoResult->tempo_medio_minutos;

// Calcular as horas e minutos
$horas = floor($mediaTempoMinutos / 60);
$minutos = $mediaTempoMinutos % 60;

// Formatando os minutos para dois dígitos
$minutosFormatados = sprintf("%02d", $minutos);

// Exibir a média de tempo
/* echo "Média de tempo de resolução dos tickets de hoje: " . $horas . " horas e " . $minutosFormatados . " minutos";
 */

?>
<link rel="stylesheet" href="css/styleHome.css"/>

<div class="container-fluid">
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4  g-3">
        
        <div class="col-md-2 col-sm-4">
        <a href="./ticket.php" style="text-decoration: none;">
            <div class="card">
                <div class="card-head">
                    <h2 class="card-title mb-4"><?= $chamadosAbertos ?></h2>
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

        <div class="col-md-3 col-sm-4">
            <a href="abertosUsers.php" style="text-decoration: none;">
            <div class="card">
                <div class="card-head">
                    <h2 class="card-title mb-4"><?= $abertos ?></h2>
                    <span class="clipBoard"><i class="bi bi-clipboard2"></i></span>
                </div>
                <div class="card-progress">
                    <small>ABERTOS</small>
                    <div class="card-indicator">
                    <div class="indicator one" style="width: <?= $progressoAberto ?>%;"></div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-4">
            <a href="emAndamentoUsers.php" style="text-decoration: none;">
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

        <div class="col-md-3 col-sm-4">
            <a href="concluidasUsers.php" style="text-decoration: none;">
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

        <?php if (isset($_SESSION['admin'])) { ?>

        <div class="col-md-2">
            <div class="card">
                <div class="card-head">
                    <h2 class="card-title mb-4"><?= $minutosFormatados ?><sub class="fs-6">min</sub></h2>
                    <span class="clock"><i class="bi bi-clock"></i></span>
                </div>
                <div class="card-progress">
                    <small>TEMPO MÉDIO</small>
                    <div class="card-indicator">
                        <div class="indicator five"></div>
                    </div>
                </div>
            </div>
        </div> 

        <?php } ?>

     
    </div>

</div>

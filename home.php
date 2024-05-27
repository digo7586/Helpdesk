<?php
include 'init.php';
if (!$users->isLoggedIn()) {
	header("Location: login.php");
}
include('inc/header.php');
$user = $users->getUserInfo();

require_once('config/conn.php');

########################### total de usuarios #########################################
$totalUsuarios = $link->query("SELECT COUNT(id) as qtd FROM `hd_users` where status = 1");

while ($usuariosCadastrados = mysqli_fetch_object($totalUsuarios)) {
    $usuarios = $usuariosCadastrados->qtd;
}

########################## Total de chamados ########################################
$totalChamados = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets`");

while ($chamadosCadastrados = mysqli_fetch_object($totalChamados)) {
    $chamadosAbertos = $chamadosCadastrados->qtd;
}

########################## Total de chamados em andamento ########################################
$totalLidos = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE admin_read = 1");

while ($chamadosLidos = mysqli_fetch_object($totalLidos)) {
    $chamadosEmAndamento = $chamadosLidos->qtd;
}

############################## TOTAL DE CHAMADOS CONCLUIDOS ####################################
$totalConcluido = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE resolved = 1");

while ($chamadosfinalizados = mysqli_fetch_object($totalConcluido)) {
    $chamadosFim = $chamadosfinalizados->qtd;
}


################################## TOTAL POR SETOR #######################
$totalSetor = $link->query("SELECT COUNT(id) as qtd, department FROM `hd_tickets` GROUP BY department");

$setores = $link->query("select * from hd_departments order by name ASC");

?>
<title>Suporte | ENGEBAG E BAGCLEANER</title>
<script src="js/jquery.dataTables.min.js"></script>

<!-- <script src="js/dataTables.bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" /> -->
<script src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"></script>

<script src="js/general.js"></script>

<script src="js/department.js"></script>

<link rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/styleHome.css"/>


<?php include('inc/nav.php'); ?>
<?php include('inc/container.php'); ?>
<div class="container-fluid">
    <?php include_once('infodash.php'); ?>
    
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm g-4">
            <div class="card">
                <div class="card-bdy">
                    <div class="card-title mb-4"> Chamados abertos por Setor</div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Setor</th>
                            <th>Chamados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($ocorrenciaPorSetor = mysqli_fetch_object($totalSetor)) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $setorDaOcorrencia = $ocorrenciaPorSetor->department;
                                    $setorNome = $link->query("SELECT * FROM `hd_departments` WHERE id = $setorDaOcorrencia");
                                    while ($setor = mysqli_fetch_object($setorNome)) {
                                        echo $setor->name;
                                    }
                                    ?>
                                </td>
                                <td><?= $ocorrenciaPorSetor->qtd ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('inc/footer.php'); ?>
<?php
include 'init.php';
if (!$users->isLoggedIn()) {
    header("Location: login.php");
}
require_once('inc/header.php');
$user = $users->getUserInfo();

require_once('config/conn.php');

########################## Total de chamados ########################################
// consulta para obter total de chamados cadastrados
$totalChamadosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets`");
$totalchamadosResult = mysqli_fetch_object($totalChamadosQuery);
$chamadosAbertos = $totalchamadosResult->qtd;

// Verifica se há chamados abertos antes de calcular a porcentagem de andamento e concluídos
if ($chamadosAbertos > 0 ) {
    // Consulta para obter o total de chamados em andamento
    $totalEmAnadamentoQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE admin_read = 1 AND resolved = 0");
    $totalEmAnadamentoResult = mysqli_fetch_object($totalEmAnadamentoQuery);
    $chamadosEmAndamento = $totalEmAnadamentoResult->qtd;

    // Consulta para obter o total de chamados concluídos
    $totalConcluidoQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE resolved = 1");
    $totalConcluidoResult = mysqli_fetch_object($totalConcluidoQuery);
    $chamadosFim = $totalConcluidoResult->qtd;

    // Calcula a porcentagem de chamados em andamento e concluídos
    $progressoEmAndamento = ($chamadosEmAndamento / $chamadosAbertos) * 100;
    $progressoConcluido = ($chamadosFim / $chamadosAbertos) * 100;
} else {
    // Define como zero se não houver chamados abertos
    $progressoEmAndamento = 0;
    $progressoConcluido = 0;
}

// Consulta para obter o total de usuários cadastrados com status ativo
$totalUsuariosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_users` WHERE status = 1");
$totalUsuariosResult = mysqli_fetch_object($totalUsuariosQuery);
$usuarios = $totalUsuariosResult->qtd;

?>
<title>SUPORTE | BAGCLEANER</title>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<script src="js/general.js"></script>
<script src="js/department.js"></script>

<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/styleHome.css" />

<?php require_once('inc/nav.php'); ?>
<?php require_once('inc/container.php'); ?>
<?php include('add_ticket_model.php'); ?>

<div class="container-fluid">

    <?php if (isset($_SESSION['admin'])) { ?>
        <?php include_once('infodash.php'); ?>
    <?php } ?>
    <div class="panel-heading">
        <div class="row-reverse">
            <div class="chat">
                <div class="btnTicket">
                    <button type="button" name="add" id="createTicket" class="btn btn-success btn-md">Abrir Ticket</button>
                </div>
            </div>
        </div>
    </div>

    <table id="listTicketsFim" class="table table-striped table-hover table-sm mt-2">
        <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Ocorrência</th>
                <th scope="col">Descrição</th>
                <th scope="col">Departmento</th>
                <th scope="col">Usúario</th>
                <th scope="col">Criado</th>
                <th scope="col">Fechado</th>
                <th scope="col">Status</th>
               
            </tr>
        </thead>

        <tbody>
        <?php
        // Modifique sua consulta para juntar as tabelas 'hd_tickets', 'hd_departments' e 'hd_users'
        $ticketsQuery = $link->query("SELECT t.id, t.uniqid, t.title, p.name as nameProblem, d.name as department_name, u.name as user_name, t.date, t.resolved, MAX(r.date) as closed_ticket 
            FROM `hd_tickets` t 
            LEFT JOIN `hd_departments` d ON t.department = d.id 
            LEFT JOIN `hd_users` u ON t.user = u.id
            LEFT JOIN `hd_ticket_replies` r ON t.id = r.ticket_id
            LEFT JOIN `problemas` p ON t.problem = p.id
            WHERE resolved = '2'
            GROUP BY t.id DESC");

        while ($ticket = mysqli_fetch_assoc($ticketsQuery)) {
        ?>
            <tr>
                <td><?php echo $ticket['id']; ?></td>
                <td><?php echo $ticket['nameProblem']; ?></td>
                <td><?php echo $ticket['title']; ?></td>
                <td><?php echo $ticket['department_name']; ?></td>
                <td><?php echo $ticket['user_name']; ?></td>
                <td><?php echo $time->tempo($ticket['date']); ?></td>
                <td><?php echo $time->tempo($ticket['closed_ticket']); ?></td>
                <td><?php echo ($ticket['resolved'] == 2) ? "Resolvido" : "Aberto"; ?></td>
                
            </tr>
        <?php } ?>
        </tbody>
    </table>
    
    <?php require_once('inc/footer.php'); ?>
</div>

<script>
$(document).ready(function() {
    $('#listTicketsFim').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/Portuguese-Brasil.json"
        }
    });
});
</script>
